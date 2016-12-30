<?php
   ob_start();
   session_start();
?>

<?
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>

<html lang = "en">

   <head>
      <title>Thanks Pearl</title>
      <meta charset="UTF-8">
      <meta name="robots" content="NOODP">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Set up anaylitics -->
      <?php include_once("analytics/analyticstracking.php") ?>

      <link href = "css/bootstrap.min.css" rel = "stylesheet">
      <link rel="stylesheet" type="text/css" href="css/styles.css">
      <link rel="stylesheet" type="text/css" href="css/header.css">
      <link rel='stylesheet' type='text/css' href="fonts/rochester">
      <script type="text/javascript" src="JavaScript/jquery.min.js"></script>
      <script type="text/javascript" src="JavaScript/bootstrap.min.js"></script>
      <script type="text/javascript" src="JavaScript/header.js"></script>

      <style>
         body {
            position: relative;
            height: 100%;
            width: 300px;
            padding-top: 40px;
            padding-bottom: 40px;
            background-image: url(images/pearl.jpg);
                background-repeat: no-repeat;
             background-origin: 50% 50%;
             background-size: cover;
             display: inline-block;
             font-color: #181818;
         }

         .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            color: rgb(59, 61, 60);
         }

         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
            color: rgb(255,206,211);
         }

         .form-signin .checkbox {
            font-weight: normal;
         }

         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
         }

         .form-signin .form-control:focus {
            z-index: 2;
         }

         .form-signin input[type="text"] {
            margin-bottom: -15px;
            border-width: 2px;
            border-color: rgb(255,206,211);
            background-color: transparent;
            color: #f5f5f5;
         }

         .form-signin input[type="password"] {
            margin-bottom: 20px;
            border-width: 2px;
            border-color: rgb(255,206,211);
            background-color: transparent;
            color: #f5f5f5;
         }

         .btn-primary {
            background-color: transparent;
            color: #f5f5f5;
            border-color: rgb(255,206,211);
         }

         .btn-primary:hover, .btn-primary:active {
            background-color: rgb(255,206,211);
            border-color: rgb(255,206,211);
            color: rgb(59, 61, 60);
         }

         .container {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
         }
      </style>

   </head>

   <body>
      <nav class="navbar navbar-default navbar-fixed-top">
         <div class="navbar-header navbar-center">
            <a class="navbar-brand" id="title_t_pearl" href="/">Thanks Pearl ...</a>
         </div>
         <div id="slogan_inner"></div>
      </nav>

      <div class = "container form-signin">

         <?php
            $redirect_to = '';
            if (isset($_GET['previous'])) {
                $redirect_to = $_GET['previous'];
            }else{
               $redirect_to = 'admin.php';
            }
            $msg = '';
            if (isset($_POST['login']) && !empty($_POST['username'])
               && !empty($_POST['password'])) {

               if ($_POST['username'] == 'test' && $_POST['password'] == '1234') {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time() + 3600;
                  $_SESSION['username'] = 'tutorialspoint';
                  header("Location: $redirect_to");
                  echo("<script> location.replace('$redirect_to'); </script>");

               } else {
                  $msg = 'Wrong username or password';
               }
            }
         ?>
      </div> <!-- /container -->


      <div class = "container">

         <form class = "form-signin" role = "form"
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control"
               name = "username" placeholder = "username"
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit"
               name = "login">Login</button>
            Click here to <a href = "logout.php" tite = "Logout">Logout.
         </form>



      </div>

   </body>
</html>
