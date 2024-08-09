<?php

namespace App\DTO;

class AddressDTO
{
    public function __construct(
        private readonly string $streetAddress,
        private readonly string $city,
        private readonly string $postalCode,
        private readonly string $country,
    ) {}

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
