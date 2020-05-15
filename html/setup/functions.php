<?php

  // the code below assigns the names of factor levels to variables according to the information given in the file constants.php
  // If the default structure (2 factors each with 2 levels) is changed, then code below needs to be adapted. Otherwise, leave this as is.
$factor1 = null;
$factor2 = null;
function assignFactorLevels() {
  global $order_value, $factor1, $factor2, $NUM_CONDITIONS, $FACTOR_LEVELS;

  if (function_exists('random_int')){
    $order_value = random_int(0, $NUM_CONDITIONS - 1);
  } else {
    $order_value = rand(0,$NUM_CONDITIONS - 1);
  }

  switch ($order_value) {
    case 0:
        $factor1 = $FACTOR_LEVELS["factor1"]["levels"][0];
        $factor2 = $FACTOR_LEVELS["factor2"]["levels"][0];
        break;
    case 1:
        $factor1 = $FACTOR_LEVELS["factor1"]["levels"][1];
        $factor2 = $FACTOR_LEVELS["factor2"]["levels"][0];
        break;
    case 2:
        $factor1 = $FACTOR_LEVELS["factor1"]["levels"][0];
        $factor2 = $FACTOR_LEVELS["factor2"]["levels"][1];
        break;
    case 3:
        $factor1 = $FACTOR_LEVELS["factor1"]["levels"][1];
        $factor2 = $FACTOR_LEVELS["factor2"]["levels"][1];
        break;
  }
}

// The code below is only useful to make the example run. Exchange this with possible variables you need to define which depend on the condition assignment.

  $blue_region = ($factor1 == "Anonymous") ? "the Blue region" : "the Amazon";
  $orange_region = ($factor1 == "Anonymous") ? "the Orange region" : "Southeast Asia";

  ?>