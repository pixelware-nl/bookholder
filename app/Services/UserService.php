<?php

namespace App\Services;

use App\Models\Company;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function all(): Collection
    {
        return $this->userRepository->all();
    }

    public function logs(): Collection
    {
        return $this->userRepository->logs();
    }

    public function company(): Company
    {
        return $this->userRepository->company();
    }

    public function companies(): Collection
    {
        return $this->userRepository->companies();
    }

    public function store($userDTO): User
    {
        return $this->userRepository->store($userDTO);
    }
}
