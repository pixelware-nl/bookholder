<?php

namespace App\Repositories\Interfaces;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;

    public function getCompany(): Company;

    public function getCompanies(): Collection;

    public function getLogs(): Collection;
}
