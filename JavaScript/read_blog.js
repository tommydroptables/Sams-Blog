$(document).ready(function()
{
  // ------------------------------------------------------------------
  //          Set vh so webpage isn't glitchy on mobile
  // ------------------------------------------------------------------
  var window_height = window.innerHeight;
  $('#title_image_container').css('height', (window_height * .7) + 'px');
  $('.inpage_image_left').css('height', window_height * .3 +  'px');
  $('.inpage_image_right').css('height', window_height * .3 + 'px');
  $('.inpage_image_full').css('height', window_height * .4 + 'px');
  // ------------------------------------------------------------------
  //                         Parallax Image
  // ------------------------------------------------------------------
  $(document).scroll(function() {
    var background_deets = $("#title_image_container").css("background-position").split(" ")
    var positionx = background_deets[0]
    var positiony = background_deets[1]
    var new_positiony = 0;
    if (positiony.endsWith('px')) {
      new_positiony = positiony.replace('px', '');
    }
    else if (positiony.endsWith('%')) {
      var percent = positiony.replace('%', '');
      new_positiony = $("#title_image_container").height() * Number("." + percent);
    }

    console.log("X: " + positionx);
    console.log("Y: " + positiony);
    console.log("new Y: " + new_positiony);

    $("#title_image_container").css("background-position", positionx + " " + (new_positiony + (window.scrollY / 2)) + "px");
  });
});
