<?php
   include("config/config.php");
   session_start();
   $error=" ";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT id FROM admin WHERE username = '$myusername' and password = '$mypassword'";
	 // echo "mi nombre de usuario:".$myusername;
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];

      $count = mysqli_num_rows($result);
     // echo $count;

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;

         header("location: cita.php");
         //header("location: index.php?myusername=".$myusername."");
      }else {
         $error = "Nombre de usuario o contrase&ntilde;a incorrectos";
      }
   }

   ?>
    <div style = "font-size:20px; color:#000000; margin:auto;text-align: center;"><?php echo $error; ?></div>
