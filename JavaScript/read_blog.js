$(document).ready(function()
{
  // ------------------------------------------------------------------
  //    Find the height of the artilce image to smoothly diplay paralax
  // ------------------------------------------------------------------
  var articleImgHeight = null;

  var window_width = $(window).width();

  var image_url = $('#title_image_container').css('background-image'), image;
  // Remove url() or in case of Chrome url("")
  image_url = image_url.match(/^url\("?(.+?)"?\)$/);

  // Declare vars while the page loads to not waste time while running the set_parallax function
  var background_container_position = $("#title_image_container").css("background-position").split(" ");
  var positionx = background_container_position[0];
  var positiony = background_container_position[1];

  // Find the height of the article image  
  if (image_url[1]) {
    image_url = image_url[1];
    image = new Image();

    // just in case it is not already loaded
    $(image).load(function () {
        articleImgHeight = image.height;
        articleImgWidth = image.width;
        // Set listener on photo not that we have the full photo size
        set_parallax();
    });

    image.src = image_url;
  }  
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
  function set_parallax(){
    var scale_mulitplier     = window_width / articleImgWidth;
    var scaled_height        = articleImgHeight * scale_mulitplier;
    var article_vewer_height = $("#title_image_container").height();
    var scaler = 1;

    function on_scroll() {
      scaler = 1;
      // If position Y was 100 percent the image hight will equal itself so don't do the replacement
      if (positiony.endsWith('%') && positiony != '100%') {
        scaler = Number("." + positiony.replace('%', ''));
      }

      $("#title_image_container").css("background-position", positionx + " " + (
        ((scaled_height - article_vewer_height) * scaler * -1) + (window.scrollY / 2)) + "px");
    }

    // Exectute once before on scroll to postion the image relative to the page
    on_scroll();

    $(document).scroll(function() {
      on_scroll();
    });
  }

  
});
