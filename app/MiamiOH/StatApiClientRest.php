<?php


namespace App\MiamiOH;


use AG\ElasticApmLaravel\Facades\ApmAgent;
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
            [
                'Content-Type' => 'application/json',
            ],
            json_encode(['source' => $source])
        );

        $request = ApmAgent::addTraceParentHeader($request);

        $this->client->send($request);
    }

    public function getCount(string $source): int
    {
        $request = new Request(
            'GET',
            '/api/stats/' . $source,
            [
                'Content-Type' => 'application/json',
            ]
        );

        $request = ApmAgent::addTraceParentHeader($request);

        $response = $this->client->send($request);

        $data = json_decode($response->getBody()->getContents(), true);

        return $data['count'];
    }
}
