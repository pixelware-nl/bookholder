<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ApiService
{
    private function getRequest(string $url, array $headers = [], string ...$parameters, ): PromiseInterface|Response
    {
        return Http::withHeaders($headers)->get($url, $parameters);
    }

    /**
     * @throws ConnectionException
     */
    public function getJsonDecodedRequest(string $url, string ...$arguments): mixed
    {
        try {
            $request = $this->getRequest($url, $arguments);
        }
        catch (Exception) {
            throw new ConnectionException();
        }


        if ($request->status() !== ResponseAlias::HTTP_OK) {
            throw new ConnectionException();
        }

        return json_decode($request->body());
    }
}
