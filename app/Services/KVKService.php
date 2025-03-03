<?php

namespace App\Services;

use App\DTO\AddressDTO;
use App\DTO\CompanyDTO;
use App\Enums\KVKAddressType;
use App\Models\Company;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Http\RedirectResponse;
use Sentry\Severity;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class KVKService
{
    const BASIC_PROFILE_MAIN_COMPANY_URL = 'https://api.kvk.nl/test/api/v1/basisprofielen/%s/hoofdvestiging';

    public function __construct(
       private readonly SentryService $sentryService
    ) {}

    public function getCompanyDetails(string $kvk): ?Company
    {
        try {
            $response = $this->getJsonDecodedRequest(self::BASIC_PROFILE_MAIN_COMPANY_URL, $kvk);
        } catch (ConnectionException $exception) {
            $this->sentryService->log($exception);
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

    /**
     * @throws ConnectionException
     */
    private function getJsonDecodedRequest(string $url, string $kvk): mixed
    {
        try {
            $request = $this->getRequest($url, $kvk);
        }
        catch (\Exception $exception) {
            $this->sentryService->log($exception);
            throw new ConnectionException();
        }

        if ($request->status() !== ResponseAlias::HTTP_OK) {
            $this->sentryService->log(
                sprintf(
                    'KVK API returned status code: %s, expected: %s',
                    $request->status(),
                    ResponseAlias::HTTP_OK
                ),
                Severity::warning()
            );
            throw new ConnectionException();
        }

        return json_decode($this->getRequest($url, $kvk)->body());
    }

    /**
     * @throws ConnectionException
     */
    private function getRequest(string $url, string $kvk): PromiseInterface|Response
    {
        return \Http::withHeaders([
            'apikey' => config('kvk.api_key')
        ])->get(sprintf($url, $kvk));
    }
}
