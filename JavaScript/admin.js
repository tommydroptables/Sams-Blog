$(document).ready(function()
{

});

function on_page_submit(url_to_go_to){
	var edited_blog_content = $('#edit_blog').val();
	console.log(edited_blog_content);
	console.log("?save=" + url_to_go_to);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "/Sams-Blog/admin.php?save=" + url_to_go_to, true);
	// xhttp.setRequestHeader("Content-type", "application/json");
	xhttp.send(edited_blog_content);
	// $.ajax({
	//     type: "POST",
	//     url: "admin.php?save=" + url_to_go_to,
	//     processData: false,
	//     data: edited_blog_content
	// });
}

function on_go_to_page(page) {
	window.location.replace(page);
}