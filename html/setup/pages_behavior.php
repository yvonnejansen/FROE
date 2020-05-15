<?php
/*  This file contains the behavior description for all pages in the experiment. 
    To define an experiment flow, create an array variable as below for each page and then indicate the order additionally in the variable $PAGE_ORDER defined at the bottom of the file.
    The meaning of the array elements is as following:
      - id: the div id used to find the page (must be unique)
      - next: the page to be shown after the one being currently defined 
      - button: the text written in the next button at the bottom of the page
      - page: the relative url to the page being currently defined
      - disabled: boolean indicating whether the button should be disabled when the page is shown
 */

  // Pages definition
  $IMPORTANT_PAGE = array(
    "id"		=> "important",
    "next"		=> "consent",
    "button" 	=> "Next",
    "page"		=> "pages/instructions/important.php",
    "disabled"	=> false
  );

  $CONSENT_PAGE = array(
    "id"		=> "consent",
    "next"		=> "description",
    "button" 	=> "I agree. Start the experiment.",
    "page"		=> "pages/instructions/consent.php",
    "disabled"	=> false
  );

  $DESCRIPTION_PAGE = array(
    "id"		=> "description",
    "next"		=> "vis",
    "button" 	=> "Next",
    "page"		=> "pages/instructions/description.php",
    "disabled"	=> false
  );

  $VIS_PAGE = array(
    "id"		=> "vis",
    "next"		=> "comprehension",
    "button" 	=> "Confirm",
    "page"		=> "pages/visualization/vis_page.php",
    "disabled"	=> true
  );

  $COMPREHENSION_PAGE = array(
    "id"		=> "comprehension",
    "next"		=> "attention",
    "button" 	=> "Confirm",
    "page"		=> "pages/questions/comprehension.php",
    "disabled"	=> true
  );


  $ATTENTION_PAGE = array(
    "id"		=> "attention",
    "next"		=> "end",
    "button"  => "Finish Study", // needs to be written exactly like that to trigger the finished event
    "page"		=> "pages/questions/attention.php",
    "disabled"	=> true
  );

  $ATTENTION_FAILED_PAGE = array(
    "id"		=> "excluded",
    "next"		=> "non",
    "button" 	=> " ",
    "page"		=> "pages/questions/attention-failed.php",
    "disabled"	=> true
  );

  $FEEDBACK_PAGE = array(
    "id"    => "feedback",
    "next"    => "end",
    "button"  => "Finish Study", // needs to be written exactly like that to trigger the finished event
    "page"    => "pages/questions/feedback.php",
    "disabled"  => false
  );

  $END_PAGE = array(
    "id"		=> "end",
    "next"		=> "none",
    "button" 	=> " ",
    "page"		=> "pages/instructions/end.php",
    "disabled"	=> true
  );

  // This array defines the order of the pages. 
  // You can temporarily modify this order for debugging. Just move the page you want first at the first position.
  $PAGE_ORDER = array(
          $IMPORTANT_PAGE,
          $CONSENT_PAGE,
          $DESCRIPTION_PAGE,
          $VIS_PAGE,
          $COMPREHENSION_PAGE,
          $ATTENTION_PAGE,
          $ATTENTION_FAILED_PAGE,
          $END_PAGE
        );
  
 ?>
