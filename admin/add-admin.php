<?php
include('partials/menu.php');
?>
<div class="main-content"> 
    <div class="wrapper">
        <h1>Add Admin</h1><br>

        <?php
if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
?>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name :</td>
                <td><input type="text" name="full_name" placeholder="Enter your Name"></td>
                </tr>

               <tr>
               <td>User Name :</td>
                <td><input type="text" name="username" placeholder="Enter your User Name"></td>
               </tr>
                <tr>
                <td>Password   :</td>
                <td><input type="password" name="password" placeholder="password"></td>
                </tr>

                <tr>
                    <td col="2">
<input type="submit" name="submit" value="Add Admin" class="btn-primary">
                    </td>
                </tr>
          
        </table>
        </form>
    </div>
</div>

<?php
include('partials/footer.php');
?>

<?php
//process the value from form and save it in  databasek
//check whether the button is clicked or not

if(isset($_POST['submit']))
{
    //button clicked
    // echo "button clicked";


    // get the data from form
      $full_name=$_POST['full_name'];
      $user_name=$_POST['username'];
      $password=md5($_POST['password']);  //md5 is for sequre password 
   
       //sql qry to save data into database

       $sql="insert into tbl_admin set
       full_name='$full_name',
       username='$user_name',
       password='$password'
       ";

    //    echo $sql;

 //executing and saving data into database

 $res=mysqli_query($conn,$sql) or die(mysqli_error());

 //check whether the (query is executed )  data is inserted or not and display appropriate massage

 if($res==TRUE)
 {
    // echo "data inserted";
    //create a session variable to diaplay massage
    $_SESSION['add']="<div class='success'>Admin Added Successfully</div>";
    //redirect page
    header("location:".SITEURL.'admin/manage-admin.php');
 }
 else{
    // echo "failed";

    //create a session variable to diaplay massage
    $_SESSION['add']="Failed to add admin";
    //redirect page
    header("location:".SITEURL.'admin/manage-admin.php');
 }
    
}
else{
    //button not clicked
    // echo "button not clicked";
}
?>