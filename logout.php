<?php
   session_start();
   $_SESSION['valid'] = false;
   $_SESSION['timeout'] = 0;
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   unset($_SESSION['blog']);

   echo 'You have cleaned session';
   header('Location: test-login.php');

?>