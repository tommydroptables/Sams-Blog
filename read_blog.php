<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link href='https://fonts.googleapis.com/css?family=Rochester' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" type="text/css" href="css/tile.css">
  <link rel="stylesheet" type="text/css" href="css/read_blog.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="JavaScript/script.js"></script>
  <script src="JavaScript/read_blog.js"></script>

  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="navbar-header navbar-center">
        <a class="navbar-brand" id="title_t_pearl" href="index.php">Thanks Pearl ...</a>
    </div>  
        <p id="slogan"><span id="slogan_inner"></span></p>
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
          
          // Replace article and image so you don't see them in blog
          $article = str_replace(':article:', '', $text_line);
          $article = str_replace($article_image . ':', '', $article);

          $text_line = "<p>" . $text_line;
          # read in article
          while(!feof($myfile)){
            $text_line = fgets($myfile);
            # Check for paragraph ending in article
            if(startsWith($text_line, '')){
              $text_line .= "</p><p>";
            }
            
            # Check for images in article
            if(startsWith($text_line, ':image-')){
              $float_class = '';
              if(startsWith($text_line, ':image-left')){
                $float_class = 'inpage_image_left';
              }
              if(startsWith($text_line, ':image-right')){
                $float_class = 'inpage_image_right';
              }
              if(startsWith($text_line, ':image-full')){
                $float_class = 'inpage_image_full';
              }
              $article_image = explode(":", $text_line)[2];
              $text_line = '<div style="background-image: url(' . getPhoto($images_dir . $article_image) . ')" class="basic_image_attributes ' . $float_class . '"></div>';
            }
            $article .= $text_line; 
          }
          $text_line .= "</p>";
        }
      }
      echo("<div style='background-image: url(" . getPhoto($images_dir . $article_image) . ")' class='basic_image_attributes' id='title_image_container'></div>");
  
      echo("<div id='text_body'>");
      echo("<h1 id='article_title'>" . $title . "</h1>");
      echo("<h5 id='article_author'>Author: Dr. Parker</h5>");
      echo($article);
    ?>

</body>
<footer>
  
</footer>
</html>
