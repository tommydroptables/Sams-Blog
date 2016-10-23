<!DOCTYPE html>
<html>
  <head>
  <!-- Set up Mobile meta -->
  <meta charset="UTF-8">
  <meta name="description" content="Things I wish people have told me">
  <meta name="keywords" content="HTML,CSS,XML,JavaScript">
  <meta name="author" content="Dr. Parker">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" type="text/css" href="css/tile.css">
  <link rel="stylesheet" type="text/css" href="css/read_blog.css">
    <link rel='stylesheet' type='text/css' href="fonts/rochester">

  <script type="text/javascript" src="JavaScript/jquery.min.js"></script>
  <script type="text/javascript" src="JavaScript/bootstrap.min.js"></script>
  <script src="JavaScript/header.js"></script>
  <script src="JavaScript/read_blog.js"></script>

  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="navbar-header navbar-center">
        <a class="navbar-brand" id="title_t_pearl" href="/">Thanks Pearl ...</a>
    </div>
        <div id="slogan_inner"></div>
  </nav>
</head>
<body>
  <div id="menu_spacing"></div>
    <?php
      # Useful functions
      function startsWith($haystack, $needle) {
          // search backwards starting from haystack length characters from the end
          return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
      }
      function endsWith($haystack, $needle) {
          // search forward starting from end minus needle length characters
          return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
      }

      function getPhoto($photo_url) {
        // Verify Photo exists before displaying it
        if (file_exists($photo_url))
          return $photo_url;
        else
          return "images/default.jpg";
      }

      # read in variables from url
      $blog_text_url = $_GET["blog_text_url"];
      $images_dir    = $_GET["images_dir"];

      $myfile = fopen($blog_text_url, "r") or die("Unable to open file, $blog_content!");

      // Elements we need to read in from the blog file
      $title         = '';
      $article       = '';
      $article_image = '';
      $image_left    = '';
      $image_right   = '';
      $image_full    = '';

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

        if(startsWith($text_line, ':article:')){
          // Read in image from article
          $article_image = explode(":", $text_line)[2];
          // position of backgournd image on the x axis (should be a percentage)
          $article_image_position = explode(":", $text_line)[3];
              
          // Replace article and image so you don't see them in blog
          $article = str_replace(':article:', '', $text_line);
          $article = str_replace($article_image . ':', '', $article);
          
          $text_line = "<p>" . $text_line;
          # read in article
          while(!feof($myfile)){
            $previous_line = $text_line;
            $text_line = fgets($myfile);
            # Check for paragraph ending in article
            if(trim($text_line) == ''){
              $text_line .= "</p><p>";
            }

            # Check for images in article
            if(startsWith($text_line, ':image-')){
              $float_class = '';
              $temp_postion = '100%';
              if(startsWith($text_line, ':image-left')){
                $float_class = 'inpage_image_left';
              }
              if(startsWith($text_line, ':image-right')){
                $float_class = 'inpage_image_right';
              }
              if(startsWith($text_line, ':image-full')){
                $float_class = 'inpage_image_full';
              }

              // Find the position of the photo
              $image_info = explode(":", $text_line);
              $article_small_image = $image_info[2];
              if (count($image_info) == 4)
              {
                $temp_postion = $image_info[3];
              }

              $text_line = '</p><div style="background-position: ' . $temp_postion . '; background-image: url(' . getPhoto($images_dir . $article_small_image) . ')" class="basic_image_attributes ' . $float_class . '"></div><p>';
            }
            $article .= $text_line;
          }
          $text_line .= "</p>";
        }
      }

      $temp_style = "background-position: center " . $article_image_position . "; background-image: url(" . getPhoto($images_dir . $article_image) . ")";

      echo("<div style='" . $temp_style . "' class='basic_image_attributes " . $position_class . "' id='title_image_container'></div>");

      echo("<div id='text_body'>");
      echo("<h1 id='article_title'>" . $title . "</h1>");
      echo("<h5 id='article_author'>Author: Dr. Parker</h5>");
      echo($article);
      
      session_start();
      if ($_SESSION['valid'] == true || $_SESSION['timeout'] > time()) {
        echo("<a id='back_to_editing' class='btn btn-primary' href='admin.php' role='button'>Back To Edit Blog</a>");
      }

    ?>
</body>
<footer>
    <p  id="creator">
      <a href="http://www.cocozzello.com">© 2016 by Tom Cocozzello</a>
    </p>
</footer>
</html>
