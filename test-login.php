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
      <link href = "css/bootstrap.min.css" rel = "stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Rochester' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" type="text/css" href="css/styles.css">
      <link rel="stylesheet" type="text/css" href="css/header.css">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="JavaScript/header.js"></script>
      
      <style>
         body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #ADABAB;
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
            margin-bottom: -1px;
            border-width: .5px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color: rgb(255,88,105);
         }
         
         .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-width: .5px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-color: rgb(255,88,105);
         }
         
         .btn-primary {
            background-color: rgb(255,206,211);
            color: rgb(59, 61, 60);
         }
         .btn-primary:hover {
            background-color: rgb(255,88,105);
            border-color: rgb(255,88,105);
            color: rgb(59, 61, 60);
         }
      </style>
      
   </head>
	
   <body>
      <nav class="navbar navbar-default navbar-fixed-top">
         <div class="navbar-header navbar-center">
            <a class="navbar-brand" id="title_t_pearl" href="index.php">Thanks Pearl ...</a>
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
				
               if ($_POST['username'] == 'test' && 
                  $_POST['password'] == '1234') {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time() + 3600;
                  $_SESSION['username'] = 'tutorialspoint';
                  echo 'You have entered valid username and password';
                  header("Refresh: 0; URL = $redirect_to");
               } else {
                  $msg = 'Wrong username or password';
               }
            }
         ?>
      </div> <!-- /container -->
      
  <div id="menu-spacing"></div>

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