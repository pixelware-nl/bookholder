<?php

namespace App\DTO;

use App\Exceptions\InvalidRequestToDTOException;
use App\Helpers\ValidationHelper;
use Illuminate\Http\Request;

final class AddressDTO implements DTOInterface
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

    /**
     * @throws InvalidRequestToDTOException
     */
    public static function fromRequest(Request $request): AddressDTO
    {
        if (ValidationHelper::isMissingRequiredRequestParams(['street_address', 'city', 'postal_code', 'country'], $request)) {
            throw new InvalidRequestToDTOException();
        }

        return new self(
            $request->input('street_address'),
            $request->input('city'),
            $request->input('postal_code'),
            $request->input('country'),
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
}
