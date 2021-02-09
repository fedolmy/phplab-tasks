<?php
/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param  array  $airports
 * @return string[]
 */
function getUniqueFirstLetters(array $airports): array
{
    $first_letters = [];

    foreach ($airports as $v) {
        if (!in_array($v['name'][0], $first_letters)) {
            array_push($first_letters, $v['name'][0]);
        }

    }
    sort($first_letters);

    return $first_letters;
}

/**
 * @param  array  $airports
 * @param  string  $letter
 * @return array
 */
function filterByLetter(array $airports, $letter): array
{
    return array_filter($airports, function ($airport) use ($letter) {
        return $airport['name'][0] === $letter;
    });
}

/**
 * @param  array  $airports
 * @param  string  $state
 * @return array
 */
function filterByState(array $airports, $state): array
{
    return array_filter($airports, function ($airport) use ($state) {
        return $airport['state'] === $state;
    });
}

/**
 * @param  string  $key
 * @return object
 */
function sortByKeyValue(string $key): object
{
    return function ($a, $b) use ($key) {
        return strcmp($a[$key], $b[$key]);
    };
}

/**
 * @param  string  $filter_key
 * @param  string  $filter_value
 * @return string
 */
function setUrl(string $filter_key, string $filter_value): string
{
    $get = $_GET;
    $get["$filter_key"] = $filter_value;
    if ((($filter_key == 'filter_by_first_letter') || ($filter_key == 'filter_by_state'))) {
        $get["page"] = 1;
    }

    return ("/?" . http_build_query($get));
}
