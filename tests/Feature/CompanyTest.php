<?php

namespace Tests\Feature;

use App\DTO\CompanyDTO;
use App\Exceptions\InvalidArrayParamsException;
use App\Helpers\ValidationHelper;
use App\Models\Company;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    private function testDTO(): CompanyDTO
    {
        return new CompanyDTO(
            'Pixelware',
            '93842343',
            'Huidenclubplein 4C',
            'Rotterdam',
            '3029PB',
            'Netherlands'
        );
    }

    public function test_create_dto()
    {
        $companyDTO = $this->testDTO();

        $this->assertFalse($companyDTO === null);
        $this->assertTrue($companyDTO instanceof CompanyDTO);
    }

    public function test_create_dto_from_request()
    {
        $request = new Request([
            'name' => 'Pixelware',
            'kvk' => '9384243',
            'street_address' => 'Huidenclubplein 4C',
            'city' => 'Rotterdam',
            'postal_code' => '3029PB',
            'country' => 'Netherlands'
        ]);

        $companyDTO = CompanyDTO::fromRequest($request);

        $this->assertTrue($companyDTO instanceof CompanyDTO);
    }

    public function test_return_dto_to_array()
    {
        $required = ['name', 'kvk', 'street_address', 'city', 'postal_code', 'country'];
        $companyArray = $this->testDTO()->toArray();

        $this->assertFalse(ValidationHelper::isMissingRequiredArrayParams($required, $companyArray));
        $this->assertTrue(is_array($companyArray));
    }

    /**
     * @throws InvalidArrayParamsException
     */
    public function test_insert_new_company_from_dto_array()
    {
        $companyDTO = $this->testDTO();

        $company = Company::createOrGet($companyDTO->toArray());

        $this->assertTrue($company instanceof Company);
        $this->assertTrue(Company::fromKvk($companyDTO->getKvk())->exists());
        $this->assertDatabaseHas('companies', $companyDTO->toArray());
    }

    public function test_delete_company()
    {
        $companyDTO = $this->testDTO();
        $companyQuery = Company::fromKvk($companyDTO->getKvk());

        if ($companyQuery->exists()) {
            $companyQuery->delete();
        }

        $this->assertFalse($companyQuery->exists());
    }
}
