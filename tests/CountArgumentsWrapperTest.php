<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive(...$arg)
    {
        $this->expectException(InvalidArgumentException::class);

        countArgumentsWrapper(...$arg);
    }

    public function positiveDataProvider()
    {
        return [
            [],
            [['world']],
            [1, 2],
            [null],
            [true, '123'],
            ['false', 1],
            ['1', 2],
            [(object) 'object'],
        ];
    }
}
