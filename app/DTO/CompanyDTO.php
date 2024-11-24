<?php

namespace App\DTO;

use App\DTO\Interfaces\DTOInterface;
use App\Models\Company;
use Illuminate\Http\Request;

final readonly class CompanyDTO implements DTOInterface
{
    public function __construct(
        private string $name,
        private string $kvk,
        private string $streetAddress,
        private string $city,
        private string $postalCode,
        private string $country,
    ) {}

    public function company(): Company
    {
        return new Company([
            'name' => $this->getName(),
            'kvk' => $this->getKvk(),
            'street_address' => $this->getStreetAddress(),
            'city' => $this->getCity(),
            'postal_code' => $this->getPostalCode(),
            'country' => $this->getCountry()
        ]);
    }

    public static function fromRequest(Request $request): CompanyDTO
    {
        return new self(
            $request->name,
            $request->kvk,
            $request->street_address,
            $request->city,
            $request->postal_code,
            $request->country
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'kvk' => $this->getKvk(),
            'street_address' => $this->getStreetAddress(),
            'city' => $this->getCity(),
            'postal_code' => $this->getPostalCode(),
            'country' => $this->getCountry()
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getKvk(): string
    {
        return $this->kvk;
    }

    public function getStreetAddress(): string {
        return $this->streetAddress;
    }

    public function getCity(): string {
        return $this->city;
    }

    public function getPostalCode(): string {
        return $this->postalCode;
    }

    public function getCountry(): string {
        return $this->country;
    }
}
