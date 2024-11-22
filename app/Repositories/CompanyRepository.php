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

    /**
     * @throws InvalidArrayParamsException
     */
    public function store(CompanyDTO $companyDTO): Company
    {
        return $this->attach(
            $this->storeOrGet($companyDTO->toArray())
        );
    }

    /**
     * @throws InvalidArrayParamsException
     */
    public function storeOrGet(array $array): Company
    {
        $required = ['name', 'kvk', 'street_address', 'city', 'postal_code', 'country'];

        if (ValidationHelper::isMissingRequiredArrayParams($required, $array)) {
            throw new InvalidArrayParamsException();
        }

        $company = Company::fromKvk($array['kvk']);

        if ($company->exists()) {
            return $company->first();
        }

        return Company::create($array);
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
