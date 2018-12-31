<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-31
 * Time: 11:01
 */

namespace Tests\Unit\MiamiOH;

use App\MiamiOH\NumberFact;
use App\MiamiOH\NumberFactFinder;
use PHPUnit\Framework\TestCase;

class NumberFactFinderTest extends TestCase
{
    /** @var NumberFactFinder */
    private $finder;

    public function setUp(): void
    {
        parent::setUp();

        $this->finder = new NumberFactFinder();
    }

    /** @dataProvider integerFactProvider */
    public function testFindsNumberFactByInteger(int $number, string $factString): void
    {
        $fact = $this->finder->findByInteger($number);

        $this->assertInstanceOf(NumberFact::class, $fact);
        $this->assertEquals($number, $fact->number());
        $this->assertEquals($factString, $fact->string());
    }

    public function integerFactProvider(): array
    {
        return [
            [5, '5 is the number of platonic solids.'],
            [10, '10 is the number of n-Queens Problem solutions for n = 5.'],
        ];
    }

    /** @dataProvider dayMonthFactProvider */
    public function testFindsNumberFactByDayAndMonth(int $day, int $month, array $expected): void
    {
        $fact = $this->finder->findByDayAndMonth($day, $month);

        $this->assertInstanceOf(NumberFact::class, $fact);
        $this->assertEquals($expected['number'], $fact->number());
        $this->assertEquals($expected['fact'], $fact->string());
    }

    public function dayMonthFactProvider(): array
    {
        return [
            [
                15,
                10,
                [
                    'number' => 'October 15',
                    'fact' => 'October 15th is the day in 1582 that Pope Gregory XIII implements the Gregorian calendar.',
                ]
            ],
            [
                3,
                4,
                [
                    'number' => 'April 3',
                    'fact' => 'April 3rd is the day in 1981 that the Osborne 1, the first successful portable computer, is unveiled at the West Coast Computer Faire in San Francisco.',
                ]
            ],
        ];
    }
}
