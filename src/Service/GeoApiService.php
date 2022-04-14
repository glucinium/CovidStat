<?php

use App\Service\HttpApiService;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GeoApiService extends HttpApiService
{
    public function __construct(HttpClientInterface $httpclient)
    {
        parent::__construct($httpclient);
        $this->url = 'https://geo.api.gouv.fr/';
    }
}
