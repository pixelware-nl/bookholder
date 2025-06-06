<?php

namespace App\Repositories;

use App\DTO\CompanyDTO;
use App\Models\Company;
use App\Models\User;
use App\Models\UserCompany;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

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
        return Company::where('kvk', $kvk)->first();
    }

    public function store(CompanyDTO $companyDTO): Company
    {
        return $this->attach(
            $this->storeOrGet($companyDTO)
        );
    }

    public function update(Company $company, CompanyDTO $companyDTO): Company
    {
        $company->update($companyDTO->toArray());

        return $company;
    }

    public function storeOrGet(CompanyDTO $companyDTO): Company
    {
        $company = Company::where('kvk', $companyDTO->getKvk());

        if ($company->exists()) {
            return $company->first();
        }

        return Company::create($companyDTO->toArray());
    }

    public function attach(Company $company): Company
    {
        $userCompany = UserCompany::where('user_id', Auth::id())->where('company_id', $company->id);

        if ($userCompany->exists()) {
            $userCompany->restore();

            return $company;
        }

        UserCompany::create([
            'user_id' => Auth::id(),
            'company_id' => $company->id,
        ]);

        return $company;
    }

    public function detach(Company $company): void
    {
        UserCompany::where('user_id', Auth::id())->where('company_id', $company->id)->delete();
    }
}
