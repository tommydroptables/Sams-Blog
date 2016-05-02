$(document).ready(function() 
{
    // Call on page load so tiles are scalled correctly
	onWindowResize();

    // ------------------------------------------------------------------
    //   remove filter of background on hover to make it look better
    // ------------------------------------------------------------------
    $('.tile_container').hover(function(){
        $(this).children().find('span').css('background', 'linear-gradient(rgba(0, 0, 0, 0),rgba(0, 0, 0, 0))');
    }, function(){
        $(this).children().find('span').css('background', 'linear-gradient(rgba(0, 0, 0, .5),rgba(0, 0, 0, .5))');
    });
});

// ------------------------------------------------------------------
//                 Scroll Effect for Nav Bar
// ------------------------------------------------------------------
$(document).scroll(function () {
	console.log("here");
    if (window.scrollY > 10) {
        $("#slogan").css("transition", "height 1s, margin-bottom 1s");
        $("#title_t_pearl").css("font-size", "2em");
        $("#slogan").css("height", "1px");
        $("#slogan").css("margin-bottom", "0rem");
        $("#slogan_inner").css("border-color", "rgba(255,255,255,1)");
        $("#slogan_inner").css("width", "200px");
    } else {
        $("#slogan").css("transition", "height 1s 1s, margin-bottom 1s 1s");
        $("#title_t_pearl").css("font-size", "4em");
        $("#slogan").css("height", "25px");
        $("#slogan").css("margin-bottom", "1rem");
        $("#slogan_inner").css("border-color", "rgba(255,255,255,0)");
        $("#slogan_inner").css("width", "366px");
    }
});


// ------------------------------------------------------------------
//                      Tile Resize Effect
// ------------------------------------------------------------------
$(window).resize(function () {
	/* jQuery toggle layout */
	onWindowResize();
}); 
function onWindowResize() {
	if(window.innerWidth > 1050) {
        $('body .col-md-6').addClass('col-sm-6').addClass('col-md-4').removeClass('col-md-6').removeClass('col-md-12');
        $('body .col-md-12').addClass('col-sm-6').addClass('col-md-4').removeClass('col-md-6').removeClass('col-md-12');
    }
    else if(window.innerWidth < 1050 && window.innerWidth > 750) {
        $('body .col-md-4').addClass('col-sm-6').addClass('col-md-6').removeClass('col-md-4').removeClass('col-md-12');
        $('body .col-md-12').addClass('col-sm-6').addClass('col-md-6').removeClass('col-md-4').removeClass('col-md-12');
    }
    else if(window.innerWidth < 768) {
        $('body .col-md-4').addClass('col-md-12').removeClass('col-md-4').removeClass('col-md-6').removeClass('col-sm-6');
        $('body .col-md-6').addClass('col-md-12').removeClass('col-md-4').removeClass('col-md-6').removeClass('col-sm-6');
    }
}	
