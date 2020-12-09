            <div id="ExperimentBlock_<?php echo $id;?>">
                <div class="ImageBlock" id="ImageBlock_<?php echo $id;?>">
                    <!--<img src ="images/DUMMY.png" height="768" width="1024" id="Image">-->
                    <img src ="html/img/filter_example/Mask.png" class="Image" id="Stimulus_Image_<?php echo $id;?>">
                </div>
                <div class="ScalesBlock" id="ScalesBlock_<?php echo $id;?>" style="display: none;">
                    <div id="DifficultBlock_<?php echo $id;?>">
                        <p><b>How difficult was it for you to look at this image?</b></p><br/><br/>
                            <div class="radioGroupDifficult">
                                <label id="left_label" for="radio1">1<br />
                                    Very easy &nbsp;<input type="radio" name="difficult_<?php echo $id;?>" id="radio1d" value="1" />
                                </label>
                                <label for="radio2">2<br />
                                    <input type="radio" name="difficult_<?php echo $id;?>" id="radio2d" value="2" />
                                </label>
                                <label for="radio3">3<br />
                                    <input type="radio" name="difficult_<?php echo $id;?>" id="radio3d" value="3" />
                                </label>
                                <label for="radio4">4<br />
                                    <input type="radio" name="difficult_<?php echo $id;?>" id="radio4d" value="4" />
                                </label>
                                <label for="radio5">5<br />
                                    <input type="radio" name="difficult_<?php echo $id;?>" id="radio5d" value="5" />
                                </label>
                                <label for="radio6">6<br />
                                    <input type="radio" name="difficult_<?php echo $id;?>" id="radio6d" value="6" />
                                </label>
                                <label for="radio7">7<br />
                                    <input type="radio" name="difficult_<?php echo $id;?>" id="radio7d" value="7" />
                                </label>
                                <label for="radio8">8<br />
                                    <input type="radio" name="difficult_<?php echo $id;?>" id="radio8d" value="8" />
                                </label>
                                <label id="right_label" for="radio9">9<br />
                                    <input type="radio" name="difficult_<?php echo $id;?>" id="radio9d" value="9" />Very difficult
                                </label>
                            </div>
                    </div>


                    <br/><br/>
                   <div id="RecognizeBlock_<?php echo $id;?>">
                        <p><b>How difficult was it to recognize the image's content?</b></p><br/><br/>
                            <div class="radioGroupRecognize">
                                <label id="left_label" for="radio1">1<br />
                                    Very easy &nbsp;<input type="radio" name="recognize_<?php echo $id;?>" id="radio1r" value="1" class="radioR"/>
                                </label>
                                <label for="radio2">2<br />
                                    <input type="radio" name="recognize_<?php echo $id;?>" id="radio2r" value="2" class="radioR"/>
                                </label>
                                <label for="radio3">3<br />
                                    <input type="radio" name="recognize_<?php echo $id;?>" id="radio3r" value="3" class="radioR"/>
                                </label>
                                <label for="radio4">4<br />
                                    <input type="radio" name="recognize_<?php echo $id;?>" id="radio4r" value="4" class="radioR"/>
                                </label>
                                <label for="radio5">5<br />
                                    <input type="radio" name="recognize_<?php echo $id;?>" id="radio5r" value="5" class="radioR"/>
                                </label>
                                <label for="radio6">6<br />
                                    <input type="radio" name="recognize_<?php echo $id;?>" id="radio6r" value="6" class="radioR"/>
                                </label>
                                <label for="radio7">7<br />
                                    <input type="radio" name="recognize_<?php echo $id;?>" id="radio7r" value="7" class="radioR"/>
                                </label>
                                <label for="radio8">8<br />
                                    <input type="radio" name="recognize_<?php echo $id;?>" id="radio8r" value="8" class="radioR"/>
                                </label>
                                <label id="right_label" for="radio9">9<br />
                                    <input type="radio" name="recognize_<?php echo $id;?>" id="radio9r" value="9" />Very difficult
                                </label>
                            </div>
                    </div>
                  </div>
              </div>

<script type="text/javascript">

$('input:radio[name="recognize_<?php echo $id;?>"]').on('click', function() {
    if ($('input[type="radio"][name="difficult_<?php echo $id;?>"]').is(':checked')){
        $("#btn_<?php echo $id;?>").prop('disabled', false);
     } 
});

$('input:radio[name="difficult_<?php echo $id;?>"]').on('click', function() {
    if ($('input[type="radio"][name="recognize_<?php echo $id;?>"]').is(':checked')){
        $("#btn_<?php echo $id;?>").prop('disabled', false);
    } 
});

$('body').on('next', function(e, type){
    if (type === '<?php echo $id;?>'){
        // we need to log our data
        trial_log.push([
        measurements.participant_id, 
        measurements.condition,
        <?php echo $trial;?> + "", 
        <?php echo $filter;?> + "", 
        <?php echo $image;?> + "", 
        $('input[type="radio"][name="difficult_<?php echo $id;?>"]:checked').val(),
        $('input[type="radio"][name="recognize_<?php echo $id;?>"]:checked').val()
        ]);
        
        // console.log(trial_log);
    }

});

$('body').on('show', function(e, type){
  // console.log("show");
  if (type === '<?php echo $id;?>'){
    console.log("showing page " + type);
    
    var img = $("#Stimulus_Image_<?php echo $id;?>");
    $('#btn_<?php echo $id;?>').hide();
    var initial_mask_time = config.stimulus_timing.initial_mask_time;
    var stimulus_time = config.stimulus_timing.stimulus_time;
    var totalDelay = initial_mask_time + stimulus_time;
    setTimeout(function(){changeImageSrc(img, '<?php echo $src;?>')}, initial_mask_time);
    setTimeout(function(){changeImageSrc(img, "html/img/filter_example/Mask.png")}, totalDelay);
    setTimeout(function(){$('#ScalesBlock_<?php echo $id;?>').show();}, totalDelay);
    setTimeout(function(){$('#btn_<?php echo $id;?>').show();}, totalDelay);

  }
});

</script>