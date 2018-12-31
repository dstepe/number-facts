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
}
