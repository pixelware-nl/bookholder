<?php

namespace App\Repositories;

use App\DTO\UserDTO;
use App\Models\Company;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserRepository implements UserRepositoryInterface
{
    public function all(): Collection
    {
        return User::all();
    }

    public function getCompany(): Company
    {
        return Auth::user()->company()->first();
    }

    public function getCompanies(): Collection
    {
        return Auth::user()->companies()->get();
    }

    public function getLogs(): Collection
    {
        return Auth::user()->logs()->get();
    }

    public function store(UserDTO $userDTO): User
    {
        $fullname = strtolower(
            sprintf('%s %s', ucfirst($userDTO->firstname), ucfirst($userDTO->lastname))
        );

        $email = strtolower($userDTO->email);

        return User::create([
            'full_name' => $fullname,
            'email' => $email,
            'password' => \Hash::make($userDTO->password),
            'company_id' => $userDTO->company_id
        ]);
    }
}
