<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
<?php 
    session_start();
    # verified user is logged in
    if ($_SESSION['valid'] == false && $_SESSION['timeout'] < time()) {
        header('Refresh: 0; URL = test-login.php');
        die;
    }


    function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, - strlen($haystack)) !== false;
    }
    function endsWith($haystack, $needle) {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
    }

    $blog_titles = array();
    $dir   = 'blogs';
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
        		$myfile = fopen($blog_file, "r") or die("Unable to open file, $blog_content!");
	            $title = '';
	            while(!feof($myfile)) {
                	$text_line = fgets($myfile);
              		if(startsWith($text_line, ':title:')){
                		$title = str_replace(':title:', '', $text_line);
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



// configuration
$file = $blog_file;

// check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    # verified user is logged in
    if ($_SESSION['valid'] == false && $_SESSION['timeout'] < time()) {
        header('Refresh: 0; URL = test-login.php?previous=admin.php');
        die;
    }
    
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $extensions= array("jpeg","jpg","png", "gif");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="File not allowed";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be less than 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp, "images/" . $file_name);
      }else{
         print_r($errors);
      }
   }
    
}

// read the textfile
$text = file_get_contents($file);

?>
<!-- HTML form -->
<div id="blog_titles"><?php foreach($blog_titles as &$blog_title){echo "<a href='?blog_name=$blog_title[0]'>" . $blog_title[0] . "</a><br>";} ?></div>
<form>
	<textarea name="text"><?php echo htmlspecialchars($text) ?></textarea>
	<br>
	<input type="submit" />
	<input type="reset" />
</form>
<div id="images">
    <form id="images_form">
        <div class="container">
            <label class="test1" for="test1" id="test"></label><br>
            <input class="test1" id="test1" type="checkbox" name="test" value="test" /><label class="test1" for="test1">photo_name.jpeg</label>
        </div>
        <div class="container">
            <label class="test2" for="test2" id="test"></label><br>
            <input class="test2" id="test2" type="checkbox" name="test" value="test" /><label class="test2" for="test2">photo_name.jpeg</label>
        </div>
    </form>
</div>

<input id="delete_photo" type="submit" value="Delete Photo" />

<form id="upload_img" action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" />
    <input type="submit" value="Upload" />
</form>
</body>
</html>