<?php

namespace App\DTO;

final class CompanyDTO extends AbstractDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $kvk,
        private readonly string $streetAddress,
        private readonly string $city,
        private readonly string $postalCode,
        private readonly string $country,
    ) {}

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
