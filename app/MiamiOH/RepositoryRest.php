<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-31
 * Time: 12:04
 */

namespace App\MiamiOH;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class RepositoryRest implements Repository
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function lookupNumberMathFact(int $number): NumberFactDataTransferObject
    {
        $data = $this->getFactFromApi($number . '/math');

        return NumberFactDataTransferObject::fromArray($data);
    }

    public function lookupDateFact(int $day, int $month): NumberFactDataTransferObject
    {
        $data = $this->getFactFromApi($month . '/' . $day . '/date');

        return NumberFactDataTransferObject::fromArray($data);
    }

    private function getFactFromApi(string $path): array
    {
        $request = new Request(
            'GET',
            'http://numbersapi.com/' . $path,
            ['Content-Type' => 'application/json']
        );

        $response = $this->client->send($request);

        return json_decode($response->getBody()->getContents(), true);
    }

}
