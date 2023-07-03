<?php
//include constants.php for STIEURL
include('../config/constants.php');
//delete all the session
//1.distroy the session  
session_destroy();//unsets $_session['user']

//2.redirect to login page
header('location:'.SITEURL.'admin/login.php');




?>