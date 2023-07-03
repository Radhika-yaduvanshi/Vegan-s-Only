
<?php include('../config/constants.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login -Food order System</title>
    <link rel="stylesheet" href="../css/admin.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1><br><br>
        
        <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-massage']))
            {
                echo $_SESSION['no-login-massage'];
                unset($_SESSION['no-login-massage']);
            }
        ?>
        <br>
        <!-- login form starts here -->

        <form action="" method="POST" class="text-center">
         Username:         <br>
         <input type="text" name="username" placeholder="Enter Username">         <br><br>
         Password:           <br>
         <input type="password" name="password" placeholder="Enter Password">         <br><br>
         <input type="submit" name="submit" value="Login" class="btn-primary">         <br>
<br><br>

        <!-- login form ends here -->
        </form>

        <p class="text-center">Created By - <a href="www.radhikayadav.com">Radhika Yadav</a></p>
    </div>
</body>
</html>

<?php
if(isset($_POST['submit']))
{

    // 1.get the data from form
     //   $search=mysqli_real_escape_string($conn,$_POST['search']);
    //   $username=$_POST['username'];
      $username=mysqli_real_escape_string($conn,$_POST['username']); 
      $raw_password=md5($_POST['password']); 
      $password=mysqli_real_escape_string($conn,$raw_password);  
  
    //  

    //   2. sql to check whether the user with username and password exists or not
    $sql="select  * from tbl_admin where username='$username' and password='$password'";

    //3.execute the query 
    $res=mysqli_query($conn,$sql);

    //4. count rows to check whether the user exists or not
    $count=mysqli_num_rows($res);

    if($count==1)
    {
            //user available and login success
            $_SESSION['login']="<div class='success text-center'> <h1>Login is successfull. <h1></div>";
            $_SESSION['user']=$username;//to check whether the user is loged in or not and logout will on set it
            header('location:'.SITEURL.'admin/');
    }
    else{
        //user not available
        $_SESSION['login']="<div class='error text-center'> Login is Fail.<br>Unvalid Username or Password</div>";
            header('location:'.SITEURL.'admin/login.php');
    
    }
}
?>