<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LookupTest extends TestCase
{
    public function testShowsNumberInput()
    {
        $response = $this->get('/lookup');

        $response->assertStatus(200);
        $response->assertSee('Enter a number to lookup:');
    }

    public function testVisitorCanSubmitNumberToLookup()
    {
        $response = $this->post('/lookup', ['number' => 10]);

        $response->assertStatus(200);
        $response->assertSee('Fact for the number 10.');
        $response->assertSee('10 is the number of n-Queens Problem solutions for n = 5.');
    }
}
