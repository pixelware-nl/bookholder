<?php

namespace App\DTO;

use App\Exceptions\InvalidRequestToDTOException;
use App\Helpers\ValidationHelper;
use App\Models\Company;
use Illuminate\Http\Request;

final class CompanyDTO implements DTOInterface
{
    private const REQUIRED_ARRAY_PARAMS = [
        'name',
        'kvk',
        'street_address',
        'city',
        'postal_code',
        'country'
    ];

    public function __construct(
        private readonly string $name,
        private readonly string $kvk,
        private readonly string $streetAddress,
        private readonly string $city,
        private readonly string $postalCode,
        private readonly string $country,
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

    /**
     * @throws InvalidRequestToDTOException
     */
    public static function fromRequest(Request $request): CompanyDTO
    {
        if (ValidationHelper::isMissingRequiredRequestParams(self::REQUIRED_ARRAY_PARAMS, $request)) {
            throw new InvalidRequestToDTOException();
        }

        return new self(
            $request->input('name'),
            $request->input('kvk'),
            $request->input('street_address'),
            $request->input('city'),
            $request->input('postal_code'),
            $request->input('country')
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
