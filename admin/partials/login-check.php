
<?php  
//Autoriation - access control
//check whether the user is loged in or not

if(!isset($_SESSION['user']))//if user session is not set
{
  //this means user is not logged in
  //redirect to login page with massage
  $_SESSION['no-login-massage']="<div class='error text-center'>Please Login To Acess Admin Panel.</div>";
  header('location:'.SITEURL.'admin/login.php');
}

?>