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
        <p id="slogan"><span id="slogan_inner">A blog about all things I wish someone had told me.</span></p>
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
      

      # read in variables from url
      $blog_text_url = $_GET["blog_text_url"];
      $images_dir = $_GET["images_dir"];


      echo($blog_text_url . "<br>");
      echo($images_dir . "<br>");

      $myfile = fopen($blog_text_url, "r") or die("Unable to open file, $blog_content!");

      $title       = '';
      $summary     = '';
      $article     = '';
      $image_title = '';
      $image_left  = '';
      $image_right = '';
      $image_full  = '';

      while(!feof($myfile)) {
        $text_line = fgets($myfile);
        // echo($text_line);
        
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

        if(startsWith($text_line, ':summary:')){
          $summary_image = explode(":", $text_line)[2];
          echo($summary_image . "<br>");

          $summary = str_replace(':summary:', '', $text_line);
          # read in summary
          while(!feof($myfile)){
            $text_line = fgets($myfile);
            if(startsWith($text_line, ':article:')){
              break;
            }
            $summary .= $text_line; 
          }
        }

        if(startsWith($text_line, ':article:')){
          $article_image = explode(":", $text_line)[2];
          echo($article_image . "<br>");
          
          

          $article = str_replace(':article:', '', $text_line);
          # read in article
          while(!feof($myfile)){
            $text_line = fgets($myfile);
            # Check for paragraph ending in article

            # Check for images in article
            if(startsWith($text_line, ':image:')){
              $temp_image = explode(":", $text_line)[2];
              echo($article_image . "<br>");
              $text_line = '<div style="background-image:' . $images_dir . $temp_image . '" class="basic_image_attributes inpage_image_right"></div>';
              continue;
            }

            $article .= $text_line; 
          }
        }

      }
        

      $image_title = '';
      echo("<div style='background-image: \"" . $images_dir . $image_title . "\"' class='basic_image_attributes' id='title_image_container'></div>");



    ?>
  <div id="text_body">
    <h1>The best blog :p</h1>
    <h5>Author: Dr. Parker</h5>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac dolor fermentum, mollis arcu eget, congue felis. Pellentesque vestibulum iaculis elementum. Pellentesque eu erat at magna fermentum consequat vel sit amet quam. Cras imperdiet tortor rhoncus augue viverra, et laoreet leo imperdiet. Curabitur eget faucibus orci. Vestibulum pulvinar magna sed sem lacinia pretium quis sed quam. Nunc quis ultricies eros.</p>
<div class="basic_image_attributes inpage_image_left"></div>

<p>Quisque commodo efficitur ante, nec fringilla ex ornare vitae. Nulla mollis ligula sed tristique semper. Maecenas sit amet mi vehicula, ornare lectus eget, scelerisque orci. Morbi sem nibh, suscipit nec ante vitae, imperdiet viverra erat. Proin gravida eget nisi sit amet ullamcorper. Mauris turpis massa, semper auctor quam non, porta lobortis mi. Praesent commodo nulla odio, at egestas mi dignissim quis. Aenean volutpat augue in lacus porttitor bibendum. Cras dapibus luctus sem non luctus. Cras volutpat porta erat sed fringilla. Praesent tincidunt elit eu nunc faucibus, ut mattis quam commodo. Vestibulum consequat neque non faucibus aliquet. Integer at metus et elit aliquet convallis. Vivamus euismod risus massa, quis efficitur est tempor vel. Nam dolor nisl, vestibulum sed convallis quis, cursus ac metus. Donec ac aliquet turpis.</p>
<div class="basic_image_attributes inpage_image_right"></div>
<p>Nulla suscipit mauris lacinia augue sollicitudin, quis tincidunt neque facilisis. Mauris in neque sit amet nulla vulputate porttitor. Vivamus iaculis turpis odio, ac dictum augue condimentum a. Nullam mollis vel nunc vitae dapibus. Sed efficitur nisi non nunc laoreet facilisis. Suspendisse sagittis, ex eget sagittis varius, metus erat consectetur magna, ut tincidunt enim orci sit amet magna. Nullam ligula lorem, placerat vel blandit et, pellentesque vitae ligula. Aenean blandit facilisis cursus. Aenean sed porta mi. Proin vitae ante scelerisque, tincidunt eros eu, rutrum purus. Nullam sodales, dolor vitae aliquet blandit, purus tortor malesuada lacus, eu pulvinar lectus nisi eu sem.</p>

<p>Sed a posuere erat. Mauris ac libero libero. Nulla eget ante eu sem scelerisque vehicula. Pellentesque malesuada est eget metus lobortis fermentum. Pellentesque sit amet sem nec purus auctor porttitor. Praesent erat ante, hendrerit id imperdiet ut, volutpat at ante. Cras vitae ornare augue. In vel tincidunt odio. Vivamus sit amet risus lectus. Pellentesque nec nunc vel sem sollicitudin rutrum. Praesent placerat velit a leo lacinia ultrices. In neque risus, mattis et nulla id, tempor lobortis lorem. Sed sodales lectus at urna convallis vulputate. Curabitur malesuada consectetur mauris, sit amet viverra est vehicula eu.</p>
<div class="basic_image_attributes inpage_image_full"></div>

<p>Cras nec tortor nisl. Fusce a nulla sed magna pharetra tempor id quis ipsum. Sed mattis, orci sit amet luctus maximus, mi libero fringilla purus, quis hendrerit dui nisi vel dolor. Donec ac nibh in ante rutrum tristique. Cras non viverra sapien, quis hendrerit risus. Donec sit amet lectus odio. Sed tellus ante, feugiat a sapien ut, aliquam hendrerit tellus. Mauris vel libero elementum, aliquet lectus sit amet, venenatis tortor. Duis vitae scelerisque dui. Mauris feugiat nulla sed augue vulputate lacinia. In sit amet mauris vitae dolor consectetur varius. Curabitur mollis, justo eu ullamcorper hendrerit, nisl purus pulvinar odio, id posuere sapien mi nec lectus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut finibus risus at euismod dictum. Quisque venenatis, dolor ut blandit dictum, odio est vestibulum dui, vitae luctus lectus ex vel est.</p>
      
  </div>
</body>
</html>
