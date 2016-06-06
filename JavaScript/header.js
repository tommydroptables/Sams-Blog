$(document).ready(function() 
{
    set_on_hover_title();
});

// ------------------------------------------------------------------
//     Can't set this with css since slogan_inner is'nt a child
//       element of the attribute that on hover is set on
// ------------------------------------------------------------------
window.set_on_hover_title = function() {
    $("#title_t_pearl").hover(function() {
        $("#title_t_pearl").css("color","white");
        $("#slogan_inner").css("border-color","white");
    },function() {
        $("#title_t_pearl").css("color","#3b3d3c");
        $("#slogan_inner").css("border-color","#3b3d3c");
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
