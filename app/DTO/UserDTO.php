<?php

namespace App\DTO;

use App\DTO\Interfaces\DTOInterface;
use Illuminate\Http\Request;

class UserDTO implements DTOInterface
{
    public function __construct(
        public string $firstname,
        public string $lastname,
        public string $email,
        public string $password,
        public int $company_id
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
}
