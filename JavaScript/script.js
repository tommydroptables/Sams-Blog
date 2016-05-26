$(document).ready(function() 
{
    // Read in card on page and cache them
    read_in_cards();

    // Call on page load so cards are scalled correctly
	onWindowResize();
    // Fit title area to size of title
    if(mobileAndTabletcheck())
        size_titles_mobile();
    else
        size_titles();

    set_on_hover_title();

});

window.set_on_hover_title = function() {
    console.log("here");
    $("#title_t_pearl").hover(function() {
        $("#title_t_pearl").css("color","white");
        $("#slogan_inner").css("border-color","white");
    },function() {
        $("#title_t_pearl").css("color","#3b3d3c");
        $("#slogan_inner").css("border-color","#3b3d3c");
    });
}

// Cache 2 colomn and 3 colomn html when user resizes the page
var Global_two_column_cards = "";
var Global_three_column_cards = "";


// ------------------------------------------------------------------
//         if mobile add attributes
// ------------------------------------------------------------------
window.mobileAndTabletcheck = function() {
  var check = false;
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
  return check;
}

function is_mobile() {
    if(mobileAndTabletcheck()) {
        
    }
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

function size_titles_mobile(){
    $(".tile_container").each(function(){
        // Set up container sizes becuase they will all be different
        var title_height =  $(this).find(".panel_heading_span").height(); 
        $(this).find(".panel-heading-container").css("height", (title_height + 8) + "px");
        $(this).find(".article_descrption_container").css("padding-top", (title_height + 8) + "px");
        $(this).find(".panel-heading-container-absolute").css("margin-top",  "-" + (title_height + 8) + "px");
        $(this).find(".tile_background_image").css("padding-bottom",  ((title_height + 10) + 40)   + "px")
                     .css("margin-bottom", "-" + (title_height + 10) + "px");
        $(this).find(".panel-heading-container-absolute").css("top", ((title_height + 10) + 17) + "px");
        
        // Change the text so there is not need to hover on mobile
        $(this).find(".article_descrption").css("opacity","1");
        $(this).find(".article_descrption").css("color","white");
        $(this).find(".panel-heading-container-absolute").css("color","white");
        $(this).mouseover();
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
    if(mobileAndTabletcheck())
        size_titles_mobile();
    else
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
        if($("#two_column_cards").length > 0)
            $('#row').html(Global_two_column_cards);
        $('body .col-md-4').addClass('col-md-12').removeClass('col-md-4').removeClass('col-md-6').removeClass('col-sm-6');
        $('body .col-md-6').addClass('col-md-12').removeClass('col-md-4').removeClass('col-md-6').removeClass('col-sm-6');
    }
}	
