<?php
	session_start();
    # verified user is logged in
    if ($_SESSION['valid'] == false || $_SESSION['timeout'] < time()) {
        // header('Location: test-login.php?previous=admin.php');
        echo("<script> location.replace('http://www.cocozzello.com/Sams-Blog/test-login.php?previous=http://www.cocozzello.com/Sams-Blog/admin.php'); </script>");
        die;
    }

   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

      $expensions= array("jpeg","jpg","png");

      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }

      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }

      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/" . $file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
?>
<html>
   <body>

      <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="image" />
         <input type="submit"/>
      </form>

   </body>
</html>