<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-31
 * Time: 11:41
 */

namespace Tests\Unit\MiamiOH;

use App\MiamiOH\RepositoryRest;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class RepositoryRestTest extends TestCase
{
    private $container = [];

    public function setUp(): void
    {
        parent::setUp();

        $this->container = [];
    }

    public function testMakesNumberMathRequestsWithContentTypeJson(): void
    {
        $client = $this->newHttpClientWithResponses([
            $this->newJsonResponse($this->newFactData([
                'number' => 5,
                'text' => '5 is the number of platonic solids.',
                'type' => 'math',
            ]))
        ]);

        $repository = new RepositoryRest($client);

        $repository->lookupNumberMathFact(5);

        $this->assertCount(1, $this->container);

        /** @var Request $request */
        $request = $this->container[0]['request'];
        $this->assertTrue($request->hasHeader('Content-Type'));
        $this->assertContains('application/json', $request->getHeader('Content-Type'));
    }

    public function testCanLookUpNumberFactForTypeMath(): void
    {
        $client = $this->newHttpClientWithResponses([
            $this->newJsonResponse($this->newFactData([
                'number' => 5,
                'text' => '5 is the number of platonic solids.',
                'type' => 'math',
            ]))
        ]);

        $repository = new RepositoryRest($client);

        $fact = $repository->lookupNumberMathFact(5);

        $this->assertEquals(5, $fact->number());
        $this->assertEquals('5 is the number of platonic solids.', $fact->text());
        $this->assertTrue($fact->found());
        $this->assertEquals('math', $fact->type());
    }

    public function testMakesDateRequestsWithContentTypeJson(): void
    {
        $client = $this->newHttpClientWithResponses([
            $this->newJsonResponse($this->newFactData([
                'number' => 5,
                'text' => '5 is the number of platonic solids.',
                'type' => 'math',
            ]))
        ]);

        $repository = new RepositoryRest($client);

        $repository->lookupDateFact(15, 10);

        $this->assertCount(1, $this->container);

        /** @var Request $request */
        $request = $this->container[0]['request'];
        $this->assertTrue($request->hasHeader('Content-Type'));
        $this->assertContains('application/json', $request->getHeader('Content-Type'));
    }

    public function testCanLookUpDateFact(): void
    {
        $client = $this->newHttpClientWithResponses([
            $this->newJsonResponse($this->newFactData([
                'number' => 288,
                'text' => 'October 15th is the day in 1582 that Pope Gregory XIII implements the Gregorian calendar.',
                'type' => 'date',
            ]))
        ]);

        $repository = new RepositoryRest($client);

        $fact = $repository->lookupDateFact(15, 10);

        $this->assertEquals(288, $fact->number());
        $this->assertEquals('October 15th is the day in 1582 that Pope Gregory XIII implements the Gregorian calendar.', $fact->text());
        $this->assertTrue($fact->found());
        $this->assertEquals('date', $fact->type());
    }

    private function newHttpClientWithResponses(array $responses): Client
    {
        $mock = new MockHandler($responses);

        $this->container = [];
        $history = Middleware::history($this->container);

        $handler = HandlerStack::create($mock);
        $handler->push($history);

        return new Client(['handler' => $handler]);
    }

    private function newJsonResponse(array $content, int $status = 200, array $headers = []): Response
    {
        $body = json_encode($content);

        if (empty($headers)) {
            $headers['content-type'] = 'application/json';
            $headers['content-length'] = strlen($body);
        }

        return new Response(
            $status,
            $headers,
            $body
        );
    }

    private function newFactData(array $data = []): array
    {
        $defaults = [
            'text' => '5 is the number of platonic solids.',
            'number' => 5,
            'found' => true,
            'type' => 'math',
        ];

        return array_merge($defaults, $data);
    }
}
