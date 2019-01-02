<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2019-01-01
 * Time: 13:58
 */

namespace Tests\Unit\MiamiOH;

use App\MiamiOH\RandomNumberPhp;
use PHPUnit\Framework\TestCase;

class RandomNumberPhpTest extends TestCase
{
    /** @var RandomNumberPhp */
    private $generator;

    public function setUp(): void
    {
        $this->generator = new RandomNumberPhp();
    }

    public function testGeneratesRandomInteger(): void
    {
        $number = $this->generator->generate();

        $this->assertIsInt($number);
    }

    /** @dataProvider limitProvider */
    public function testGeneratesRandomIntegersWithLimits(int $min, int $max): void
    {
        $number = $this->generator->generate($min, $max);

        $this->assertIsInt($number);
        $this->assertGreaterThanOrEqual($min, $number);
        $this->assertLessThanOrEqual($max, $number);
    }

    public function limitProvider(): array
    {
        return [
            [6, 10],
            [11, 20],
            [-10, 5],
        ];
    }
}
