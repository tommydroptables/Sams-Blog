<!DOCTYPE html>
<html>
  <head>
    <!-- Set up Mobile meta -->
    <meta charset="UTF-8">
    <meta name="description" content="The blog about all things I wish someone had told me. This blog contains stories that are funny, serious and dumb. I write about any moronic topic I wish someone had warned me about.">
    <meta name="keywords" content="thanks, pearl, thanks-pearl, thanks pearl, funny, blog, Dr. Pearl, i wish someone had told me">
    <meta name="author" content="Dr. Pearl">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Set up anaylitics -->
    <?php include_once("analytics/analyticstracking.php") ?>

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
        <a class="navbar-brand" id="title_t_pearl" href="/">Thanks Pearl ...</a>
    </div>
        <div id="slogan_inner"></div>
  </nav>
  <div id="menu-spacing"></div>
  <div class="container" id="main">
    <div id="row" class="row">

    <?php

      $colors_used = [];
      function get_random_int($size_of_list) {
        // ------------------------------------------------------------------
        // Return an int without of the int that is in the `colors_used array
        // ------------------------------------------------------------------

        $temp_color_options = [];
        // Create an array that contains all the possible opesion
        for ($i = 0; $i <= $size_of_list; $i++) {
          if(!in_array($i, $colors_used)){
            array_push($temp_color_options, $i);
          }
        }

        $random_pos = rand(0, count($temp_color_options));

        # New color position
        $new_color_int = $temp_color_options[$random_pos];

        array_push($colors_used, $new_color_int);
        return $new_color_int;
      }

      function get_random_color() {
        // $colors = array('#C6ACC7', '#ECB4BF', '#FBD7B7', '#FDF3B8', '#C2E3EC');
        $colors = array('rgb(239,158,164)', 'rgb(154,137,191)', 'rgb(137,210,243)', 'rgb(213,226,157)', 'rgb(249,203,141)', 'rgb(240,153,123)', 'rgb(243,236,220)', 'rgb(202,149,191)', 'rgb(147,176,220)', 'rgb(150,203,157)', 'rgb(255,245,156)', 'rgb(244,180,136)', 'rgb(235,226,226)', 'rgb(228,205,221)', 'rgb(159,148,214)', 'rgb(253,245,248)', 'rgb(182,214,208)', 'rgb(217,139,155)', 'rgb(165,140,129)', 'rgb(224,246,251)', 'rgb(210,233,238)', 'rgb(207,234,252)', 'rgb(184,212,250)', 'rgb(169,229,255)', 'rgb(225,198,254)', 'rgb(231,202,247)', 'rgb(205,201,254)', 'rgb(234,185,254)', 'rgb(250,216,250)', 'rgb(252,207,236)', 'rgb(255,193,219)', 'rgb(253,248,213)', 'rgb(252,225,202)', 'rgb(255,239,198)', 'rgb(255,235,217)', 'rgb(222,208,181)', 'rgb(252,216,209)', 'rgb(227,233,233)', 'rgb(108,197,186)', 'rgb(168,217,208)', 'rgb(146,226,254)', 'rgb(137,223,253)', 'rgb(130,202,224)');

         // 'rgb(251,247,218)'


        return $colors[get_random_int(count($colors))];
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

     function output_cards($title, $summary, $href_blog_text, $href_blog_images_folder, $summary_image_path, $summary_image_position) {
        $html_card = "";
        $full_sum_img_pth = getPhoto($href_blog_images_folder . $summary_image_path);
        $html_card .= ("<div dragable=true onclick='read_more(\"$href_blog_text\", \"$href_blog_images_folder\")' style='background-color: " . get_random_color() . "' onMouseOver  ='add_linear_gradiant(this, \"" . $full_sum_img_pth . "\")' onMouseOut='remove_linear_gradiant(this, \"" . $full_sum_img_pth . "\")' class='tile_container panel panel-default'>\n");
        $html_card .= ("<div style='background-position: 50% " . $summary_image_position . "; background-image: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)), url(\"" . $full_sum_img_pth . "\")' class='list-group panel-body tile_background_image text_padding'>\n");
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
        if($blog == '.' || $blog == '..' || $blog == '.git') {
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

        foreach($blog_contents as $blog_content){
          # since this is linux we will need to skip '.' and '..'
          if($blog_content == '.' || $blog_content == '..' || $blog_content == '.git' ) {
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
                $summary_info  = explode(":", $text_line);
                $summary_image = $summary_info[2];
                // Set the position of the photo. Read in from markdown.. if it exists
                $summary_image_position = '50%';

                if (count($summary_info) == 5)
                {
                  $summary_image_position = $summary_info[3];
                  $text_line = str_replace($summary_image_position . ':', '', $text_line);
                }

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
              array_push($blog_row1_col_2, array($title, $summary, $blog_file, ($blog_str . '/images/'), $summary_image, $summary_image_position));
            if($blog_counter_2_rows == 1)
              array_push($blog_row2_col_2, array($title, $summary, $blog_file, ($blog_str . '/images/'), $summary_image, $summary_image_position));

            if($blog_counter_3_rows == 0)
              array_push($blog_row1, array($title, $summary, $blog_file, ($blog_str . '/images/'), $summary_image, $summary_image_position));
            if($blog_counter_3_rows == 1)
              array_push($blog_row2, array($title, $summary, $blog_file, ($blog_str . '/images/'), $summary_image, $summary_image_position));
            if($blog_counter_3_rows == 2)
              array_push($blog_row3, array($title, $summary, $blog_file, ($blog_str . '/images/'), $summary_image, $summary_image_position));
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
        $two_column_cards .= output_cards($each_blog_info[0], $each_blog_info[1], $each_blog_info[2], $each_blog_info[3], $each_blog_info[4], $each_blog_info[5]);
      }
      $two_column_cards .= ("</div><div class='col-md-6 col-sm-6'>");
      foreach($blog_row2_col_2 as &$each_blog_info){
        $two_column_cards .= output_cards($each_blog_info[0], $each_blog_info[1], $each_blog_info[2], $each_blog_info[3], $each_blog_info[4], $each_blog_info[5]);
      }
      $two_column_cards .= ('</div>');


      // create cards in 3 columns for smaller screens
      $three_column_cards = "";
      $three_column_cards .= ("<div class='col-md-4 col-sm-6'>");
      foreach($blog_row1 as &$each_blog_info){
        $three_column_cards .= output_cards($each_blog_info[0], $each_blog_info[1], $each_blog_info[2], $each_blog_info[3], $each_blog_info[4], $each_blog_info[5]);
      }
      $three_column_cards .= ("</div><div class='col-md-4 col-sm-6'>");
      foreach($blog_row2 as &$each_blog_info){
        $three_column_cards .= output_cards($each_blog_info[0], $each_blog_info[1], $each_blog_info[2], $each_blog_info[3], $each_blog_info[4], $each_blog_info[5]);
      }
      $three_column_cards .= ("</div><div class='col-md-4 col-sm-6'>");
      foreach($blog_row3 as &$each_blog_info){
        $three_column_cards .= output_cards($each_blog_info[0], $each_blog_info[1], $each_blog_info[2], $each_blog_info[3], $each_blog_info[4], $each_blog_info[5]);
      }
      $three_column_cards .= ('</div>');

      echo ('<div style="display:none" id="two_column_cards">' . $two_column_cards . '</div>');
      echo ('<div style="display:none" id="three_column_cards">' . $three_column_cards . '</div>');
    ?>

      </div> <!-- End Row Block  -->
    </div> <!-- End main Block  -->
    <footer>
    </footer>
  </body>

</html>
