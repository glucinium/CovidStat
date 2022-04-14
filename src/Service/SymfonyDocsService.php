<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class SymfonyDocsService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetchGitHubInformation(): array
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
