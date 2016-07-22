<!DOCTYPE html>
<html>
  <head>
    <!-- Set up Mobile meta -->
    <meta charset="UTF-8">
    <meta name="description" content="Sync your files bitch">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="Unkown">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/tile.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel='stylesheet' type='text/css' href="fonts/rochester">
    <script type="text/javascript" src="JavaScript/jquery.min.js"></script>
    <script type="text/javascript" src="JavaScript/bootstrap.min.js"></script>
    <script type="text/javascript" src="JavaScript/header.js"></script>
    <script type="text/javascript" src="JavaScript/index.js"></script>

    <title>Thanks Pearl...</title>
  </head>

<body>
  <nav class="navbar navbar-default navbar-fixed-top">
      <a href="admin.php"><div id="admin_button"></div></a>
      <div class="navbar-header navbar-center">
        <a class="navbar-brand" id="title_t_pearl" href="index.php">Thanks Pearl ...</a>
    </div>
        <div id="slogan_inner"></div>
  </nav>
  <div id="menu-spacing"></div>
  <div class="container" id="main">
    <div id="row" class="row">

    <?php

      $colors_used = array();
      function get_random_int($number_recusions, $size_of_list) {
        // Return an int without duplications. The returned number
        // starts at 0 and goes to the size of $size_of_list

        $random_int = rand(0, $size_of_list);
        if(in_array($random_int, $colors_used) && $number_recusions <= 3)
          $random_int = get_random_int($number_recusions++, $size_of_list);

        array_push($colors_used, $random_int);
        return $random_int;
      }

      function get_random_color() {
        // $colors = array('#C6ACC7', '#ECB4BF', '#FBD7B7', '#FDF3B8', '#C2E3EC');
        $colors = array('rgb(239,158,164)', 'rgb(154,137,191)', 'rgb(137,210,243)', 'rgb(213,226,157)', 'rgb(249,203,141)', 'rgb(240,153,123)', 'rgb(243,236,220)', 'rgb(202,149,191)', 'rgb(147,176,220)', 'rgb(150,203,157)', 'rgb(255,245,156)', 'rgb(244,180,136)', 'rgb(235,226,226)', 'rgb(228,205,221)', 'rgb(159,148,214)', 'rgb(253,245,248)', 'rgb(182,214,208)', 'rgb(217,139,155)', 'rgb(165,140,129)', 'rgb(224,246,251)', 'rgb(210,233,238)', 'rgb(207,234,252)', 'rgb(184,212,250)', 'rgb(169,229,255)', 'rgb(225,198,254)', 'rgb(231,202,247)', 'rgb(205,201,254)', 'rgb(234,185,254)', 'rgb(250,216,250)', 'rgb(252,207,236)', 'rgb(255,193,219)', 'rgb(253,248,213)', 'rgb(252,225,202)', 'rgb(255,239,198)', 'rgb(255,235,217)', 'rgb(222,208,181)', 'rgb(252,216,209)', 'rgb(227,233,233)', 'rgb(108,197,186)', 'rgb(168,217,208)', 'rgb(146,226,254)', 'rgb(137,223,253)', 'rgb(130,202,224)');

         // 'rgb(251,247,218)'


        return $colors[get_random_int(0, count($colors))];
      }

      function getPhoto($photo_url) {
        // Verify Photo exists before displaying it
        if (file_exists($photo_url))
          return $photo_url;
        else
          return "images/default.jpg";
      }
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

     function output_cards($title, $summary, $href_blog_text, $href_blog_images_folder, $summary_image_path) {
        $html_card = "";
        $full_sum_img_pth = getPhoto($href_blog_images_folder . $summary_image_path);
        $html_card .= ("<div dragable=true onclick='read_more(\"$href_blog_text\", \"$href_blog_images_folder\")' style='background-color: " . get_random_color() . "' onMouseOver  ='add_linear_gradiant(this, \"" . $full_sum_img_pth . "\")' onMouseOut='remove_linear_gradiant(this, \"" . $full_sum_img_pth . "\")' class='tile_container panel panel-default'>\n");
        $html_card .= ("<div style='background-image: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)), url(\"" . $full_sum_img_pth . "\")' class='list-group panel-body tile_background_image text_padding'>\n");
        $html_card .= ("<p>$summary</p>\n");
        $html_card .= ("</div>\n");
        $html_card .= ("<div class='panel-heading-container'>\n");
        $html_card .= ("<div class='panel-heading-container-absolute'>\n");
        $html_card .= ("<div class='panel-heading'><h4 class='panel-heading-header'><span class='panel_heading_span'>$title</span></h4></div>\n");
        $html_card .= ("<div class='article_descrption_container list-group panel-body'>\n");
        $html_card .= ("<p class='article_descrption text_padding'>$summary</p>\n");
        $html_card .= ("</div>\n");
        $html_card .= ("</div>\n");
        $html_card .= ("</div>\n");
        $html_card .= ("</div>\n");

        return $html_card;
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
      $blog_row1_col_2 = array();
      $blog_row2_col_2 = array();


      $blog_row1 = array();
      $blog_row2 = array();
      $blog_row3 = array();

      $blog_counter_3_rows = 0;
      $blog_counter_2_rows = 0;
      foreach($blogs as &$blog){
        # since this is linux we will need to skip '.' and '..'
        if($blog == '.' || $blog == '..') {
          continue;
        }
        if($blog_counter_3_rows == 3) {
          $blog_counter_3_rows = 0;
        }
        if($blog_counter_2_rows == 2) {
          $blog_counter_2_rows = 0;
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

            $title       = '';
            $summary     = '';

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
                $summary_image = explode(":", $text_line)[2];

                $summary = str_replace(':summary:', '', $text_line);
                $summary = str_replace($summary_image . ':', '', $summary);
                # read in summary
                while(!feof($myfile)){
                  $text_line = fgets($myfile);
                  if(startsWith($text_line, ':article:')){
                    break;
                  }
                  $summary .= $text_line;
                }
              }
            }


            if($blog_counter_2_rows == 0)
              array_push($blog_row1_col_2, array($title, $summary, $blog_file, ($blog_str . '/images/'), $summary_image));
            if($blog_counter_2_rows == 1)
              array_push($blog_row2_col_2, array($title, $summary, $blog_file, ($blog_str . '/images/'), $summary_image));


            if($blog_counter_3_rows == 0)
              array_push($blog_row1, array($title, $summary, $blog_file, ($blog_str . '/images/'), $summary_image));
            if($blog_counter_3_rows == 1)
              array_push($blog_row2, array($title, $summary, $blog_file, ($blog_str . '/images/'), $summary_image));
            if($blog_counter_3_rows == 2)
              array_push($blog_row3, array($title, $summary, $blog_file, ($blog_str . '/images/'), $summary_image));
            fclose($myfile);
          }
        }
        $blog_counter_3_rows++;
        $blog_counter_2_rows++;
      } # end reading in all blogs from dir

      // create cards in 2 columns for smaller screens
      $two_column_cards = "";
      $two_column_cards .= ("<div class='col-md-6 col-sm-6'>");
      foreach($blog_row1_col_2 as &$each_blog_info){
        $two_column_cards .= output_cards($each_blog_info[0], $each_blog_info[1], $each_blog_info[2], $each_blog_info[3], $each_blog_info[4]);
      }
      $two_column_cards .= ("</div><div class='col-md-6 col-sm-6'>");
      foreach($blog_row2_col_2 as &$each_blog_info){
        $two_column_cards .= output_cards($each_blog_info[0], $each_blog_info[1], $each_blog_info[2], $each_blog_info[3], $each_blog_info[4]);
      }
      $two_column_cards .= ('</div>');


      // create cards in 3 columns for smaller screens
      $three_column_cards = "";
      $three_column_cards .= ("<div class='col-md-4 col-sm-6'>");
      foreach($blog_row1 as &$each_blog_info){
        $three_column_cards .= output_cards($each_blog_info[0], $each_blog_info[1], $each_blog_info[2], $each_blog_info[3], $each_blog_info[4]);
      }
      $three_column_cards .= ("</div><div class='col-md-4 col-sm-6'>");
      foreach($blog_row2 as &$each_blog_info){
        $three_column_cards .= output_cards($each_blog_info[0], $each_blog_info[1], $each_blog_info[2], $each_blog_info[3], $each_blog_info[4]);
      }
      $three_column_cards .= ("</div><div class='col-md-4 col-sm-6'>");
      foreach($blog_row3 as &$each_blog_info){
        $three_column_cards .= output_cards($each_blog_info[0], $each_blog_info[1], $each_blog_info[2], $each_blog_info[3], $each_blog_info[4]);
      }
      $three_column_cards .= ('</div>');

      echo ('<div style="display:none" id="two_column_cards">' . $two_column_cards . '</div>');
      echo ('<div style="display:none" id="three_column_cards">' . $three_column_cards . '</div>');
    ?>

      </div> <!-- End Row Block  -->
    </div> <!-- End main Block  -->
    <footer>
      <p  id="creator">
      <a href="http://www.cocozzello.com">© 2016 by Tom Cocozzello</a>
    </p>
    </footer>
  </body>

</html>
