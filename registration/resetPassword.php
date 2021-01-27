<?php
	session_start();
  ob_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
      <?php include 'register.php' ?>  
      <?php include 'connection.css' ?>


    </head>

   <body class = "body" onload="load()" >
<?php 
          include 'connect.php';

          if(isset($_POST['submit'])){

            if(isset($_GET['token'])){

              $token = $_GET['token'];

          $password = mysqli_real_escape_string($confirm, $_POST['password']);
          $confirmation = mysqli_real_escape_string($confirm, $_POST['confirm']);

           $passcheck = password_hash($password,PASSWORD_BCRYPT);
           $cpasscheck = password_hash($confirmation,PASSWORD_BCRYPT);

            if($password === $confirmation){

              $update = "update registration set password='$passcheck' where token='$token' ";
              
              $check =  mysqli_query($confirm , $update);

         if($check){
          $_SESSION['msg'] = "Your password has been updated";
          header('location:login.php');

         }else{
          $_SESSION['passmsg'] = "Your password is not updated";
          header('location:resetPassword.php');
         }

       }else{
         $_SESSION['passmsg'] = "Your password is not matching";

       }

          }else{
            ?>
            <script>
              alert('No token found');
            </script>
            <?php
          }

        }

 ?>

 <div id="background">
        <div class="out">
        <div class="full">
        <div class = "back">

        <div class = "header">
          <h2>Password reset form</h2>
        </div>

        <form id="form" class="form" action="" method="POST">

          <p>
            <?php
            if(isset($_SESSION['passmsg'])){
              echo $_SESSION['passmsg'];
            }else{
              echo $_SESSION['passmsg'] = '';
            }
            ?>
          </p>

         <div class="control">
          <label>Password</label>
          <input type="password" name="password" value="" id = "password" placeholder="Enter your new password" autocomplete = "off" required>
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error msg</small>          
          </div>

          <div class="control">
          <label>Confirm Password</label>
          <input type="password" name="confirm" value="" id = "confirm" placeholder="Enter your new password again" autocomplete = "off" required>
       
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>

          <small>Password is not matching</small>          
          </div>

          <input type="submit" name="submit" value = "reset passoword" class="btn" id="btn">

        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>