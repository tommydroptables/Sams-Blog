<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript" src="JavaScript/admin.js"></script>
      <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php

    session_start();
    # verified user is logged in
    if ($_SESSION['valid'] == false || $_SESSION['timeout'] < time()) {
        header('Refresh: 0; URL = test-login.php');
        die;
    }

    if (isset($_GET['blog'])) {
      $blog_name = $_GET['blog'];
    }

    if (isset($_GET['save'])) {
      $save_blog_name = $_GET['save'];
      $body_to_save = detectRequestBody();
      file_put_contents($save_blog_name, $body_to_save);
      var_dump($body_to_save);
    }

    if (isset($_GET['delete'])) {
      $ary_of_imgs = explode(",", $_GET['delete']);
      foreach($ary_of_imgs as &$img){
        $delete_image_name = $_SESSION['blog'] . "/images/" . $img;
        if(is_malicious_name($delete_image_name))
          if(is_correct_file_extension($delete_image_name))
            if(file_exists($delete_image_name))
              unlink($delete_image_name);
      }
    }

    function is_malicious_name($file_name) {
      if(strpos($file_name, '..') || strpos($file_name, 'www') || strpos($file_name, 'rm '))
        die;
      return true;
    }

    function detectRequestBody() {
      $rawInput = fopen('php://input', 'r');
      $tempStream = fopen('php://temp', 'r+');
      stream_copy_to_stream($rawInput, $tempStream);
      rewind($tempStream);

      return $tempStream;
    }

    function is_correct_file_extension($file){
      $extensions= array("jpeg","jpg","png", "gif");
      $file_ext  = strtolower(end(explode('.', $file)));
      // var_dump(in_array($file_ext, $extensions) === false);
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

    function get_thumbnail_photo_html($photo, $photo_full_path) {
      return "<div class='container'>" .
             "  <label style='background-image: url($photo_full_path)' class='add_cursor' for='$photo' id='test'></label><br>" .
             "  <input class='add_cursor' id='$photo' type='checkbox' /><label class='add_cursor' for='$photo'>$photo</label>" .
             "</div>";
    }

    $blog_titles = array();
    $dir   = "blogs";
    $blogs = scandir($dir);
    foreach($blogs as &$blog){
      # since this is linux we will need to skip '.' and '..'
      if($blog == '.' || $blog == '..') {
        continue;
      }


      $blog_str = "$dir/$blog";
      $blog_contents = scandir($blog_str);

      foreach($blog_contents as &$blog_content){
        # since this is linux we will need to skip '.' and '..'
      	if($blog_content == '.' || $blog_content == '..') {
          continue;
        }
      	# blog text file
      	if(endsWith($blog_content, '.txt')){
      		$blog_file = "$dir/$blog/$blog_content";
      		$myfile    = fopen($blog_file, "r") or die("Unable to open file, $blog_content!");
          $title     = '';
          while(!feof($myfile)) {
          	$text_line = fgets($myfile);
        		if(startsWith($text_line, ':title:')){
          		$title = trim(str_replace(':title:', '', $text_line));
              if($title === $blog_name){
                $_SESSION['blog'] = $blog_str;
                $_SESSION['blog_text_file'] = $blog_file;
              }
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
        	array_push($blog_titles, Array($title));
    		  fclose($myfile);
        }
      }
    }

//-------------------------------------------------------------------------
//              upload photo if request method is post.
//-------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    # verified user is logged in
    if ($_SESSION['valid'] == false && $_SESSION['timeout'] < time()) {
        header('URL = test-login.php?previous=test-login.php');
        die;
    }

   if(isset($_FILES['image'])){
      $errors    = array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp  = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_path =  $_SESSION["blog"] . "/images/" . $file_name;

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
if($_SESSION['blog']) {
  //-------------------------------------------------------------------------
  //     If blog that is passed through url exits then display it.
  //-------------------------------------------------------------------------
  $blog_contents = scandir($_SESSION['blog']);

  foreach($blog_contents as &$blog_content){
    # since this is linux we will need to skip '.' and '..'
    if($blog_content == '.' || $blog_content == '..') {
      continue;
    }
    # blog text file
    if(endsWith($blog_content, '.txt')){
      $text = file_get_contents($_SESSION['blog'] . '/' . $blog_content);
    }

    //-------------------------------------------------------------------------
    //                          Read in photos
    //-------------------------------------------------------------------------
    if($blog_content == "images"){
      $blog_image_dir = $_SESSION['blog'] . "/images";
      $blog_images = scandir($blog_image_dir);
      foreach($blog_images as &$blog_image){
        if($blog_image == '.' || $blog_image == '..') {
          continue;
        }
        array_push($image_thumbnails, get_thumbnail_photo_html($blog_image, './' . $blog_image_dir . '/' . $blog_image));
      }
    }
  }


}


?>
<!-- HTML form -->
<div id="blog_titles"><?php foreach($blog_titles as &$blog_title){echo "<a href='?blog=$blog_title[0]'>" . $blog_title[0] . "</a><br>";} ?></div>
<form>
	<textarea id="edit_blog" name="text"><?php echo htmlspecialchars($text) ?></textarea>
	<br>
	<input type="button" value="Save" onclick="on_page_submit(<?php echo "'" . $_SESSION['blog_text_file'] . "'" ?>)" />
  <input id="reset" type='reset' value="Reset Text" /> <!-- A page refresh will reset the editing section -->
	<input type='button' value="Go To This Blog" onclick='on_go_to_page(<?php echo "\"read_blog.php?blog_text_url=" . $_SESSION["blog_text_file"] . "&images_dir=" . $_SESSION["blog"] . "/images/\"" ?>)' />

<div id="images">
    <form id="images_form">
       <?php foreach($image_thumbnails as &$image_thumbnail){echo $image_thumbnail;} ?>
    </form>
</div>

<input id="delete_photo" type="submit" value="Delete Photo"  onclick="on_delete_image()" />

<form id="upload_img" action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" />
    <input type="submit" value="Upload"  />
</form>
</body>
</html>