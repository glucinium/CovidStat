<?php

namespace App\Service;

use Exception;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getFranceData(): array
    {
        $response = $this->client->request(
                'GET',
                'https://coronavirusapifr.herokuapp.com/data/france-by-date/13-04-2022'
        );

        $statusCode = $response->getStatusCode();

        if ($statusCode == '200') {
            return $response->toArray();
        } else {
            throw new Exception('Echec de la requête, statusCode = '.$statusCode);
        }
    }

    public function fetch(): array
    {
        $response = $this->client->request(
                'GET',
                'https://api.github.com/repos/symfony/symfony-docs'
        );

        $statusCode = $response->getStatusCode();

        $contentType = $response->getHeaders()['content-type'][0];

        $content = $response->getContent();

        $content = $response->toArray();

        return $content;
    }
}
