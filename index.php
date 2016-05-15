<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link href='https://fonts.googleapis.com/css?family=Rochester' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" type="text/css" href="css/tile.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="JavaScript/script.js"></script>

  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="navbar-header navbar-center">
        <a class="navbar-brand" id="title_t_pearl" href="index.php">Thanks Pearl ...</a>
    </div>  
        <p id="slogan"><span id="slogan_inner">A blog about all things I wish someone had told me.</span></p>
  </nav>
</head>

<body>
<div id="menu-spacing"></div>
<div class="container" id="main">
  <div class="row">

    <?php

      function listdir_by_date($path){
        $dir = opendir($path);
        $list = array();
        while($file = readdir($dir)){
          if ($file != '.' and $file != '..'){

            // add the filename, to be sure not to
            // overwrite a array key
            $ctime = filectime($data_path . $file) . ',' . $file;
            $list[$ctime] = $file;
          }
        }
        closedir($dir);
        krsort($list);
        return $list;
      }
      function output_cards($title, $summary, $href_blog_text, $href_blog_images_folder) {
        echo("<div onclick='read_more(\"$href_blog_text\", \"$href_blog_images_folder\")' class='tile_container panel panel-default'>\n");
        echo("<div class='list-group panel-body tile_background_image text_padding'>\n");
        echo("<p>$summary</p>\n");
        echo("</div>\n");
        echo("<div class='panel-heading-container'>\n");
        echo("<div class='panel-heading-container-absolute'>\n");
        echo("<div class='panel-heading'><h4 class='panel-heading-header'><span class='panel_heading_span'>$title</span></h4></div>\n");
        echo("<div class='article_descrption_container list-group panel-body'>\n");
        echo("<p class='article_descrption text_padding'>$summary</p>\n");
        echo("</div>\n");
        echo("</div>\n");
        echo("</div>\n");
        echo("</div>\n");
      }

      function startsWith($haystack, $needle) {
          // search backwards starting from haystack length characters from the end
          return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
      }
      function endsWith($haystack, $needle) {
          // search forward starting from end minus needle length characters
          return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
      }
      $dir   = 'blogs';
      $blogs = scandir($dir);
      $blog_row1 = array();
      $blog_row2 = array();
      $blog_row3 = array();

      $blog_counter = 0;
      foreach($blogs as &$blog){
        # since this is linux we will need to skip '.' and '..'
        if($blog == '.' || $blog == '..') {
          continue;
        }
        if($blog_counter == 3) {
          $blog_counter = 0;
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

            $title   = '';
            $summary = '';
            $article = '';

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
              if(startsWith($text_line, ':summary:')){
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
                $article = str_replace(':article:', '', $text_line);
                # read in article
                while(!feof($myfile)){
                  $text_line = fgets($myfile);
                  $article .= $text_line; 
                }
              }
            }
            if($blog_counter == 0)
              array_push($blog_row1, array($title, $summary, $blog_file, ($blog_str . 'images/')));
            if($blog_counter == 1)
              array_push($blog_row2, array($title, $summary, $blog_file, ($blog_str . 'images/')));
            if($blog_counter == 2)
              array_push($blog_row3, array($title, $summary, $blog_file, ($blog_str . 'images/')));
            fclose($myfile);
          }
        }
        $blog_counter++;
      } # end reading in all blogs from dir

      echo('<div class="col-md-4 col-sm-6">');
      foreach($blog_row1 as &$each_blog_info){
        output_cards($each_blog_info[0], $each_blog_info[1], $each_blog_info[2], $each_blog_info[3]);
      }
      echo('</div><div class="col-md-4 col-sm-6">');
      foreach($blog_row2 as &$each_blog_info){
        output_cards($each_blog_info[0], $each_blog_info[1], $each_blog_info[2], $each_blog_info[3]);
      }
      echo('</div><div class="col-md-4 col-sm-6">');
      foreach($blog_row3 as &$each_blog_info){
        output_cards($each_blog_info[0], $each_blog_info[1], $each_blog_info[2], $each_blog_info[3]);
      }
      echo('</div>');

    ?>
    </div>
    </div>
  </div>

</body>
</html>
