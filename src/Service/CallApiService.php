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
        return $this->getApi('france-by-date/13-04-2022');
    }

    public function getAllLiveData(): array
    {
        return $this->getApi('live/departements');
    }

    public function getDataByDepartmentByDate($department, $date): array
    {
        return $this->getApi('departement/'.$department.'/'.$date);
    }

    public function getDepartmentData($department): array
    {
        return $this->getApi('live/departement/'.$department);
    }

    public function getApi(string $uri): array
    {
        $response = $this->client->request(
                    'GET',
                    'https://coronavirusapifr.herokuapp.com/data/'.$uri
        );

        if ($response->getStatusCode() == 200) {
            return $response->toArray();
        } else {
            throw new Exception('Erreur lors de la requête sur : "'.$uri.'", status code : '.$response->getStatusCode());
        }
    }
}
