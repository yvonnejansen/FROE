<div class="row mb-3 mt-4">
  <div class="col text-center">
    <button
      href="#"
      class="btn btn-wider <?php echo $style;?>"
      id = "btn_<?php echo $id;?>"
      onclick="$('body').trigger('next', ['<?php echo $id;?>']); if ('<?php echo $text ?>' === 'Finish Study')$('body').trigger('finished');  $('#<?php echo $hide ?>').hide().promise().done(() => {if (!excluded) $('#<?php echo $show ?>').show()});"
      <?php if($disabled) echo ' disabled';?>>
        <?php echo $text ?>
    </button>
  </div>
</div>
