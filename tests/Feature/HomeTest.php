<?php

namespace Tests\Feature;

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
}
