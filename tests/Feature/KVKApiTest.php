<?php

namespace Tests\Feature;

use App\Enums\Tests\KVKNumber;
use App\Models\Company;
use App\Services\KVKService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class KVKApiTest extends TestCase
{
    /**
     * A basic feature test example.
     * @throws ConnectionException
     */
    public function test_successful_main_companies_response(): void
    {
        $kvkService = new KVKService();
        $emptyCompany = new Company();

        foreach (KVKNumber::successCases() as $case) {
            $company = $kvkService->getCompanyDetails($case->value);

            $this->assertTrue($company->status() === ResponseAlias::HTTP_OK);
            $this->assertFalse($company === $emptyCompany);
        }
    }

    /**
     * @throws ConnectionException
     */
    public function test_failed_main_companies_response(): void
    {
        $kvkService = new KVKService();

        foreach (KVKNumber::errorCases() as $case) {
            $company = $kvkService->getCompanyDetails($case->value);

            $this->assertFalse($company->status() === ResponseAlias::HTTP_OK);
        }
    }
}
