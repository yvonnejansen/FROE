<div class="row">
    <p style="margin-top: 15px"><img id="people" src="html/img/base_example/20people.jpg" /></p>
    <div class="task-description">
        <p>Suppose the findings reported by the pharmaceutical company are accurate. Imagine a group of 20 people who would <strong>all</strong> get the common cold without the medication. Now suppose we give the medication to all of them.</p>
        <h2 class="legend">How many do you think will still get the common cold?</h2>
    </div>
    <p id="helper-text">Don't try to compute an exact answer. Just give us your best guess.</p>
    <label class=""><input id="comprehension-input" type="number" min="0" max="20" class="comprehension validates-required validates">&nbsp;out of 20</label>
</div>

<script type="text/javascript">

// make button active as soon as value was changed
$('#comprehension-input').on('change input', function() {
    $("#btn_<?php echo $id;?>").prop('disabled', false);
  
});

$('body').on('next', function(e, type){
  // console.log("next");
  if (type === '<?php echo $id;?>'){
    var comp = $('#comprehension-input').val();
    measurements['comprehension'] = comp;
    console.log("logging comprehension value " + comp);
  }
});
</script>
