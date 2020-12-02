<!-- This page realizes a simple attention check by asking what the topic of your study was.
  On platforms like Amazon Mechanical Turk it is very important to have effective attention
  checks since the quality of answers can be very low otherwise. On Prolific, which does
  exclusively studies and no human data annotation tasks, the quality is usually rather
  high and simple tests suffice to exclude the few outliers which may click through
  an experiment without paying attention.

  Nonetheless, the questions should be adjusted a bit to correspond within the topic context
  of your study.

 -->

<div class="row">
  <div class="col">
    <h2>Final question</h2>
    <p>Which of the following topics was presented in this study?</p>
    <?php
    $att_ans = 1;
    foreach ($config["attention_question_answers"] as $key => $value) {
      ?>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="att" id="att-ans-<?php echo $att_ans;?>" value="<?php echo $key;?>">
      <label class="form-check-label" for="att-ans-1">
        <?php echo $value;?>
      </label>
    </div>  
    <?php  
      $att_ans++;  
    }
    ?>

  </div>

</div>

<script type="text/javascript">

$('input:radio[name="att"]').on('click', function() {
    if ($('input[type="radio"][name="att"]').is(':checked')) {
    $("#btn_<?php echo $id;?>").prop('disabled', false);
  } else {
    $("#btn_<?php echo $id;?>").prop('disabled', true);
  }
});

$('body').on('next', function(e, type){
  // console.log("next");
  if (type === '<?php echo $id;?>'){
    var att_answer = $('input[name=att]:checked').val();
    if(att_answer != "<?php echo $config["attention_question_correct_answer"]["key"] ?>"){
      excluded = true;
      $('body').trigger('excluded');
      // console.log("failed on attention check --> exclude");
      $('#<?php echo $next ?>').hide().promise().done(() => $('#attention_check_failed').show());
      $(":button").hide();
    } else {
      // console.log("passed on attention check");
      // $('#<?php echo $id ?>').hide().promise().done(() => $('#<?php echo $next ?>').show());
  }

}
});

</script>
