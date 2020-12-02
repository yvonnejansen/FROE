<div class="row">
  <div class="col">
    <h2>Context</h2>
    <p><br/>
      Some text setting the scene and explaining context to the participant. 
    </p>
    <p>
      There should be no stimulus present yet on this screen except if needed to explain the task to the participant.
    </p>
    <p>
      Variables can be used to display content depending on the condition to which a participant was assigned. For example:
    </p>
    <p style="stroke: black">
      <?php 
          switch ($condition){
            case 0:
              echo 'Display stimulus example for condition 0';
              break;
            case 1:
              echo 'Display stimulus example for condition 1';
              break;
            case 2:
              echo 'Display stimulus example for condition 2';
              break;
            case 3:
              echo 'Display stimulus example for condition 3';
              break;
          }

      ?>
      </p>    
  </div>
</div>
