<?php

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     * @param $input
     * @param $expected
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, getUniqueFirstLetters($input));
    }

    public function positiveDataProvider()
    {
        return [
            [
                [
                    ["name" => "Unalaska Airport"],
                    ["name" => "Republic Airport"],
                    ["name" => "Lincoln Airport"],
                    ["name" => "Lanai Airport"],
                    ["name" => "Merrill Field"],
                    ["name" => "Arcata Airport"],
                    ["name" => "Unalakleet Airport"],
                    ["name" => "Modesto Airport"],

                ], ['A', 'L', 'M', 'R', 'U']],
        ];
    }
}
