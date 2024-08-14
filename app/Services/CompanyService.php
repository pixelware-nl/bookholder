<?php

namespace App\Services;

use App\DTO\CompanyDTO;
use App\Exceptions\InvalidArrayParamsException;
use App\Models\Company;
use App\Models\UserCompany;

class CompanyService
{
    /**
     * @throws InvalidArrayParamsException
     */
    public function createForAuth(CompanyDTO $companyDTO): Company
    {
        $company = Company::createOrGet($companyDTO->toArray());

        return $this->attachToAuth($company);
    }

    public function attachToAuth(Company $company): Company
    {
        $userCompany = UserCompany::authFind($company->id);

        if ($userCompany->exists()) {
            $userCompany->restore();

            return $company;
        }

        UserCompany::authCreate($company->id);

        return $company;
    }
}
