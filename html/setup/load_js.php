<!-- 
/* This file is meant to regroup all javascript includes that are supposed to happen
 * once the participant has been assigned to a condition. Consequently, different js
 * files can be loaded for different conditions. See below for an example.
 */
  -->

 <script type="module" src="js/tools/helper.js" charset="utf-8"></script>

<!-- You can also load additional css here if needed -->

  <?php 
  // include js according to selected condition --> adjust as needed!
  // the following variables can be used to load files conditionally:
  //  - $condition (int), 
  //  - $factor1 (string of the level name) and 
  //  - $factor2 (if defined)

  // Example
  if ($factor1 == $FACTOR_LEVELS["factor1"]["levels"][0]){ 
    echo '<script type="module" src="js/visualizations/condition1.js" charset="utf-8"></script>' . PHP_EOL;
  } else {
    echo '<script type="module" src="js/visualizations/condition2.js" charset="utf-8"></script>' . PHP_EOL;
  }?>