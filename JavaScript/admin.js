$(document).ready(function()
{

});

function on_page_submit(url_to_go_to){
	var edited_blog_content = $('#edit_blog').val();
	console.log(edited_blog_content);
	console.log("?save=" + url_to_go_to);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "/Sams-Blog/admin.php?save=" + url_to_go_to, true);
	xhttp.send(edited_blog_content);
}

function on_go_to_page(page) {
	window.location.replace(page);
}

function on_delete_image() {
	var checked_images = $(".add_cursor:checked");
	var images_names_to_delete = "";
	$.each(checked_images, function(key, value) {
		images_names_to_delete += value.id + ",";
	});
	window.location.href = "/Sams-Blog/admin.php?delete=" + images_names_to_delete;
}