<?php
  session_start();

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
          $name = mysqli_real_escape_string($confirm, $_POST['Username']);
          $mobile = mysqli_real_escape_string($confirm, $_POST['mobile']);
          $email = mysqli_real_escape_string($confirm, $_POST['e-mail']);
          $age = mysqli_real_escape_string($confirm, $_POST['age']);
          $degree = mysqli_real_escape_string($confirm, $_POST['degree']);
          $refer = mysqli_real_escape_string($confirm, $_POST['refer']);
          $password = mysqli_real_escape_string($confirm, $_POST['password']);
          $confirmation = mysqli_real_escape_string($confirm, $_POST['confirm']);


           $passcheck = password_hash($password,PASSWORD_BCRYPT);
           $cpasscheck = password_hash($confirmation,PASSWORD_BCRYPT);

           $token = bin2hex(random_bytes(20));

           $emailsel = "select * from registration where email = '$email'";
           $emailquery = mysqli_query($confirm , $emailsel);
           $count = mysqli_num_rows($emailquery);

           if($count>0){
             ?>
       <script>
         alert("email already exists");
       </script>
       <?php
           }else{

            if($password === $confirmation){
              $insert = " insert into registration(name,degree,mobile_number,email,refer,age,password,confirmation,token,status) values('$name','$degree','$mobile','$email','$refer','$age','$passcheck','$cpasscheck','$token','inactive') ";

         $check =  mysqli_query($confirm , $insert);


         if($check){
       //email verification

$subject = "Email investigation";
$body = "Hi, $name click on this link for login
http://localhost/registration/activate.php?token=$token ";
$sender = "From: ashavickydeora@gmail.com";

if (mail($email, $subject, $body, $sender)) {
   $_SESSION['msg'] = "check your gmail account";
   ?>
   <script>
     location.replace("login.php");
   </script>
   <?php
} else {
    echo "Email sending failed...";
}


       }else{
       ?>
       <script>
         alert("data not inserted");
       </script>
       <?php
     }

            }else{
              ?>
       <script>
         alert("something went wrong");
       </script>
       <?php
            }

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
          <h2>Rgistration form</h2>
        </div>

        <form id="form" class="form" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" >
          <div class="control">
          <label>Username</label>
          <input type="text" name="Username" value="" id = "username" placeholder="Enter your full name" autocomplete = "off" required>
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error msg</small>
          </div>

          <div class="control">
          <label>Phone Number</label>
          <input type="number" name="mobile" value="" id = "phone" placeholder="Enter your mobile number" autocomplete = "off" required>
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error msg</small>
          </div>

          <div class="control">
          <label>E-mail</label>
          <input type="email" name="e-mail" value="" id = "email" placeholder="Enter your E-mail" autocomplete = "off" required>
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error msg</small>         
          </div>

          <div class="control">
          <label>age</label>
          <input type="number" name="age" value="" id = "age" placeholder="Enter your age" autocomplete = "off" required>
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error msg</small>          
          </div>


          <div class="control">
          <label>degree</label>
          <input type="text" name="degree" value="" id = "degree" placeholder="Enter your degree" autocomplete = "off" required>
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error msg</small>         
          </div>

          <div class="control">
          <label>refer</label>
          <input type="text" name="refer" value="" id = "refer" placeholder="Enter your referel" autocomplete = "off" required>
       
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>

          <small>Error msg</small>          
          </div>

           <div class="control">
          <label>Password</label>
          <input type="password" name="password" value="" id = "password" placeholder="Enter your password" autocomplete = "off" required>
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>
          <small>Error msg</small>          
          </div>

          <div class="control">
          <label>Confirm Password</label>
          <input type="password" name="confirm" value="" id = "confirm" placeholder="Enter your password again" autocomplete = "off" required>
       
          <i class="fas fa-check-circle"></i>
          <i class="fas fa-exclamation-circle"></i>

          <small>Password is not matching</small>          
          </div>




          <input type="submit" name="submit" value = "Sign up" class="btn" id="btn" placeholder="Sign up">

   <!--       <button class="btn"><a href="check.php"> check your team</a></button> -->

        <button class="btn">Already have an account? <a href="login.php"> Log in</a></button>
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

                    