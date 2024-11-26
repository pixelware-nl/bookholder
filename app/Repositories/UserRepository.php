<?php

namespace App\Repositories;

use App\DTO\UserDTO;
use App\Models\Company;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class UserRepository implements UserRepositoryInterface
{
    public function all(): Collection
    {
        return User::all();
    }

    public function company(): Company
    {
        return Auth::user()->company()->first();
    }

    public function companies(): Collection
    {
        return Auth::user()->companies()->get();
    }

    public function logs(): Collection
    {
        return Auth::user()->logs()->get();
    }

    public function store(UserDTO $userDTO): User
    {
        $fullname = strtolower(
            sprintf('%s %s', ucfirst($userDTO->getFirstname()), ucfirst($userDTO->getLastname()))
        );

        $email = strtolower($userDTO->getEmail());

        return User::create([
            'full_name' => $fullname,
            'email' => $email,
            'password' => Hash::make($userDTO->getPassword()),
            'company_id' => $userDTO->getCompanyId()
        ]);
    }
}
