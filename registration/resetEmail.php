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

       
          	 $email = mysqli_real_escape_string($confirm, $_POST['e-mail']);

          	  $emailsel = "select * from registration where email = '$email'";
           $emailquery = mysqli_query($confirm , $emailsel);
           $count = mysqli_num_rows($emailquery);

           if($count){

           	$user = mysqli_fetch_array($emailquery);

           	$name = $user['name'];
           	$token = $user['token'];

           	$subject = "Password Activation";
$body = "Hi, $name click on this link to reset your password
http://localhost/registration/resetPassword.php?token=$token ";
$sender = "From: ashavickydeora@gmail.com";

if (mail($email, $subject, $body, $sender)) {
   $_SESSION['msg'] = "check your gmail account to reset your password";
   ?>
   <script>
     location.replace("login.php");
   </script>
   <?php
} else {
    echo "Email sending failed...";
}


           }else{

           }
       }


          	?>

   	<div id="loadSpace">
           <div id="loader">
               <div id="center"></div>
           </div>
       </div>




        <div id="background">
        <div class="out">
        <div class="full">
        <div class = "back">

        <div class = "header">
          <h2>Email verification</h2>
        </div>

        <form id="form" class="form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

         <div class="control">
         	<label>E-mail</label>
          <input type="email" name="e-mail"  id = "email" placeholder="Enter your E-mail" autocomplete="off">
      </div>

      <input type="submit" name="submit" value = "send mail" class="btn" id="btn">
</form>

</div>

</div>

</div>



</div>


 <script>
              function load(){
    var loading = document.getElementById('loader');
    loading.style.display = 'none';
    loadSpace.style.display = 'none';
}
        </script>
   </body>
   </html>

