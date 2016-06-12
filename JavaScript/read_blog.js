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
    $("#title_image_container").css("background-position", "center " + (window.scrollY / 2) + "px");
  });
});
