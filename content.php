<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <!-- Loads all styles -->
  <link rel="stylesheet" href="html/css/bootstrap.min.css">
  <link rel="stylesheet" href="html/css/main.css">

  <!-- Loads all libraries -->
  <script src="html/js/lib/jquery-3.3.1.min.js"></script>
  <script src="html/js/lib/d3.min.js"></script>
  <script src="html/js/lib/bootstrap.min.js"></script>
  <script src="html/js/lib/bowser-2.4.0-es5.js"></script>
  <script type="module" src="html/js/lib/seedrandom.min.js"></script>

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
  require_once "html/setup/functions.php";
  loadConfig();


  // Read in the GET parameters to determine if we are in debug or pilot mode and if not, to recover data required for the log files

  $missing_parameters = false;

  $is_pilot = 0;
  $is_debug = 0;

  if (isset($_GET["DEBUG"]) || isset($_GET["debug"])) {
    $is_debug = 1;
    $participant_id = 'DEBUG'; 
    $study_id = "DEBUG";
    $session_id = 0;
    $missing_parameters = false;
  }  else if (isset($_GET["PILOT"]) || isset($_GET["pilot"])) {
    $is_pilot = 1;
    $participant_id = '_' . base_convert(mt_rand() / mt_getrandmax(), 10, 36); // generating a random but unique ID
    $study_id = "pilot";
    $session_id = 0;
    $missing_parameters = false;
}  else {  
    // we're running a real participant. Get URL parameters sent by Prolific
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
}
if ($is_debug > 0 || $is_pilot > 0){
  if (isset($_GET["condition"])) {
    $order_value = $_GET["condition"];
  }
  if (isset($_GET["page"])) {
    $start_page = max(1, intval($_GET["page"]));
  }
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

// TODO this is a very limited mechanism for now
  randomAssignment();


  $condition = $factor1;


  // The following lines create a log file name "requested.csv" which contains a timestamp and participants id for all people who requested the page. This is mainly useful for debugging purposes to figure where something went wrong. It can also be used to detect if someone reloaded the page.
  
  $starter_filename = "results/requested.csv";
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
  echo '<input type="hidden" id="is_debug" value="' . "" . $is_debug .  '"</input>';
  echo '<input type="hidden" id="exclude_reloaders" value="' . "" . $config["exclude_reloaders"] .  '"</input>';

?>
</div>
<script type="text/javascript">
    var config = <?php echo file_get_contents("html/setup/config.json");?>;

</script>
<?php

  // variable to collect the ids of the pages to hide at the beginning
  $pages_to_hide = array();

  // generate all pages listed in the PAGE_ORDER constant
  for ($i=0; $i < count($page_order); $i++) {
       $id = $page_order[$i];
       $button = $pages[$id]["button_text"];
       $page_number = $i + 1;
       if(!$pages[$id]["start_page"]){
         $pages_to_hide[] = '#' . $id;
       }
       if ($i < count($page_order) - 1){
         $next = $page_order[$i+1];

       } else {
        $next = ' ';
       }
       $page = $pages[$id]["page_path"];
       $disabled = $pages[$id]["disabled"];
       include "html/page_skeleton.php";
     }

     // generate the attention check failed page in case we need it
       $id = "attention_check_failed";
       $button = $pages[$id]["button_text"];
       $page_number = -1;
       $pages_to_hide[] = '#' . $id;
       $next = null;
       $page = $pages[$id]["page_path"];
       include "html/page_skeleton.php";

?>


  </main>

  <script src="html/js/init-logging.js" charset="utf-8"></script>
  <script type="text/javascript">
    console.log(config.use_fixed_frame);
    var is_debug = $('#is_debug').val();
    console.log("Debugging --> " + is_debug);
    if (is_debug) console.log("condition: " + $('#condition').val());

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

    $('<?php echo implode(',' , $pages_to_hide);?>').hide();
    <?php  
    if (isset($start_page)){
      echo "$('#" . $page_order[0] . "').hide();";
      echo "$('#" . $page_order[$start_page - 1] . "').show();";
    } else {
      echo "$('#" . $page_order[0] . "').show();";
    }
    ?>


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
  require "html/setup/load_js.php";
  ?>
  
</body>
</html>
