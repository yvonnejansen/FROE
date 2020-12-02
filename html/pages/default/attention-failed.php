<div class="row">
  <div class="col">
    <h2>We are sorry, but you cannot continue the experiment</h2>
    <p>On the previous page, you did not choose the right answer and, consequently, did not pass the attention check test.</p>

    <p>
      In the initial experiment instructions, we warned you that there would be an attention check, and that if you failed it, you would not be paid.
    </p>

    <p id="att_failed">
      We asked <em>which topic (from a list) was presented in this study</em>. The right answer was <em style="color: green"><?php echo $config["attention_question_correct_answer"]["value"];?></em> but you chose <em style="color: red"><span id="att_answer"></span></em>.
    </p>
    <p>For our research study to be valid, it is critical for us to get reliable data. To get reliable data, we need to make sure that our participants read all instructions. Your response to the previous attention check is an indication that you may not have paid full attention to all our instructions.</p>
    <p>Please feel free to contact the requester if you have any question or complaint.</p>
  </div>
</div>

<script type="text/javascript">
  

  answers = config.attention_question_answers;

  $('input:radio[name="att"]').on('click', function() {
    var att_answer = $('input[name=att]:checked').val();
    $("#att_answer").html(answers[att_answer]);
    console.log("setting the answer " + answers[att_answer]);
    if (att_answer != "<?php echo $config["attention_question_correct_answer"]["key"] ?>") {
      // $("#attention_check_failed").show();
    } else {
      // $("#attention_check_failed").hide();
    }
  });

</script>