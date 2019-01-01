<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-31
 * Time: 11:41
 */

namespace Tests\Unit\MiamiOH;

use App\MiamiOH\Repository;
use App\MiamiOH\RepositoryYaml;
use Tests\TestCase;

class RepositoryYamlTest extends TestCase
{
    /** @var RepositoryYaml */
    private $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = new RepositoryYaml(base_path() . '/' . env('DATA_DIR', 'data'));
    }

    public function testCanLookUpNumberFactForTypeMath(): void
    {
        $fact = $this->repository->lookupNumberMathFact(5);

        $this->assertEquals(5, $fact->number());
        $this->assertEquals('5 is the number of platonic solids.', $fact->text());
        $this->assertTrue($fact->found());
        $this->assertEquals('math', $fact->type());
    }

    public function testCanLookUpDateFact(): void
    {
        $fact = $this->repository->lookupDateFact(15, 10);

        $this->assertEquals(288, $fact->number());
        $this->assertEquals('October 15th is the day in 1582 that Pope Gregory XIII implements the Gregorian calendar.', $fact->text());
        $this->assertTrue($fact->found());
        $this->assertEquals('date', $fact->type());
    }
}
