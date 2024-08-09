<?php

namespace App\Services;

use App\DTO\AddressDTO;
use App\Enums\KVKAddressType;
use App\Models\Company;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class KVKService
{
    const BASIC_PROFILE_MAIN_COMPANY_URL = 'https://api.kvk.nl/test/api/v1/basisprofielen/%s/hoofdvestiging';

    /**
     * @throws ConnectionException
     */
    public function getCompanyDetails($kvk): JsonResponse
    {
        try {
            $response = $this->getJsonDecodedRequest(self::BASIC_PROFILE_MAIN_COMPANY_URL, $kvk);
        } catch (ConnectionException $exception) {
            return response()->json()->setStatusCode(ResponseAlias::HTTP_BAD_REQUEST);
        }

        $address = $response->adressen[0];
        $addressDTO = $this->getAddress($address);

        return response()->json()->setData([
            'company' => new Company([
                'name' => $response->eersteHandelsnaam,
                'kvk' => $response->kvkNummer,
                'street_address' => $addressDTO->getStreetAddress(),
                'city' => $addressDTO->getCity(),
                'postal_code' => $addressDTO->getPostalCode(),
                'country' => $addressDTO->getCountry(),
            ])
        ])->setStatusCode(ResponseAlias::HTTP_OK);
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
        $request = $this->getRequest($url, $kvk);

        if ($request->status() !== ResponseAlias::HTTP_OK) {
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
