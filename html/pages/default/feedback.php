<div class="row">
  <div class="col">
    <form class="mt-2" action="" method="post">
      <div class="row">
        <h2>Comments?</h2>
      </div>
      <div class="row mt-4">
        <div class="form-group">
          <textarea class="form-control" id="optionalComments" rows="4" cols="80" placeholder="Do you have any comment about the study, for example concerning the clarity of the instructions or technical issues you might have experienced? (optional)"></textarea>
        </div>
      </div>
    </form>
  </div>
</div>


<script type="text/javascript">

  // This is the event triggered to save the data entered. The event triggers when the 'next' button is pressed.
	$('body').on('next', function(e, type){
		// The if clause below ensures that this specific instance of a next button press is only triggered when the id of the element corresponds to the one being defined above.
    if (type === '<?php echo $id;?>' && !(typeof measurements === 'undefined')){
      measurements['optionalComments'] = $("#optionalComments").val();
		}
	});
</script>
