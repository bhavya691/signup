<?php
session_start();
include 'connect.php';
if(isset($_GET['token'])){
	$token = $_GET['token'];
	$update = "update registration set status='active' where token='$token' ";
	$fire = mysqli_query($confirm , $update);


	if($fire){
	if(isset($_SESSION['msg'])){
		$_SESSION['msg'] = "Account checking successfully";
		header('location:login.php');
	}else{
		$_SESSION['msg'] = "You are looged out";
		header('location:login.php');
	}
  }else{
  	$_SESSION['msg'] = "Account not updated";
		header('location:signup.php');
  }
}
?>