<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    public function testShowsNumberAndFact()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Fact for the number 5.');
        $response->assertSee('5 is the number of platonic solids.');
    }

    public function testShowsDateAndFact()
    {
        $day = 15;
        $month = 10;

        Carbon::setTestNow(Carbon::createFromDate((int) date('Y'), $month, $day));

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Fact for the date October 15.');
        $response->assertSee('October 15th is the day in 1582 that Pope Gregory XIII implements the Gregorian calendar.');
    }
}
