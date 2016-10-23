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
    var scale_mulitplier = window_width / articleImgWidth;
    var scaled_height = articleImgHeight * scale_mulitplier;


    var background_container_position = $("#title_image_container").css("background-position").split(" ");
    var positionx = background_container_position[0];
    var positiony = background_container_position[1];

    var article_vewer_height = $("#title_image_container").height();

    console.log("SCALED HEIGHT: " + scaled_height);
    console.log("VIEWER HEIGHT: " + article_vewer_height);

    $(document).scroll(function() {

      var scaler = 1;
      // If position Y was 100 percent the image hight will equal itself so don't do the math
      if (positiony.endsWith('%') && positiony != '100%') {
        scaler = Number("." + positiony.replace('%', ''));
      }

      var new_psoition = (((scaled_height - article_vewer_height) * scaler) * -1) + (window.scrollY / 2);
      console.log(new_psoition);

      $("#title_image_container").css("background-position", positionx + " " + new_psoition + "px");
    });
  }
});
