<?php

namespace App\DTO;

use App\DTO\Interfaces\DTOInterface;
use Illuminate\Http\Request;

final readonly class UserDTO implements DTOInterface
{
    public function __construct(
        private string $firstname,
        private string $lastname,
        private string $email,
        private string $password,
        private int $company_id
    ) {}

    public static function fromRequest(Request $request)
    {
        return new self(
            $request->firstname,
            $request->lastname,
            $request->email,
            $request->password,
            $request->company_id
        );
    }

    public function toArray(): array
    {
        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'password' => $this->password,
            'company_id' => $this->company_id
        ];
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCompanyId(): int
    {
        return $this->company_id;
    }
}
