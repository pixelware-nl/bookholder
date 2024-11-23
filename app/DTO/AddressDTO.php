<?php

namespace App\DTO;

use App\DTO\Interfaces\DTOInterface;
use App\Exceptions\InvalidRequestToDTOException;
use App\Helpers\ValidationHelper;
use Illuminate\Http\Request;

final readonly class AddressDTO implements DTOInterface
{
    public function __construct(
        private string $streetAddress,
        private string $city,
        private string $postalCode,
        private string $country,
    ) {}

    public static function fromRequest(Request $request): AddressDTO
    {
        return new self(
            $request->street_address,
            $request->city,
            $request->postal_code,
            $request->country,
        );
    }

    public function toArray(): array
    {
        return [
            'street_address' => $this->getStreetAddress(),
            'city' => $this->getCity(),
            'postal_code' => $this->getPostalCode(),
            'country' => $this->getCountry(),
        ];
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
