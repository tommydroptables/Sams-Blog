<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
<?php 
    function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
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
            	array_push($blog_titles, $title);
        		fclose($myfile);
	       }
        }
    }



// configuration
$url = '?';
$file = $blog_file;

// check if form has been submitted
if (isset($_POST['text']))
{
    // save the text contents
    file_put_contents($file, $_POST['text']);

    // redirect to form again
    header(sprintf('Location: %s', $url));
    printf('<a href="%s">Moved</a>.', htmlspecialchars($url));
    exit();
}

// read the textfile
$text = file_get_contents($file);

?>
<!-- HTML form -->
<div id="blog_titles"><?php foreach($blog_titles as &$blog_title){echo '<a href="">' . $blog_title . "</a><br>";} ?></div>
	<form>
	<textarea name="text"><?php echo htmlspecialchars($text) ?></textarea>
	<br>
	<input type="submit" />
	<input type="reset" />
	</form>
</body>
</html>