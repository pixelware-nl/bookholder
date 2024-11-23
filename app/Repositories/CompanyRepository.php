<?php

namespace App\Repositories;

use App\DTO\CompanyDTO;
use App\Exceptions\InvalidArrayParamsException;
use App\Helpers\ValidationHelper;
use App\Models\Company;
use App\Models\User;
use App\Models\UserCompany;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository implements CompanyRepositoryInterface
{

    public function all(): Collection
    {
        return Company::all();
    }

    public function findByUser(User $user): Collection
    {
        return Company::where('user_id', $user->id)->get();
    }

    public function findByKvk(string $kvk): ?Company
    {
        return Company::fromKvk($kvk)->first();
    }

    public function store(CompanyDTO $companyDTO): Company
    {
        return $this->attach(
            $this->storeOrGet($companyDTO)
        );
    }

    public function storeOrGet(CompanyDTO $companyDTO): Company
    {
        $company = Company::fromKvk($companyDTO->getKvk());

        if ($company->exists()) {
            return $company->first();
        }

        return Company::create($companyDTO->toArray());
    }

    public function attach(Company $company): Company
    {
        $userCompany = UserCompany::authFind($company->id);

        if ($userCompany->exists()) {
            $userCompany->restore();

            return $company;
        }

        UserCompany::authCreate($company->id);

        return $company;
    }

    public function detach(Company $company): void
    {
        UserCompany::authFind($company->id)->delete();
    }
}
