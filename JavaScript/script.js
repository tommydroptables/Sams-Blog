$(document).ready(function() 
{
    // Call on page load so tiles are scalled correctly
	onWindowResize();

    // Fit title area to size of title
    size_titles();

    // Set on hover of title so the line under it changes
    // color as well
    $('#title_t_pearl').hover(function(){
        $('#slogan_inner').css('border-color', 'white');
    }, function() {
        $('#slogan_inner').css('border-color', '#3b3d3c');
    });
});

// ------------------------------------------------------------------
//                 Remove the read more button from
//                 blog if the user is NOT mobile
// ------------------------------------------------------------------
function remove_readmore(){

}


// ------------------------------------------------------------------
//                 Navigation to get to full blog
// ------------------------------------------------------------------
function read_more(href_blog_text, href_blog_images_folder){
    window.location.href = ('/Sams-Blog/read_blog.php?blog_text_url=' + href_blog_text +
                      '&images_dir=' + href_blog_images_folder);
}

// ------------------------------------------------------------------
//                 Size Title to fit in title area
// ------------------------------------------------------------------
function size_titles(){
    $(".tile_container").each(function(){
        var title_height =  $(this).find(".panel_heading_span").height(); 
        $(this).find(".panel-heading-container").css("height", (title_height + 8) + "px");
        $(this).find(".article_descrption_container").css("padding-top", (title_height + 8) + "px");
        $(this).find(".panel-heading-container-absolute").css("margin-top",  "-" + (title_height + 8) + "px");
        $(this).hover(function(e) {
            $(this).find(".tile_background_image").css("padding-bottom",  ((title_height + 10) + 40)   + "px")
                .css("margin-bottom", "-" + (title_height + 10) + "px");
            $(this).find(".panel-heading-container-absolute").css("top", ((title_height + 10) + 17) + "px");
        }, function(e) {
            $(this).find(".tile_background_image").css("padding-bottom",  "40px")
                .css("margin-bottom", "0px");
            $(this).find(".panel-heading-container-absolute").css("top", "100%");
        });
        
    });
}


// ------------------------------------------------------------------
//                 Scroll Effect for Nav Bar
// ------------------------------------------------------------------
$(document).scroll(function() {
    if (window.scrollY > 10) {
        $("#slogan").css("transition", "height 1s, margin-bottom 1s");
        $("#title_t_pearl").css("font-size", "2em");
        $("#slogan").css("height", "1px");
        $("#slogan").css("margin-bottom", "0rem");
        // $("#slogan_inner").css("border-color", "rgba(255,255,255,1)");
        $("#slogan_inner").css("width", "200px");
    } else {
        $("#slogan").css("transition", "height 1s 1s, margin-bottom 1s 1s");
        $("#title_t_pearl").css("font-size", "4em");
        $("#slogan").css("height", "1px");
        $("#slogan").css("margin-bottom", "1rem");
        // $("#slogan_inner").css("border-color", "rgba(255,255,255,1)");
        $("#slogan_inner").css("width", "400px");
    }
});


function add_linear_gradiant(element, images_path){
    var title_height =  $(element).find(".tile_background_image");

    $(title_height).css("background-image", "linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)), url(" + images_path + ")");
    console.log("hover");
}

function remove_linear_gradiant(element, images_path){
    var title_height =  $(element).find(".tile_background_image");
    $(title_height).css("background-image", "linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)), url(" + images_path + ")");
    console.log("out");
}

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
