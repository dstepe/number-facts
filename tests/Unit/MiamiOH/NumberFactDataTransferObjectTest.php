<?php
/**
 * Created by PhpStorm.
 * User: tepeds
 * Date: 2018-12-31
 * Time: 11:52
 */

namespace Tests\Unit\MiamiOH;

use App\MiamiOH\NumberFactDataTransferObject;
use Tests\TestCase;

class NumberFactDataTransferObjectTest extends TestCase
{

    public function testCanBeCreatedFromArray(): void
    {
        $data = [
            'text' => '5 is the number of platonic solids.',
            'number' => 5,
            'found' => true,
            'type' => 'math',
        ];

        $transferObject = NumberFactDataTransferObject::fromArray($data);

        $this->assertEquals('5 is the number of platonic solids.', $transferObject->text());
        $this->assertEquals(5, $transferObject->number());
        $this->assertTrue($transferObject->found());
        $this->assertEquals('math', $transferObject->type());
    }
}
