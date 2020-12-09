
<div id="row">
  <div class="task-description" id="graph_box">
    <p>A large pharmaceutical company has recently developed a new drug to boost peoples' immune function. It reports that trials it conducted demonstrated a drop of forty percent (from eighty seven to forty seven percent) in occurrence of the common cold. It intends to market the new drug as soon as next winter, following FDA approval.</p>

    <?php if ($condition == $config["factors"][0]["levels"][1]) {
      echo '<p><img id="graph" src="html/img/base_example/exp1_graph.jpg"></p>';
    }
    ?>

    
  </div>
  
  <hr>

  <div class="ratings cml_field"><h2 class="legend">How effective is the new medication?</h2>
<div class="cml_row">
  
<table>
  <thead>
    <tr>
      <th></th>
      
      <th class="likert">1</th>
      
      <th class="likert">2</th>
      
      <th class="likert">3</th>
      
      <th class="likert">4</th>
      
      <th class="likert">5</th>
      
      <th class="likert">6</th>
      
      <th class="likert">7</th>
      
      <th class="likert">8</th>
      
      <th class="likert">9</th>
      
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Not at all effective </td>
      
      <td class="likert"><input name="how_effective_is_the_new_medication" type="radio" value="1" class="how_effective_is_the_new_medication validates-required validates">
</td>
      
      <td class="likert"><input name="how_effective_is_the_new_medication" type="radio" value="2" class="how_effective_is_the_new_medication validates-required validates">
</td>
      
      <td class="likert"><input name="how_effective_is_the_new_medication" type="radio" value="3" class="how_effective_is_the_new_medication validates-required validates">
</td>
      
      <td class="likert"><input name="how_effective_is_the_new_medication" type="radio" value="4" class="how_effective_is_the_new_medication validates-required validates">
</td>
      
      <td class="likert"><input name="how_effective_is_the_new_medication" type="radio" value="5" class="how_effective_is_the_new_medication validates-required validates">
</td>
      
      <td class="likert"><input name="how_effective_is_the_new_medication" type="radio" value="6" class="how_effective_is_the_new_medication validates-required validates">
</td>
      
      <td class="likert"><input name="how_effective_is_the_new_medication" type="radio" value="7" class="how_effective_is_the_new_medication validates-required validates">
</td>
      
      <td class="likert"><input name="how_effective_is_the_new_medication" type="radio" value="8" class="how_effective_is_the_new_medication validates-required validates">
</td>
      
      <td class="likert"><input name="how_effective_is_the_new_medication" type="radio" value="9" class="how_effective_is_the_new_medication validates-required validates">
</td>
      
      <td> Very effective</td>
    </tr>
  </tbody>
</table>
</div>
</div>
<hr>
  <div class="radios cml_field"><h2 class="legend">Does the medication really reduce illness?</h2>
  <div class="cml_row"><label class=""><input name="does_the_medication_really_reduce_illness" type="radio" value="yes" class="does_the_medication_really_reduce_illness validates-required validates">
 Yes</label></div>
<div class="cml_row"><label class=""><input name="does_the_medication_really_reduce_illness" type="radio" value="no" class="does_the_medication_really_reduce_illness validates-required validates">
 No</label></div>

</div>

<script type="text/javascript">
  // make button active as soon as value was changed
  var effective_answered = false;
  var illness_answered = false;
  var effective_answer = -1;
  var illness_answer = -1;
$('.how_effective_is_the_new_medication').on('input', function() {
    effective_answered = true;
    effective_answer = $(this).val();
    if (effective_answered && illness_answered) $("#btn_<?php echo $id;?>").prop('disabled', false);
});

$('.does_the_medication_really_reduce_illness').on('input', function() {
    illness_answered = true;
    illness_answer =$(this).val();
    if (effective_answered && illness_answered) $("#btn_<?php echo $id;?>").prop('disabled', false);
});

$('body').on('next', function(e, type){
  // console.log("next");
  if (type === '<?php echo $id;?>'){
    measurements['effectiveness'] = effective_answer;
    measurements['illness_reduction'] = illness_answer;
    console.log("logging effectiveness answer " + effective_answer);
    console.log("logging illness reduction answer " + illness_answer);
    console.log("excluded " + excluded);
  }
});


</script>

</div>