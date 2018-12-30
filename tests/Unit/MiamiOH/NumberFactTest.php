<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-30
 * Time: 11:02
 */

namespace Tests\Unit\MiamiOH;

use App\MiamiOH\NumberFact;
use PHPUnit\Framework\TestCase;

class NumberFactTest extends TestCase
{

    public function testReturnsNumberAssociatedWithFact(): void
    {
        $fact = new NumberFact();

        $this->assertEquals(5, $fact->number());
    }

    public function testReturnsStringAssociatedWithFact(): void
    {
        $fact = new NumberFact();

        $this->assertEquals('5 is the number of platonic solids.', $fact->string());
    }
}
