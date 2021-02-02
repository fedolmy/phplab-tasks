<?php

use PHPUnit\Framework\TestCase;

class SayHelloTest extends TestCase
{
    /**
     * @see https://www.php.net/manual/en/function.return.php
     */
    public function testPositive()
    {
        $this->assertEquals('Hello', sayHello());
    }
}
