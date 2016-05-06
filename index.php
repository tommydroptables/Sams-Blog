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
        <a class="navbar-brand" id="title_t_pearl" href="index.html">Thanks Pearl ...</a>
    </div>  
        <p id="slogan"><span id="slogan_inner">A blog about all things I wish someone had told me.</span></p>
  </nav>
</head>

<body>
<div id="menu-spacing"></div>
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">

    <?php
      function output_cards($title, $summary, $href) {
        echo("<div class='tile_container panel panel-default'>");
        echo("<div class='list-group panel-body tile_background_image text_padding'>");
        echo("<p>$summary</p>");
        echo("</div>");
        echo("<div class='panel-heading-container'>");
        echo("<div class='panel-heading-container-absolute'>");
        echo("<div class='panel-heading'><h4 class='panel-heading-header'><span>$title</span></h4></div>");
        echo("<div class='article_descrption_container list-group panel-body'>");
        echo("<p class='article_descrption text_padding'>$summary</p>");
        echo("</div>");
        echo("</div>");
        echo("</div>");
        echo("</div>");
      }

      function startsWith($haystack, $needle) {
          // search backwards starting from haystack length characters from the end
          return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
      }
      function endsWith($haystack, $needle) {
          // search forward starting from end minus needle length characters
          return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
      }
      $dir    = 'blogs';
      $blogs = scandir($dir);
      foreach($blogs as &$blog){
        # since this is linux we will need to skip '.' and '..'
        if($blog == '.' || $blog == '..') {
          continue;
        }

        if($blog == '.' || $blog == '..') {
          continue;
        }
        $blog_contents = scandir("$dir/$blog");
        $blog_info = array();

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
            $blog_info .= array($title, $summary, $blog_file);
            fclose($myfile);
          } 
        } # end reading in all blogs from dir

        

      }

    ?>

      <div class="tile_container panel panel-default">
        <div class="list-group panel-body tile_background_image text_padding">
          <p>Dessert cake cheesecake lollipop. Chupa chups wafer croissant chupa chups jujubes tootsie roll. Sweet gingerbread gummies danish carrot cake cotton candy wafer.</p>
        </div>
        <div class="panel-heading-container">
          <div class="panel-heading-container-absolute">
            <div class="panel-heading"><h4 class="panel-heading-header"><span>Article 1</span></h4></div>
            <div class="article_descrption_container list-group panel-body">
              <p class="article_descrption text_padding">Dessert cake cheesecake lollipop. Chupa chups wafer croissant chupa chups jujubes tootsie roll. Sweet gingerbread gummies danish carrot cake cotton candy wafer.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="tile_container panel panel-default">
        <div class="list-group panel-body tile_background_image text_padding">
          <p>Tiramisu gummies toffee sesame snaps jelly-o bonbon pie. Brownie fruitcake jelly-o jelly-o sweet carrot cake croissant pastry. Dessert cotton candy cookie biscuit topping.</p>
        </div>
        <div class="panel-heading-container">
          <div class="panel-heading-container-absolute">
            <div class="panel-heading"><h4 class="panel-heading-header"><span>Article 1</span></h4></div>
            <div class="article_descrption_container list-group panel-body">
              <p class="article_descrption text_padding">Tiramisu gummies toffee sesame snaps jelly-o bonbon pie. Brownie fruitcake jelly-o jelly-o sweet carrot cake croissant pastry. Dessert cotton candy cookie biscuit topping.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="tile_container panel panel-default">
        <div class="list-group panel-body tile_background_image text_padding">
          <p>Topping dragée soufflé sesame snaps sweet lemon drops. Powder cupcake danish biscuit. Jelly beans marzipan apple pie brownie.</p>
        </div>
        <div class="panel-heading-container">
          <div class="panel-heading-container-absolute">
            <div class="panel-heading"><h4 class="panel-heading-header"><span>Article 1</span></h4></div>
            <div class="article_descrption_container list-group panel-body">
              <p class="article_descrption text_padding">Topping dragée soufflé sesame snaps sweet lemon drops. Powder cupcake danish biscuit. Jelly beans marzipan apple pie brownie.</p>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-md-4 col-sm-6">
      <div class="tile_container panel panel-default">
        <div class="list-group panel-body tile_background_image text_padding">
          <p>Donut caramels marshmallow. Toffee sweet dessert dragée apple pie lemon drops lollipop. Donut biscuit cotton candy.</p>
        </div>
        <div class="panel-heading-container">
          <div class="panel-heading-container-absolute">
            <div class="panel-heading"><h4 class="panel-heading-header"><span>Article 1</span></h4></div>
            <div class="article_descrption_container list-group panel-body">
              <p class="article_descrption text_padding">Donut caramels marshmallow. Toffee sweet dessert dragée apple pie lemon drops lollipop. Donut biscuit cotton candy.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="tile_container panel panel-default">
        <div class="list-group panel-body tile_background_image text_padding">
          <p>Brownie wafer toffee toffee pastry jelly cake. Apple pie cupcake carrot cake chupa chups caramels fruitcake jelly. Wafer biscuit jujubes lollipop sesame snaps marzipan pastry dragée. Bear claw caramels lollipop brownie brownie bear claw toffee.</p>
        </div>
        <div class="panel-heading-container">
          <div class="panel-heading-container-absolute">
            <div class="panel-heading"><h4 class="panel-heading-header"><span>Article 1</span></h4></div>
            <div class="article_descrption_container list-group panel-body">
              <p class="article_descrption text_padding">Brownie wafer toffee toffee pastry jelly cake. Apple pie cupcake carrot cake chupa chups caramels fruitcake jelly. Wafer biscuit jujubes lollipop sesame snaps marzipan pastry dragée. Bear claw caramels lollipop brownie brownie bear claw toffee.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="tile_container panel panel-default">
        <div class="list-group panel-body tile_background_image text_padding">
          <p>Jelly beans gingerbread soufflé chocolate bar jujubes. Cotton candy candy pie jujubes danish cake croissant. Jelly topping toffee cake chocolate bar lollipop.</p>
        </div>
        <div class="panel-heading-container">
          <div class="panel-heading-container-absolute">
            <div class="panel-heading"><h4 class="panel-heading-header"><span>Article 1</span></h4></div>
            <div class="article_descrption_container list-group panel-body">
              <p class="article_descrption text_padding">Jelly beans gingerbread soufflé chocolate bar jujubes. Cotton candy candy pie jujubes danish cake croissant. Jelly topping toffee cake chocolate bar lollipop.</p>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-md-4 col-sm-6">
      <div class="tile_container panel panel-default">
        <div class="list-group panel-body tile_background_image text_padding">
          <p>Wafer biscuit sweet liquorice cake marshmallow. Marshmallow croissant marzipan. Gingerbread topping dragée carrot cake danish sugar plum gummies candy sweet roll. Donut pudding halvah bonbon bear claw candy canes.</p>
        </div>
        <div class="panel-heading-container">
          <div class="panel-heading-container-absolute">
            <div class="panel-heading"><h4 class="panel-heading-header"><span>Article 1</span></h4></div>
            <div class="article_descrption_container list-group panel-body">
              <p class="article_descrption text_padding">Wafer biscuit sweet liquorice cake marshmallow. Marshmallow croissant marzipan. Gingerbread topping dragée carrot cake danish sugar plum gummies candy sweet roll. Donut pudding halvah bonbon bear claw candy canes.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="tile_container panel panel-default">
        <div class="list-group panel-body tile_background_image text_padding">
          <p>Cheesecake oat cake gummi bears. Soufflé ice cream liquorice fruitcake jelly-o gummies candy. Apple pie soufflé sweet.</p>
        </div>
        <div class="panel-heading-container">
          <div class="panel-heading-container-absolute">
            <div class="panel-heading"><h4 class="panel-heading-header"><span>Article 1</span></h4></div>
            <div class="article_descrption_container list-group panel-body">
              <p class="article_descrption text_padding">Cheesecake oat cake gummi bears. Soufflé ice cream liquorice fruitcake jelly-o gummies candy. Apple pie soufflé sweet.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="tile_container panel panel-default">
        <div class="list-group panel-body tile_background_image text_padding">
          <p>Toffee lemon drops bear claw danish pie cake cupcake wafer pastry. Bonbon candy marshmallow lollipop muffin pastry. Sweet roll chocolate cake muffin. Dragée bonbon carrot cake powder.</p>
        </div>
        <div class="panel-heading-container">
          <div class="panel-heading-container-absolute">
            <div class="panel-heading"><h4 class="panel-heading-header"><span>Article 1</span></h4></div>
            <div class="article_descrption_container list-group panel-body">
              <p class="article_descrption text_padding">Toffee lemon drops bear claw danish pie cake cupcake wafer pastry. Bonbon candy marshmallow lollipop muffin pastry. Sweet roll chocolate cake muffin. Dragée bonbon carrot cake powder.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>

</body>
</html>
