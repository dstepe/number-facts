<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-30
 * Time: 11:02
 */

namespace Tests\Unit\MiamiOH;

use App\MiamiOH\NumberFactDate;
use Tests\TestCase;

class NumberFactDateTest extends TestCase
{

    /** @var NumberFactDate */
    private $fact;

    public function setUp(): void
    {
        parent::setUp();

        $this->fact = new NumberFactDate(15, 10, 'October 15th is the day in 1582 that Pope Gregory XIII implements the Gregorian calendar.');
    }

    public function testReturnsDateAssociatedWithFact(): void
    {
        $this->assertEquals('October 15', $this->fact->number());
    }

    public function testReturnsStringAssociatedWithFact(): void
    {
        $this->assertEquals('October 15th is the day in 1582 that Pope Gregory XIII implements the Gregorian calendar.', $this->fact->string());
    }

    /** @dataProvider monthDayProvider */
    public function testConvertsNumericMonthDayInputsToString(int $day, int $month, string $string): void
    {
        $fact = new NumberFactDate($day, $month, 'Test fact string');

        $this->assertEquals($string, $fact->number());
    }

    public function monthDayProvider(): array
    {
        return [
          [15, 10, 'October 15'],
          [3, 3, 'March 3'],
          [23, 5, 'May 23'],
          [7, 8, 'August 7'],
          [1, 7, 'July 1'],
        ];
    }
}
