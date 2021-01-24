<?php
/**
 * The $input variable contains text in snake case (i.e. hello_world or this_is_home_task)
 * Transform it into camel cased string and return (i.e. helloWorld or thisIsHomeTask)
 * @see http://xahlee.info/comp/camelCase_vs_snake_case.html
 *
 * @param  string  $input
 * @return string
 */
function snakeCaseToCamelCase(string $input)
{
  if (strpos ($input, '_') === false){ return $input; }

  $uppercase = ucwords (str_replace ('_', ' ', $input));
  $camelCase = lcfirst (str_replace (' ', '', $uppercase));

  return $camelCase;
}

/**
 * The $input variable contains multibyte text like 'ФЫВА олдж'
 * Mirror each word individually and return transformed text (i.e. 'АВЫФ ждло')
 * !!! do not change words order
 *
 * @param  string  $input
 * @return string
 */
function mirrorMultibyteString(string $input)
{
  $revstr = '';

    for ($i = mb_strlen ($input); $i>=0; $i--) {
        $revstr .= mb_substr ($input, $i, 1);
    }
    
  $words = explode (' ', $revstr);
  $word_order = array_reverse ($words);
  $mirror_str = implode (' ', $word_order);

  return $mirror_str;
}

/**
 * My friend wants a new band name for her band.
 * She likes bands that use the formula: 'The' + a noun with first letter capitalized.
 * However, when a noun STARTS and ENDS with the same letter,
 * she likes to repeat the noun twice and connect them together with the first and last letter,
 * combined into one word like so (WITHOUT a 'The' in front):
 * dolphin -> The Dolphin
 * alaska -> Alaskalaska
 * europe -> Europeurope
 * Implement this logic.
 *
 * @param  string  $noun
 * @return string
 */
function getBrandName(string $noun)
{
  $upper = ucfirst($noun);

  $first_char = $noun[0];
  $last_char = $noun[strlen($noun)-1];

  if ($first_char !== $last_char){
    $output = "The $upper";
  }else{
    $second_part = substr ($noun, 1);
    $output = "$upper"."$second_part";
  }

  return $output;
}