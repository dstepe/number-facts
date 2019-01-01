<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-31
 * Time: 11:01
 */

namespace Tests\Unit\MiamiOH;

use App\MiamiOH\NumberFact;
use App\MiamiOH\NumberFactDataTransferObject;
use App\MiamiOH\NumberFactFinder;
use App\MiamiOH\RandomNumberEnv;
use App\MiamiOH\Repository;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class NumberFactFinderTest extends TestCase
{
    /** @var NumberFactFinder */
    private $finder;

    /** @var Repository|MockObject */
    private $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->createMock(Repository::class);

        $this->finder = new NumberFactFinder($this->repository, new RandomNumberEnv());
    }

    /** @dataProvider integerFactProvider */
    public function testFindsNumberFactByInteger(int $number, string $factString): void
    {
        $this->repository
            ->expects($this->once())
            ->method('lookupNumberMathFact')
            ->with($this->equalTo($number))
            ->willReturn($this->newFactDataTransferObject([
                'number' => $number,
                'text' => $factString,
            ]));

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
        $this->repository
            ->expects($this->once())
            ->method('lookupDateFact')
            ->with($this->equalTo($day), $this->equalTo($month))
            ->willReturn($this->newFactDataTransferObject([
                'number' => $expected['dayOfYear'],
                'text' => $expected['fact'],
            ]));

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
                    'dayOfYear' => 288,
                    'number' => 'October 15',
                    'fact' => 'October 15th is the day in 1582 that Pope Gregory XIII implements the Gregorian calendar.',
                ]
            ],
            [
                3,
                4,
                [
                    'dayOfYear' => 93,
                    'number' => 'April 3',
                    'fact' => 'April 3rd is the day in 1981 that the Osborne 1, the first successful portable computer, is unveiled at the West Coast Computer Faire in San Francisco.',
                ]
            ],
        ];
    }

    public function testFindsFactForRandomInteger(): void
    {
        $number = 7;
        $factString = '7 is a good number';

        putenv('RANDOM_NUMBER=' . $number);

        $this->repository
            ->expects($this->once())
            ->method('lookupNumberMathFact')
            ->with($this->equalTo($number))
            ->willReturn($this->newFactDataTransferObject([
                'number' => $number,
                'text' => $factString,
            ]));

        $fact = $this->finder->findRandomIntegerFact();

        $this->assertInstanceOf(NumberFact::class, $fact);
        $this->assertEquals($number, $fact->number());
        $this->assertEquals($factString, $fact->string());
    }

    private function newFactDataTransferObject(array $data = []): NumberFactDataTransferObject
    {
        $defaults = [
            'text' => '5 is the number of platonic solids.',
            'number' => 5,
            'found' => true,
            'type' => 'math',
        ];

        return NumberFactDataTransferObject::fromArray(array_merge($defaults, $data));
    }
}
