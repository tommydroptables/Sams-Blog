$(document).ready(function() 
{
   
});
// ------------------------------------------------------------------
//                 Parallax Image
// ------------------------------------------------------------------
$(document).scroll(function() {
	console.log("here");

    $("#title_image_container").css("background-position", "center " + (window.scrollY / 2) + "px");
});