<?php


namespace App\MiamiOH;


use AG\ElasticApmLaravel\Agent;
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
        /** @var Agent $agent */
        $agent = resolve(Agent::class);
        $transaction = $agent->currentTransaction();

        $request = new Request(
            'PUT',
            '/api/stats',
            [
                'Content-Type' => 'application/json',
                'ELASTIC-APM-TRACEPARENT' => $transaction->getDistributedTracing(),
            ],
            json_encode(['source' => $source])
        );

        $this->client->send($request);
    }

    public function getCount(string $source): int
    {
        /** @var Agent $agent */
        $agent = resolve(Agent::class);
        $transaction = $agent->currentTransaction();

        $request = new Request(
            'GET',
            '/api/stats/' . $source,
            [
                'Content-Type' => 'application/json',
                'ELASTIC-APM-TRACEPARENT' => $transaction->getDistributedTracing(),
            ]
        );

        $response = $this->client->send($request);

        $data = json_decode($response->getBody()->getContents(), true);

        return $data['count'];
    }
}
