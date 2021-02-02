<?php

/**
 * The $minute variable contains a number from 0 to 59 (i.e. 10 or 25 or 60 etc).
 * Determine in which quarter of an hour the number falls.
 * Return one of the values: "first", "second", "third" and "fourth".
 * Throw InvalidArgumentException if $minute is negative of greater then 60.
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param  int  $minute
 * @return string
 * @throws InvalidArgumentException
 */
function getMinuteQuarter(int $minute)
{
    $res = ceil($minute / 15);

    if ($res == 1) {
        return "first";
    } elseif ($res == 2) {
        return "second";
    } elseif ($res == 3) {
        return "third";
    } elseif ($res == 4 || $res == 0) {
        return "fourth";
    } else {
        throw new InvalidArgumentException('Wrong number');
    }
}

/**
 * The $year variable contains a year (i.e. 1995 or 2020 etc).
 * Return true if the year is Leap or false otherwise.
 * Throw InvalidArgumentException if $year is lower then 1900.
 * @see https://en.wikipedia.org/wiki/Leap_year
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param  int  $year
 * @return boolean
 * @throws InvalidArgumentException
 */
function isLeapYear(int $year)
{
    if ($year <= 1900) {
        throw new InvalidArgumentException('Too lower number');
    }

    return $year % 4 ? false : true;
}

/**
 * The $input variable contains a string of six digits (like '123456' or '385934').
 * Return true if the sum of the first three digits is equal with the sum of last three ones
 * (i.e. in first case 1+2+3 not equal with 4+5+6 - need to return false).
 * Throw InvalidArgumentException if $input contains more then 6 digits.
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param  string  $input
 * @return boolean
 * @throws InvalidArgumentException
 */
function isSumEqual(string $input)
{
    if (strlen($input) === 6) {
        list($first_digits, $last_digits) = str_split($input, 3);

        $res_first = array_sum(str_split($first_digits));
        $res_last = array_sum(str_split($last_digits));

        return $res_first == $res_last ? true : false;
    }

    throw new InvalidArgumentException('Too many digits');
}
