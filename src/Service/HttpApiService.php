<?php

namespace App\Service;

use Exception;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpApiService
{
    private $client;
    private $url;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getApi(string $uri): array
    {
        $response = $this->client->request(
                    'GET',
                    $this->url.$uri
        );

        if ($response->getStatusCode() == 200) {
            return $response->toArray();
        } else {
            throw new Exception('Erreur lors de la requête sur : "'.$this->url.$uri.'", sur ". status code : '.$response->getStatusCode());
        }
    }
}
