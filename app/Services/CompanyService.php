<?php

namespace App\Services;

use App\DTO\CompanyDTO;
use App\Models\Company;
use App\Repositories\CompanyRepository;

readonly class CompanyService
{
    public function __construct(
        private CompanyRepository $companyRepository,
        private KVKService $kvkService
    ) {}

    public function findByKvk(string $kvk): ?Company
    {
        $internalSearch = $this->companyRepository->findByKvk($kvk);

        if ($internalSearch !== null) {
            return $internalSearch;
        }

        return $this->kvkService->getCompanyDetails($kvk);
    }

    public function storeOrGet(CompanyDTO $companyDTO): Company
    {
        return $this->companyRepository->storeOrGet($companyDTO);
    }

    public function store(CompanyDTO $companyDTO): Company
    {
        return $this->companyRepository->store($companyDTO);
    }

    public function update(Company $company, CompanyDTO $companyDTO): Company
    {
        return $this->companyRepository->update($company, $companyDTO);
    }

    public function attach(Company $company): Company
    {
        return $this->companyRepository->attach($company);
    }

    public function detach(Company $company): void
    {
        $this->companyRepository->detach($company);
    }
}
