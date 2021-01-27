<?php
session_start();
session_destroy();



setcookie('mailcookie','',time()-86400);
setcookie('passcookie','',time()-86400);

header("location: login.php");



?>