<?php

namespace App\Repositories\Interfaces;

use App\DTO\CompanyDTO;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface CompanyRepositoryInterface
{
    public function all(): Collection;

    public function findByUser(User $user): Collection;

    public function findByKvk(string $kvk): ?Company;

    public function store(CompanyDTO $companyDTO): Company;

    public function storeOrGet(array $array): Company;

    public function attach(Company $company): Company;

    public function detach(Company $company): void;
}
