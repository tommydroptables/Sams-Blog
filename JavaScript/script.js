$(document).ready(function() 
{
    // Read in card on page and cache them
    read_in_cards();

    // Call on page load so cards are scalled correctly
	onWindowResize();

    // Fit title area to size of title
    size_titles();
});

// Cache 2 colomn and 3 colomn html when user resizes the page
var Global_two_column_cards = "";
var Global_three_column_cards = "";

// ------------------------------------------------------------------
//                 Navigation to get to full blog
// ------------------------------------------------------------------
function read_more(href_blog_text, href_blog_images_folder){
    window.location.href = ('/Sams-Blog/read_blog.php?blog_text_url=' + href_blog_text +
                      '&images_dir=' + href_blog_images_folder);
}

// ------------------------------------------------------------------
//                 Size Title to fit in title area
//       1) Set the size of containers to show Text correctly
//       2) Set hover of tile so text slides in
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
    var text_size = (window.innerWidth > 450 ? '4em' : '3em'); 
    var line_width = (window.innerWidth > 450 ? '400px' : '275px'); 
    if (window.scrollY > 10) {
        $(".navbar").css("transition", "padding-bottom 1s");
        $("#title_t_pearl").css("font-size", '2em');
        $(".navbar").css("padding-bottom", "0rem");
        $("#slogan_inner").css("width", "200px");
    } else {
        $(".navbar").css("transition", "padding-bottom 1s .5s");
        $("#title_t_pearl").css("font-size", text_size);
        $(".navbar").css("padding-bottom", "1rem");
        $("#slogan_inner").css("width", line_width);
    }
});

// ------------------------------------------------------------------
//           Make background dark when card is hovered
// ------------------------------------------------------------------
function add_linear_gradiant(element, images_path){
    var title_height =  $(element).find(".tile_background_image");

    $(title_height).css("background-image", "linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)), url(" + images_path + ")");
}
function remove_linear_gradiant(element, images_path){
    var title_height =  $(element).find(".tile_background_image");
    $(title_height).css("background-image", "linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)), url(" + images_path + ")");
}

// ------------------------------------------------------------------
//   Correctly show correct columns of cards when page is resized
// ------------------------------------------------------------------
function read_in_cards(){
    Global_two_column_cards = document.getElementById("two_column_cards").innerHTML;
    Global_three_column_cards = document.getElementById("three_column_cards").innerHTML;
}

$(window).resize(function () {
	/* jQuery toggle layout */
	onWindowResize();

    // card hover needs to be re-caluculated every time page is resized
    // 
    size_titles();
}); 

function onWindowResize() {
	if(window.innerWidth > 1050) {
        $('#row').html(Global_three_column_cards);
    }
    else if(window.innerWidth < 1050 && window.innerWidth > 550) {
        $('#row').html(Global_two_column_cards);
    }
    else if(window.innerWidth < 550) {
        $('body .col-md-4').addClass('col-md-12').removeClass('col-md-4').removeClass('col-md-6').removeClass('col-sm-6');
        $('body .col-md-6').addClass('col-md-12').removeClass('col-md-4').removeClass('col-md-6').removeClass('col-sm-6');
    }
}	
