<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($arg)
    {
        $this->expectException(InvalidArgumentException::class);

        sayHelloArgumentWrapper($arg);
    }
    public function positiveDataProvider()
    {
        return [
            [[]],
            [['string']],
            [null],
            [(object) 'object'],
        ];
    }
}
