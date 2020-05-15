<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <!-- Loads all styles -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">

  <!-- Loads all libraries -->
  <script src="js/lib/jquery-3.3.1.min.js"></script>
  <script src="js/lib/d3.min.js"></script>
  <script src="js/lib/bootstrap.min.js"></script>
  <script src="js/lib/bowser-2.4.0-es5.js"></script>
  <script type="module" src="js/lib/seedrandom.min.js"></script>

</head>
<body>

  <div class ="container" id="no-cookie-container" style="display: none;">
    <h1>Your browser is blocking cookies.</h1>
    <p>
      You need to allow cookies to participate in this experiment. <br>If you don't know how to do this, you can use <a href="https://www.whatismybrowser.com/guides/how-to-enable-cookies/auto" target="_blank">this guide</a>.
    </p>
    <p>
      Once you activated cookies, please reload this page.
    </p>
  </div>

  <div class ="container" id="reloader-container" style="display: none;">
    <h1>You reloaded the page.</h1>
    <p>
      Unfortunately, it seems that you have reloaded this page <strong>after</strong> you accepted the informed consent. We indicated at the beginning of the experiment that reloading after accepting the conditions would lead to <strong>exclusion</strong> from the experiment.
    </p>
    <p>
      You can close the window now and return the task on the Prolific platform.
    </p>
  </div>

<?php
    $missing_parameters = false;
  // get URL parameters sent by Prolific
  if (isset($_GET["PROLIFIC_PID"])) {
    $participant_id = $_GET["PROLIFIC_PID"];
  } else {
    $missing_parameters = true;
  }

  if (isset($_GET["STUDY_ID"])){
    $study_id = $_GET["STUDY_ID"];
  } else {
    $missing_parameters = true;
  }

  if (isset($_GET["SESSION_ID"])) {
    $session_id = $_GET["SESSION_ID"];
  } else {
    $missing_parameters = true;
  }

  if (isset($_GET["DEBUG"]) || isset($_GET["debug"])) {
    $is_debug = 1;
  }  else {
    $is_debug = 0;
  }

?>
  <div class ="container" id="missing-parameter-container" style="display:none;">
    <h1>Invalid link</h1>
    <p>
      You opened this page without the required experiment parameters. Please use the link provided in the Prolific interface.
    </p>
  </div>

  <main id="main-container" class="container">



<?php
require "setup/constants.php";
require "setup/functions.php";
require "setup/pages_behavior.php";

assignFactorLevels();


  $condition = $factor1 . "_" . $factor2;


  // The following lines create a log file name "all_who_started.csv" which contains a timestamp and participants id for all people who requested the page. This is mainly useful for debugging purposes to figure where something went wrong. It can also be used to detect if someone reloaded the page.
  $starter_filename = "../results/requested.csv";
  $exists = file_exists($starter_filename);
  $starter_file = fopen($starter_filename, "a+");

  if (!$exists){
    fwrite($starter_file, "timestamp,participant_id,condition,study_id,session_id");
  }

  fwrite($starter_file,
    PHP_EOL .
    date(DateTime::ISO8601) . ',' .
    (($is_debug > 0) ? 'DEBUG' : $participant_id) . ',' .
    $condition . ',' .
    $study_id . ',' .
    $session_id
  );

  fclose($starter_file);

  // These are hidden input fields which store information to be retrievable with javascript.
?>

<div id="experiment-info">
<?php

  echo '<input type="hidden" id="participant_id" value="' . (($is_debug > 0) ? 'DEBUG' : $participant_id) .  '"</input>';
  echo '<input type="hidden" id="study_id" value="' . "" . $study_id .  '"</input>';
  echo '<input type="hidden" id="session_id" value="' . "" . $session_id .  '"</input>';
  echo '<input type="hidden" id="condition" value="' . "" . $condition .  '"</input>';
  if (!is_null($factor1)){
    echo '<input  type="hidden" 
                  id="' . $FACTOR_LEVELS["factor1"]["name"]  . '" value="' . "" . $factor1 .  '"</input>';
  }

  if (!is_null($factor2)){
    echo '<input type="hidden" id="' . $FACTOR_LEVELS["factor2"]["name"]  . '" value="' . "" . $factor2 .  '"</input>';
  }
  echo '<input type="hidden" id="is_debug" value="' . "" . $is_debug .  '"</input>';
  echo '<input type="hidden" id="exclude_reloaders" value="' . "" . $EXCLUDE_RELOADERS .  '"</input>';

?>
</div>

<?php

  // variable to collect the ids of the pages to hide at the beginning
  $pages_to_hide = "";

  // generate all pages listed in the PAGE_ORDER constant
  for ($i=0; $i < count($PAGE_ORDER); $i++) {
       $button = $PAGE_ORDER[$i]["button"];
       $id = $PAGE_ORDER[$i]["id"];
       $page_number = $i + 1;
       if ($i>0){
        $pages_to_hide .= '#' . $id;
       }
       if ($i > 0 && $i < count($PAGE_ORDER)-1){
        $pages_to_hide .= ", ";
       }
       $next = $PAGE_ORDER[$i]["next"];
       $page = $PAGE_ORDER[$i]["page"];
       $disabled = $PAGE_ORDER[$i]["disabled"];
       include "page_skeleton.php";
     }
?>


  </main>

  <script src="js/init-logging.js" charset="utf-8"></script>
  <script type="text/javascript">


    function getCookie(cname) {
      var name = cname + "=";
      var decodedCookie = decodeURIComponent(document.cookie);
      var ca = decodedCookie.split(';');
      for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }

    function checkCookie(){
      // Quick test if browser has cookieEnabled host property
      if (navigator.cookieEnabled) return true;
      // Create cookie
      document.cookie = "cookietest=1";
      var ret = document.cookie.indexOf("cookietest=") != -1;
      // Delete cookie
      document.cookie = "cookietest=1; expires=Thu, 01-Jan-1970 00:00:01 GMT";
      return ret;
    }

    // if the constant $EXCLUDE_RELOADERS is set to true, check if a cookie has been set already
    if ($('#exclude_reloaders').val() > 0){
      if (checkCookie()){
        document.cookie = "prolific_study=" +  $('#participant_id').val() + "; max-age=" + 60*60*24*7;
        var is_debug = $('#is_debug').val();
        console.log("Debugging --> " + is_debug);
        if (getCookie("accepted") == 1 && is_debug < 1) {
          $("main").hide();
          $("#reloader-container").show();
          $('body').trigger("reloaded");
        }
      } else {
          $("main").hide();
          $("#no-cookie-container").show();
      }
    }

    $('<?php echo $pages_to_hide;?>').hide();


    function missingParameters() {
        $("main").hide();
        $("#missing-parameter-container").show();
    }

    <?php
    if ($missing_parameters){
      echo "missingParameters();";
    }
    ?>
  </script>
  
  <?php
  require "setup/load_js.php";
  ?>
  
</body>
</html>
