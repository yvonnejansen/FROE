/* Below are the first columns of the log file. They are initialized with information either collected
 * directly from the URL parameters of Prolific or from the browser of the participant.
 * The latter is collected mainly for debug reasons. For example, if some participants complain that 
 * the experiment didn't work for them, this can help figuring out whether the browser
 * version is the culprit.
 */
    var measurements = {};
    $('#experiment-info').children().each(function() {
      measurements[$(this).attr('id')] = $(this).val();
    });
    measurements["timestamp_0"] = Date.now();
    var browserInfo = bowser.getParser(window.navigator.userAgent);
    measurements["browser_name"] = browserInfo.getBrowserName();
    measurements["browser_version"] = browserInfo.getBrowserVersion();
    measurements["os"] = browserInfo.getOSName();




var excluded = false;

// save timestamps each time "next" is clicked
$('body').on('next', function(e, type){
  window.scrollTo(0, 0); // Make sure that every page is presented from the top (without it, longer pages start at the middle of the page)
  var page_number = $('#page_' + type).val();
  // console.log("page number" + page_number);
  // If someone accepts the informed consent, we consider them participants and they cannot reload the page nor finish later.
  // write the cookie checking for the state
  // add a warning when they try to reload
  if (page_number > 1 && $('#is_debug') < 1) {
    document.cookie = "accepted=1;max-age=" + 60*60*24*14;
    window.onbeforeunload = function() {
      alert('Reloading or closing the window will lead to exclusion from the experiment.');
      var confirmClose = confirm('Close?');
    return confirmClose;
    };
  }

  var event_name = 'timestamp_' + page_number;
  measurements[event_name] = Date.now();

  if (page_number === '2') {
    $.ajax({
      url: 'ajax/agreed.php',
      type: 'POST',
      data: JSON.stringify(measurements),
      contentType: 'application/json',
      success: function (data) {
        // console.log("The participant agreed.");
        // console.log(measurements);
      }
    });
  }

  // the below is for intermediary logging of the completion of each page. Deactivate if not needed.
  $.ajax({
    url: 'ajax/log.php',
    type: 'POST',
    data: JSON.stringify(measurements),
    contentType: 'application/json',
    success: function (data) {
      // console.log('Page: ' + page_number);
      // console.log(measurements);
    }
  });

});

// send data upon 'finished' event
$('body').on('finished', function(e, type){
  if (!excluded) {
    $.ajax({
      url: 'ajax/results.php',
      type: 'POST',
      data: JSON.stringify(measurements),
      contentType: 'application/json',
      success: function (data) {
        console.log("Experiment finished.");
        $('#completion_code').html(data);
        $(":button").hide();
        window.onbeforeunload = null;
      }
    });
  }
});

// send message upon 'excluded' event
$('body').on('excluded', function(e, type){
  // console.log("excluded; sending notice to server");
  measurements["reloaded"] = false;
  measurements["excluded"] = true;
  window.onbeforeunload = null;
  $.ajax({
    url: 'ajax/excluded.php',
    type: 'POST',
    data: JSON.stringify(measurements),
    contentType: 'application/json',
    success: function (d) {
      console.log("Participant excluded because of the attention check.");
      console.log(measurements);
    }
  });
});

// send message upon 'reloader' event
$('body').on('reloaded', function(e, type){
  console.log("reloaded; sending notice to server");
  measurements["reloaded"] = true;
  measurements["excluded"] = true;
  window.onbeforeunload = null;
  $.ajax({
    url: 'ajax/excluded.php',
    type: 'POST',
    data: JSON.stringify(measurements),
    contentType: 'application/json',
    success: function (d) {
      console.log("Participant excluded because page reload.");
      console.log(measurements);
    }
  });
});
