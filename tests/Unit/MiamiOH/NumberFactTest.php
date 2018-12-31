<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-30
 * Time: 11:02
 */

namespace Tests\Unit\MiamiOH;

use App\MiamiOH\NumberFact;
use Tests\TestCase;

class NumberFactTest extends TestCase
{

    /** @var NumberFact */
    private $fact;

    public function setUp(): void
    {
        parent::setUp();

        $this->fact = new NumberFact(5, '5 is the number of platonic solids.');
    }

    public function testReturnsNumberAssociatedWithFact(): void
    {
        $this->assertEquals(5, $this->fact->number());
    }

    public function testReturnsStringAssociatedWithFact(): void
    {
        $this->assertEquals('5 is the number of platonic solids.', $this->fact->string());
    }
}
