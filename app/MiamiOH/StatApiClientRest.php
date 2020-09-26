<?php


namespace App\MiamiOH;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class StatApiClientRest implements StatApiClient
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function incrementCount(string $source): void
    {
        $request = new Request(
            'PUT',
            '/api/stats',
            ['Content-Type' => 'application/json'],
            json_encode(['source' => $source])
        );

        $this->client->send($request);
    }

    public function getCount(string $source): int
    {
        $request = new Request(
            'GET',
            '/api/stats/' . $source,
            ['Content-Type' => 'application/json']
        );

        $response = $this->client->send($request);

        $data = json_decode($response->getBody()->getContents(), true);

        return $data['count'];
    }
}