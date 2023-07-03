<?php

//iclude constants.php
include('../config/constants.php');
//1.get the id of admin to delete

echo $id=$_GET['id']; 

//2.create sql query to delete admin
$sql="delete from tbl_category where id=$id";

//execute the query
$res=mysqli_query($conn,$sql);

//check whether the qury is executed successfully or not
if($res==true)
{
    //qury executed successfully and admin deleted
    // echo "admin deleted";
    //create session variable and display Massage
    $_SESSION['delete']="<div class='success'>Category deleted successfully.</div>";

    //redirect massage to admin page
    header('location:'.SITEURL.'admin/manage-category.php');
}
else
{
// echo "failed to dlete admin";
  //create session variable and display Massage
  $_SESSION['delete']='<div class="error">Failed to delete Category try again latter</div>';

  //redirect massage to admin page
  header('location:'.SITEURL.'admin/manage-category.php');
}
//3.redirect to manage admin page
?>