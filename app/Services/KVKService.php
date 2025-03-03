<?php

namespace App\Services;

use App\DTO\AddressDTO;
use App\DTO\CompanyDTO;
use App\Enums\KVKAddressType;
use App\Enums\MethodType;
use App\External\ExternalClient;
use App\Models\Company;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;
use Sentry\EventHint;
use function Sentry\captureException;

class KVKService
{
    const BASIC_PROFILE_MAIN_COMPANY_URL = 'https://api.kvk.nl/test/api/v1/basisprofielen/%s/hoofdvestiging';

    public function __construct(
        private readonly ExternalClient $externalClient
    ) {}

    public function getCompanyDetails(string $kvk): ?Company
    {
        try {
            $response = $this->externalClient->request(
                self::BASIC_PROFILE_MAIN_COMPANY_URL,
                MethodType::GET,
                ['apiKey' => config('kvk.api_key')],
                $kvk
            );
        } catch (\Exception $e) {
            return null;
        }

        $address = $response->adressen[0];
        $addressDTO = $this->getAddress($address);

        $companyDTO = new CompanyDTO(
            $response->eersteHandelsnaam,
            $response->kvkNummer,
            null,
            $addressDTO->getStreetAddress(),
            $addressDTO->getCity(),
            $addressDTO->getPostalCode(),
            $addressDTO->getCountry(),
        );

        return $companyDTO->company();
    }

    public function redirectOnSuccess(string $kvk, string $route): RedirectResponse
    {
        $companyDTO = $this->getCompanyDetails($kvk);

        if ($companyDTO == null) {
            return redirect()->back()->withErrors([
                'kvk_to_find' => 'KVK niet gevonden.'
            ]);
        }

        return redirect()->route($route)->with(['company' => $companyDTO->company()]);
    }

    private function getAddress(object $address): ?AddressDTO
    {
        if ($address->type === KVKAddressType::CORRESPONDANCE->value) {
            $streetname = (property_exists($address, 'straatnaam'))
                ? $address->straatnaam
                : 'postbus';

            return new AddressDTO(
                sprintf('%s %s', $streetname, $address->postbusnummer),
                $address->plaats,
                $address->postcode,
                $address->land,
            );
        }

        if ($address->type === KVKAddressType::VISIT->value) {
            return new AddressDTO(
                sprintf('%s %s%s', $address->straatnaam, $address->huisnummer, $address->huisletter),
                $address->plaats,
                $address->postcode,
                $address->land,
            );
        }

        return null;
    }
}
