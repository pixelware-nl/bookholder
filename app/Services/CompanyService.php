<?php

namespace App\Services;

use App\DTO\CompanyDTO;
use App\Exceptions\InvalidArrayParamsException;
use App\Models\Company;
use App\Models\UserCompany;
use App\Repositories\CompanyRepository;

readonly class CompanyService
{
    public function __construct(
        private CompanyRepository $companyRepository
    ) {}

    public function findByKvk(string $kvk): ?Company
    {
        return $this->companyRepository->findByKvk($kvk);
    }

    public function storeOrGet(CompanyDTO $companyDTO): Company
    {
        return $this->companyRepository->storeOrGet($companyDTO->toArray());
    }

    /**
     * @throws InvalidArrayParamsException
     */
    public function store(CompanyDTO $companyDTO): Company
    {
        return $this->companyRepository->store($companyDTO);
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
