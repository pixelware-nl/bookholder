<?php

namespace App\Services;

use App\Models\Company;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;

class KVKService
{
    const BASIC_PROFILE_MAIN_COMPANY_URL = 'https://api.kvk.nl/test/api/v1/basisprofielen/%s/hoofdvestiging';

    /**
     * @throws ConnectionException
     */
    public function getCompanyDetails($kvk): Company
    {
        if (is_null($kvk)) {

            return new Company();
        }

        $response = $this->getJsonDecodedRequest(self::BASIC_PROFILE_MAIN_COMPANY_URL, $kvk);

        $address = $response->adressen[0];

        return new Company([
            'name' => $response->eersteHandelsnaam,
            'kvk' => $response->kvkNummer,
            'street_address' => sprintf('%s %s%s', $address->straatnaam, $address->huisnummer, $address->huisletter),
            'city' => $address->plaats,
            'postal_code' => $address->postcode,
            'country' => $address->land,
        ]);
    }

    /**
     * @throws ConnectionException
     */
    private function getJsonDecodedRequest(string $url, string $kvk)
    {
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
