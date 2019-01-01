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
}
