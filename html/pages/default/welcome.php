<div class="row">
  <div class="col">
    <h2>Important information</h2>
    <ol>
      <li>You cannot navigate back to previous pages</li>

      <li>You will not be paid if you fail an attention check 
      <?php if($config["exclude_reloaders"]){
      	?>
      		or reload the page after having accepted the informed consent
      	<?php
      } ?></li>
      <li>Instructions can be dependend on conditions<?php echo ($factor1 == $config["factors"][0]["levels"][0]) ? ", and only be shown to some of the participants" : ""; ?></li>
    </ol>

    <p>Click "Next" to proceed to the informed consent.</p>
  </div>
</div>
