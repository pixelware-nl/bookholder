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

    public function getLogs(): Collection
    {
        return $this->userRepository->getLogs();
    }

    public function getCompany(): Company
    {
        return $this->userRepository->getCompany();
    }

    public function getCompanies(): Collection
    {
        return $this->userRepository->getCompanies();
    }

    public function store($userDTO): User
    {
        return $this->userRepository->store($userDTO);
    }
}
