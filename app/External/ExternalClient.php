<?php

namespace App\External;

use App\Enums\MethodType;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

readonly class ExternalClient
{
    /**
     * @throws ConnectionException
     */
    public function do(string $url, MethodType $method, array $headers = [], ...$parameters): PromiseInterface|Response
    {
        return match ($method) {
            MethodType::POST => Http::withHeaders($headers)->post(sprintf($url, ...$parameters)),
            default => Http::withHeaders($headers)->get(sprintf($url, ...$parameters)),
        };
    }

    public function request(string $url, MethodType $method, array $headers, ...$parameters)
    {
        try {
            $response = $this->do($url, $method, $headers, ...$parameters);
        } catch (\Exception $exception) {
            throw new $exception;
        }

        if ($response->status() !== ResponseAlias::HTTP_OK) {
            throw new ConnectionException;
        }

        return json_decode($response->body());
    }
}
