<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2019-01-01
 * Time: 14:14
 */

namespace Tests\Unit\MiamiOH;

use App\MiamiOH\RandomNumberEnv;
use PHPUnit\Framework\TestCase;

class RandomNumberEnvTest extends TestCase
{

    /** @var RandomNumberEnv */
    private $generator;

    public function setUp(): void
    {
        $this->generator = new RandomNumberEnv();
    }

    public function testReturnsValueFromEnvironment(): void
    {
        putenv('RANDOM_NUMBER=10');

        $this->assertEquals(10, $this->generator->generate());
    }
}
