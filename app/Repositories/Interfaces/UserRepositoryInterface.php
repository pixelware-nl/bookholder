<?php

namespace App\Repositories\Interfaces;

use App\DTO\UserDTO;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;

    public function company(): Company;

    public function companies(): Collection;

    public function logs(): Collection;

    public function store(UserDTO $userDTO): User;
}
