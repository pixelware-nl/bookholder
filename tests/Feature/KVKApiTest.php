<?php

namespace Tests\Feature;

use App\Enums\Tests\KVKNumber;
use App\Models\Company;
use App\Services\KVKService;
use Tests\TestCase;

class KVKApiTest extends TestCase
{
    public function __construct(
        public string $name,
        private readonly KVKService $kvkService = new KVKService()
    ) {
        parent::__construct($name);
    }

    public function test_successful_main_companies_response(): void
    {
        foreach (KVKNumber::successCases() as $case) {
            $companyDTO = $this->kvkService->getCompanyDetails($case->value);

            $this->assertFalse($companyDTO === null);
        }
    }

    public function test_failed_main_companies_response(): void
    {
        foreach (KVKNumber::errorCases() as $case) {
            $kvkCompanyDTO = $this->kvkService->getCompanyDetails($case->value);

            $this->assertTrue($kvkCompanyDTO === null);
        }
    }

    public function test_insert_successful_kvk_into_company_table(): void
    {
        $companyDTO = $this->kvkService->getCompanyDetails(KVKNumber::SUCCESSFUL_EENMANSZAAK_RESPONSE->value);

        $company = new Company();

        $company->name = $companyDTO->getName();
        $company->kvk = $companyDTO->getKvk();
        $company->street_address = $companyDTO->getStreetAddress();
        $company->city = $companyDTO->getCity();
        $company->postal_code = $companyDTO->getPostalCode();
        $company->country = $companyDTO->getCountry();

        $this->assertTrue($company->name !== null);
        $this->assertTrue($company->kvk !== null);
        $this->assertTrue($company->street_address !== null);
        $this->assertTrue($company->city !== null);
        $this->assertTrue($company->postal_code !== null);
        $this->assertTrue($company->country !== null);
    }
}
