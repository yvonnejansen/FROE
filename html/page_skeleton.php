<div id="<?php echo $id ?>">
  <?php include $page ?>
  <input type="hidden" id="page_<?php echo $id;?>" value="<?php echo $page_number;?>"</input>
  <?php $text = $button; $style = ($text == "Next") ? "btn-secondary" : "btn-success" ; $hide = $id; $show = $next; $disabled = $disabled; include "components/button.php" ?>
</div>
