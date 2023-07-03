<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change password</h1>
        <br>
        <?php  
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="current_password" placeholder="Current Password"></td>
                </tr>
                <tr>
                    <td> New Password:</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td> Confirm Password:</td>
                    <td><input type="password" name="cnf_password" placeholder="Confirm Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="change password" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
//check the whether the submit button is clicked or not
if(isset($_POST['submit']))
{
// echo "button clicked";
//1.get the data from form
$id=$_POST['id'];
$current_password=($_POST['current_password']);
$new_password=($_POST['new_password']);
$cnf_password=($_POST['cnf_password']);
// $current_password=md5($_POST['current_password']);
// $new_password=md5($_POST['new_password']);
// $cnf_password=md5($_POST['cnf_password']);

//2.check whether the user with currnt id and current password exists or not
$sql="select * from tbl_admin where id=$id and password='$current_password'";
// $sql="update tbl_admin set password='$cnf_password' where id = '$id'";
//execute the query
$res=mysqli_query($conn,$sql);
if($res==true)
{
//check whether data is available or not
$count=mysqli_num_rows($res);
if($count==1)
{
    //user exists and password can be change
    // echo "user found";
    //check whether the new password and confirm match or not
    
}
else
{
    //user does not exists
    $_SESSION['user-not-found']="<div class='error'>user not found.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
}
//3.check whether the new password and confirm password match or not

//4.change the password if all above is true 
}
else
{

}
?>

<?php include('partials/footer.php') ?>