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

          	$email = $_POST['e-mail'];
          	$password = $_POST['password'];

          	$searchemail = "select * from registration where email = '$email' and status='active' ";
          	$query = mysqli_query($confirm , $searchemail);

          	$ecount = mysqli_num_rows($query);

          	if($ecount){
          		$pass = mysqli_fetch_assoc($query);

          		$data = $pass['password'];

          		$_SESSION['name'] = $pass['name'];

          		$passcheck = password_verify($password, $data);

          		if($passcheck){
                if(isset($_POST['Remember'])){
                setcookie('mailcookie',$email,time()+86400);
                setcookie('passcookie',$password,time()+86400);
                header('location:music.php');
              }else{
                 header('location:music.php');
              }
          			?>
          			<script>
          				alert("login successfull");
          				location.replace("music.php");
          			</script>
          			<?php

          		}else{

          			?>
          			<script>
          				alert("password invalid")
          			</script>
          			<?php

          		}

          	}else{

          		?>
          		<script>
          			alert("email incorrect");
          		</script>
          		<?php

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
          <h2>Log in form</h2>
        </div>

        <form id="form" class="form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

         <div class="control">
         	<p><?php 
         	if(isset($_SESSION['msg'])){
         	echo $_SESSION['msg']; 
         }else{
         	echo $_SESSION['msg'] = "You are logged out.";
         }
         	?></p>
          <label>E-mail</label>
          <input type="email" name="e-mail"  id = "email" placeholder="Enter your E-mail" value="<?php 
          if(isset($_COOKIE['mailcookie'])){
            echo $_COOKIE['mailcookie'];
          }?>" autocomplete = "off" required>
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error msg</small>         
          </div>

           <div class="control">
          <label>Password</label>
          <input type="password" name="password"  id = "password" placeholder="Enter your password" value="<?php 
          if(isset($_COOKIE['passcookie'])){
            echo $_COOKIE['passcookie'];
          }?>"autocomplete = "off" required>
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error msg</small>          
          </div>

          <input type="checkbox" name="Remember">&nbsp;Remeber me

          <div id="reemail">
          <h5>
          <a href="resetEmail.php"> Want to reset your password , click here</a>
        </h5>
      </div>

           <input type="submit" name="submit" value = "Log in" class="btn" id="btn">

   <!--       <button class="btn"><a href="check.php"> check your team</a></button> -->

          <button class="btn">Don't have an account?<a href="signup.php">Sign up</a></button>
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
