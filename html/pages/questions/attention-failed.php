<div class="row">
  <div class="col">
    <h2>We are sorry, but you cannot continue the experiment</h2>
    <p>On the previous page, you did not choose the right answer and, consequently, did not pass the attention check test.</p>

    <p>
      In the initial experiment instructions, we warned you that there would be an attention check, and that if you failed it, you would not be paid.
    </p>

    <p id="att_failed">
      We asked <em>which topic (from a list) was presented in this study</em>. The right answer was <em style="color: green"><?php echo $ATTENTION_QUESTION_OPTIONS[$ATT_CORRECT_ANSWER];?></em> but you chose <em style="color: red"><span id="att_answer"></em>.
    </p>
    <p>For our research study to be valid, it is critical for us to get reliable data. To get reliable data, we need to make sure that our participants read all instructions. Your response to the previous attention check is an indication that you may not have paid full attention to all our instructions.</p>
    <p>Please feel free to contact the requester if you have any question or complaint.</p>
  </div>
</div>

<script type="text/javascript">

  answers = {
    <?php
      $options_counter = 0;
      foreach ($ATTENTION_QUESTION_OPTIONS as $key => $value) {
        echo '"' . $key . '": "' . $value . '"';
        if ($options_counter < count($ATTENTION_QUESTION_OPTIONS) - 1) echo ', ' . PHP_EOL;
        $options_counter++;
      }
    ?>
  };

  $('input[type="radio"]').on('click', function() {
    var att_answer = $('input[name=att]:checked').val();

    $("#att_answer").text(answers[att_answer]);

    if (att_answer != "<?php echo $ATT_CORRECT_ANSWER ?>") {
      $("#att_failed").show();
    } else {
      $("#att_failed").hide();
    }
  });
</script>
