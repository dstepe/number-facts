<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DateLookupTest extends TestCase
{
    public function testShowsDateInput()
    {
        $response = $this->get('/date-lookup');

        $response->assertStatus(200);
        $response->assertSee('Enter a date to lookup:');
    }

    public function testVisitorCanSubmitDateToLookup()
    {
        $response = $this->post('/date-lookup', ['month' => 10, 'day' => 15]);

        $response->assertStatus(200);
        $response->assertSee('Fact for the date October 15.');
        $response->assertSee('October 15th is the day in 1582 that Pope Gregory XIII implements the Gregorian calendar.');
    }
}
