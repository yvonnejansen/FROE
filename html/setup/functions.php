<?php

  // the code below assigns the names of factor levels to variables according to the information given in the file constants.php
  // If the default structure (2 factors each with 2 levels) is changed, then code below needs to be adapted. Otherwise, leave this as is.
$factor1 = null;
$factor2 = null;

function loadConfig(){
  global $config, $pages, $page_order;
  if(!isset($config)){
    $configFileContents = file_get_contents("html/setup/config.json");
    $config = json_decode($configFileContents, true);
  }

  if(!isset($pages)){
    $pageFileContents = file_get_contents("html/setup/page_definitions.json");
    $pages = json_decode($pageFileContents, true);
  }

  if(!isset($page_order)){
    $orderFileContents = file_get_contents("html/setup/experiment_structure.json");
    $page_order = json_decode($orderFileContents, true);
  }


}


function randomAssignment() {
  // this function is called for between designs where a participant just needs to be randomly assigned to a condition combining a set of factor levels
  global $config, $order_value, $factor1; //, $factor2, $NUM_CONDITIONS, $FACTOR_LEVELS, $DESIGN;

  // check if $order_value was already set through a GET parameter
  if (isset($order_value)){
    // don't do anything; a certain condition was requested
  } else {
    if (function_exists('random_int')){
      $order_value = random_int(0, $config["num_conditions"] - 1);
    } else {
      $order_value = rand(0,$config["num_conditions"] - 1);
    }
  }

  switch ($order_value) {
    case 0:
        $factor1 = $config["factors"][0]["levels"][0];
        break;
    case 1:
        $factor1 = $config["factors"][0]["levels"][1];
        break;
  }
}

function getOrderFromFile() {
  // this function is called for a within design where a participant has to do all conditions and needs to be assigned to a specific order of conditions. FROE currently doesn't deal with managing this itself but offers the possibility of reading in files which specify the order of conditions

}

// The code below is only useful to make the example run. Exchange this with possible variables you need to define which depend on the condition assignment.

  $blue_region = ($factor1 == "Anonymous") ? "the Blue region" : "the Amazon";
  $orange_region = ($factor1 == "Anonymous") ? "the Orange region" : "Southeast Asia";

  ?>