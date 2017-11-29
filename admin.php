<!DOCTYPE html>
<html>
<head>
	<title>Thanks Pearl</title>
  <meta charset="UTF-8">
  <meta name="robots" content="NOODP">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Set up anaylitics -->
  <?php include_once("analytics/analyticstracking.php") ?>

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link href='https://fonts.googleapis.com/css?family=Rochester' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="JavaScript/jquery.min.js"></script>
    <script type="text/javascript" src="JavaScript/admin.js"></script>
    <script type="text/javascript" src="JavaScript/bootstrap.min.js"></script>
</head>
<body>
<?php

    session_start();


    //-------------------------------------------------------------------------
    //              verifiy user is logged in
    //-------------------------------------------------------------------------
    if ($_SESSION['valid'] == false || $_SESSION['timeout'] < time()) {
        header('Location: login.php');
        die;
    }

    //-------------------------------------------------------------------------
    //                  Helper functions
    //-------------------------------------------------------------------------
    function is_correct_file_extension($file){
      $extensions= array("jpeg","jpg","png", "gif");
      $file_ext  = strtolower(end(explode('.', $file)));
      if(in_array($file_ext, $extensions) === false)
         return false;
      return true;
    }

    function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, - strlen($haystack)) !== false;
    }
    function endsWith($haystack, $needle) {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
    }

    function is_malicious_file_name($file_name) {
      if(strpos($file_name, '..') || strpos($file_name, 'blogs') === false)
        die;
      return true;
    }

    function isnt_malicious_dir_name($dir_name) {
      if(strpos($dir_name, '..') || strpos($file_name, 'www') || strpos($file_name, 'rm ') || startsWith($text_line, '/') || startsWith($text_line, ' '))
        die;
      return true;
    }

    function delTree($dir) {
     $files = array_diff(scandir($dir), array('.','..'));
      # make sure to only delete images directory or a the blog .txt file
      foreach ($files as $file) {
          (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
        }
      return rmdir($dir);
    }

    function detectRequestBody() {
      $rawInput = fopen('php://input', 'r');
      $tempStream = fopen('php://temp', 'r+');
      stream_copy_to_stream($rawInput, $tempStream);
      rewind($tempStream);

      return $tempStream;
    }

    function get_thumbnail_photo_html($photo, $photo_full_path) {
      return "<div class='container'>" .
             "  <label style='background-image: url($photo_full_path)' class='add_cursor' for='$photo' id='image_thumbnail'></label><br>" .
             "  <input class='add_cursor' id='$photo' type='checkbox' /><label class='add_cursor' for='$photo'>$photo</label>" .
             "</div>";
    }

    function get_blog_title($blog_directory){
      $blog_str = "blogs/$blog_directory";
      $blog_contents = scandir($blog_str);

      foreach($blog_contents as &$blog_content){
        # since this is linux we will need to skip '.' and '..'
        if($blog_content == '.' || $blog_content == '..' || $blog_content == '.git' ) {
          continue;
        }

        # blog text file
        if(endsWith($blog_content, '.txt')){
          $blog_file = "$blog_str/$blog_content";
          $myfile    = fopen($blog_file, "r") or die("Unable to open file, $blog_file!");
          $title     = '';
          while(!feof($myfile)) {
            $text_line = fgets($myfile);
            if(startsWith($text_line, ':title:')){
              $title = trim(str_replace(':title:', '', $text_line));
              while(!feof($myfile)){
                $text_line = fgets($myfile);
                if(startsWith($text_line, ':summary:')){
                  break;
                }
                $title .= $text_line;
              }
            }
          }
          fclose($myfile);
        }
      }
      return $title;
    }

    function number_of_blogs() {
      $blogs_dir = scandir("blogs");
      $max_number = 0;
      foreach($blogs_dir as &$blogs_){
        # since this is linux we will need to skip '.' and '..'
        if($blogs_ == '.' || $blogs_ == '..' || $blogs_ == '.git') {
          continue;
        }
        if ($max_number < intval($blogs_)) {
          $max_number = intval($blogs_);
        }
      }
      return ++$max_number;
    }

    //-------------------------------------------------------------------------
    //     if blog number is not set try reading it out of the session
    //-------------------------------------------------------------------------
    $blog_number = $_SESSION["blog_number"];

    //-------------------------------------------------------------------------
    //                        GET URL Variables
    //-------------------------------------------------------------------------
    if (isset($_GET['blog'])) {
      $blog_number = $_GET['blog'];
    }

    if (isset($_GET['create'])) {
      $create_blog_name = urlencode($_GET['create']);
      // create directories for new blog
      $blog_dir_name = number_of_blogs();
      mkdir("blogs/$blog_dir_name/images", 0777, true);
      $myfile = fopen("blogs/$blog_dir_name/$blog_dir_name.txt", "w") or die("Unable to create file!");
      $txt = ":title: " . urldecode($create_blog_name) . "\n";
      fwrite($myfile, $txt);
      fclose($myfile);
      // Set blog_name details to new blog so it will be read in bellow
      header("Location: admin.php?blog=$blog_dir_name");
    }

    if (isset($_GET['save'])) {
      $save_blog_name = $_GET['save'];
      $body_to_save = detectRequestBody();
      file_put_contents($save_blog_name, $body_to_save);
      header('Location: admin.php');
    }

    if (isset($_GET['delete'])) {
      $ary_of_imgs = explode(",", $_GET['delete']);
      foreach($ary_of_imgs as &$img){
        $delete_image_name = $_SESSION['blog_dir'] . "/images/" . $img;
        if(is_malicious_file_name($delete_image_name))
          if(is_correct_file_extension($delete_image_name))
            if(file_exists($delete_image_name))
              unlink($delete_image_name);
      }
      header('Location: admin.php');
    }

    if (isset($_GET['delete_blog'])) {
      $blog_to_delete = $_GET['delete_blog'];
      if (!is_dir("blogs/$blog_to_delete")) {
        if (isnt_malicious_dir_name($blog_to_delete)) {
          echo "deleting this blog:" . "$blog_to_delete";
          delTree("$blog_to_delete");
        }
        header('Location: admin.php');
      }
    }


    //-------------------------------------------------------------------------
    //                 Loop through blog directory
    //-------------------------------------------------------------------------
    $blog_titles = array();
    $dir   = "blogs";

    // Loop through all blogs
    $blogs = scandir($dir);
    foreach($blogs as &$blog){

      # since this is linux we will need to skip '.' and '..'
      # make sure we are just looking at the blog specified
      if($blog == '.' || $blog == '..' || $blog == '.git') {
        continue;
      }

      # Keep track of all blogs and their title and directory numbers
      array_push($blog_titles, Array(get_blog_title($blog), $blog));

      if($blog_number != $blog) {
        continue;
      }

      $blog_str = "$dir/$blog";
      $blog_file = "$blog_str/$blog.txt";

      // Save blog and blog text file to cache
      $_SESSION['blog_dir'] = $blog_str;
      $_SESSION['blog_number'] = $blog_number;
      $_SESSION['blog_text_file'] = $blog_file;

  	  # load blog text file
  		$blog_file = "$dir/$blog/$blog.txt";
  		$myfile    = fopen($blog_file, "r") or die("Unable to open file, $blog_file!");
      $title     = '';
      while(!feof($myfile)) {
      	$text_line = fgets($myfile);
    		if(startsWith($text_line, ':title:')){
      		$title = trim(str_replace(':title:', '', $text_line));
      		# read in title
      		while(!feof($myfile)){
      			$text_line = fgets($myfile);
      			if(startsWith($text_line, ':summary:')){
      		  	break;
      			}
      			$title .= $text_line;
      		}
    		}
    	}
		  fclose($myfile);
    }

//-------------------------------------------------------------------------
//              upload photo if request method is post.
//-------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    # verified user is logged in
    if ($_SESSION['valid'] == false && $_SESSION['timeout'] < time()) {
        header('Location: login.php?previous=login.php');
        die;
    }

   if(isset($_FILES['image'])){
      $errors    = array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp  = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_path =  $_SESSION["blog_dir"] . "/images/" . $file_name;

      if(!is_correct_file_extension($_FILES['image']['name'])){
         $errors[] = "File not allowed";
      }

      if(file_exists($file_path))
        $errors[] = 'File already Exists';


      if($file_size > 2097152){
         $errors[] = 'File size must be less than 2 MB';
      }

      if(empty($errors) == true){
         move_uploaded_file($file_tmp, $file_path);
      }else{
         print("<p style='color:red'>");
         print_r($errors);
         print("</p>");
      }
   }
}

//-------------------------------------------------------------------------
//                            If blog exists
//-------------------------------------------------------------------------
$image_thumbnails = Array();
$text = "";
if($_SESSION['blog_dir']) {
  //-------------------------------------------------------------------------
  //     If blog that is passed through url exits then display it.
  //-------------------------------------------------------------------------
  $blog_contents = scandir($_SESSION['blog_dir']);

  foreach($blog_contents as &$blog_content){
    # since this is linux we will need to skip '.' and '..'
    if($blog_content == '.' || $blog_content == '..' || $blog_content == '.git' ) {
      continue;
    }
    # blog text file
    if(endsWith($blog_content, '.txt')){
      $text = file_get_contents($_SESSION['blog_dir'] . '/' . $blog_content);
    }

    //-------------------------------------------------------------------------
    //                          Read in photos
    //-------------------------------------------------------------------------
    if($blog_content == "images"){
      $blog_image_dir = $_SESSION['blog_dir'] . "/images";
      $blog_images = scandir($blog_image_dir);
      foreach($blog_images as &$blog_image){
        if($blog_image == '.' || $blog_image == '..' || $blog_image == '.git') {
          continue;
        }
        array_push($image_thumbnails, get_thumbnail_photo_html($blog_image, './' . $blog_image_dir . '/' . $blog_image));
      }
    }
  }


}

?>
<form>
	<textarea id="edit_blog" class="add_left_margin add_top_margin add_right_margin" name="text"><?php echo htmlspecialchars($text) ?></textarea>
	<br>
	<input type="button" value="Save" class="button_left add_left_margin" onclick="on_page_submit(<?php echo "'" . $_SESSION['blog_text_file'] . "'" ?>)" />
  <input type="button" value="Help?" class="add_left_margin button_left" data-toggle="modal" data-target="#new_blog_modal_help" />
    <input type='button' value="Go To This Blog" class="add_left_margin button_left" onclick='on_go_to_page(<?php echo "\"read_blog.php?blog_text_url=" . $_SESSION["blog_text_file"] . "&images_dir=" . $_SESSION["blog_dir"] . "/images/\"" ?>)' />

  <input type="button" value="Select or Create Blog" class="button_right"  data-toggle="modal" data-target="#new_blog_modal_select_blog" />




<div id="images">
    <form id="images_form">
       <?php foreach($image_thumbnails as &$image_thumbnail){echo $image_thumbnail;} ?>
    </form>
</div>

<input class="delete" type="button" value="Delete Blog"  onclick=on_delete_blog(<?php echo '"' . htmlspecialchars($_SESSION['blog_dir']) . '"'?>) />
<input class="delete" type="submit" value="Delete Photo"  onclick="on_delete_image()" />
<input class="delete" type="submit" value="Log Out"  onclick="log_out()" />

<form id="upload_img" action="" method="POST" class="button_left" enctype="multipart/form-data">
    <input type="file" name="image" class="add_left_margin"/>
    <input type="submit" value="Upload"  />
</form>

<div id="new_blog_modal_add_blog" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Enter Blog Name</h4>
      </div>
      <div class="modal-body">
        <input id="new_blog_name" style="text-align: center; width: 100%" type="text" name="">
      </div>
      <div class="modal-footerf">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="on_create_blog_submit()" data-dismiss="modal">Create Blog</a>
      </div>
    </div>
  </div>
</div>

<div id="new_blog_modal_help" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Markdown Cheat Sheet</h4>
      </div>
      <div class="modal-body">
        <div class="left"><b>:title: Your title Here</b> <- title of blog</div>
        <div class="left"><b>:summary:image.jpg:focus: Your Summary Here</b> <- summary and the image to show on the front page with the summary</div>
        <HR>
        <div class="left"><b>NOTE: The elements below are part of the article</b></div>
        <div class="left"><b>:article:image.jpg:focus: Your article Here</b> <- article and the image to show on the top of the article page</div>
        <div class="left"><b>:image-left:image.jpg:focus:</b> <- images that show inline in the article on the left side of the page</div>
        <div class="left"><b>:image-right:image.jpg:focus:</b> <- images that show inline in the article on the right side of the page</div>
        <div class="left"><b>:image-full:image.jpg:focus:</b> <- images that show inline in the article that will be full width of the article</div>
        <div class="left"><b>focus: You can use a percentage. 0% is the top. 100% is the bottom. You can go over 100% too :)</b></div>
      </div>
    </div>
  </div>
</div>

<div id="new_blog_modal_select_blog" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">

    <div class="modal-content select_blog">
      <div class="modal-header select_blog_header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Select Blog</h4>
      </div>
      <div class="modal-body">
        <!-- Output blog buttons -->
        <button id="create_blog" type="button" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" data-target="#new_blog_modal_add_blog">Create Blog</button>
          <?php
            foreach($blog_titles as &$blog_title){
              echo "<div><a href='?blog=" . $blog_title[1] . "' class='blog_links btn btn-primary' >" . $blog_title[0] . "</a></div>";
            }
          ?>


      </div>
    </div>
  </div>
</div>

</body>
</html>
