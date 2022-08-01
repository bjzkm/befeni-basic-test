<?php

use Bj\Test\Math;
use PHPUnit\Framework\TestCase;

final class MathTest extends TestCase
{
    public function testAddAndMultiply()
    {
        $content = "add 2\n multiply 3\n apply 3";
        $math = new Math();
        $result = $math->init($content);
        $this->assertEquals(15, $result);
    }

    public function testPow()
    {
        $content = "pow 2\n apply 4";
        $math = new Math();
        $result = $math->init($content);
        $this->assertEquals(16, $result);
    }

    public function testSubDivide()
    {
        $content = "sub 10\n divide 2\n apply 2";
        $math = new Math();
        $result = $math->init($content);
        $this->assertEquals(4, $result);
    }

    public function testAddSub()
    {
        $content = "add 10\n sub 2\n apply 7";
        $math = new Math();
        $result = $math->init($content);
        $this->assertEquals(5, $result);
    }
}
