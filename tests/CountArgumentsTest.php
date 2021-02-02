<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     * @param $arg
     * @param $expected
     */
    public function testPositive($arg, $expected)
    {
        $this->assertEquals($expected, countArguments(...$arg));
    }

    public function positiveDataProvider()
    {
        return [
            [[], ['argument_count' => 0, 'argument_values' => []]],
            [['string'], ['argument_count' => 1, 'argument_values' => ['string']]],
            [['couple', 'string'], ['argument_count' => 2, 'argument_values' => ['couple', 'string']]],
        ];
    }

}
