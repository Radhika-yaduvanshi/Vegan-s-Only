<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br>
<?php
//1.create the id of selected admin
$id=$_GET['id'];

//2.create sql qury to get the details
$sql="select * from tbl_admin where id=$id";

//execute query
$res=mysqli_query($conn,$sql);
//check wether te qury is executed or not
if($res==true)
{
    //check whether data is available or not
    $count=mysqli_num_rows($res);
    //check whether we have admin data or not
    if($count==1)
    {
        //get the details
        // echo "<div class='success'>Admin Availablae</div>";
        $row=mysqli_fetch_assoc($res);
        $full_name=$row['full_name'];
        $username=$row['username'];

    }
    else
    {
        //Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}
?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name;?>">
                    </td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                </tr>
                <!-- <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" value="">
                    </td>
                </tr> -->
                
                <tr>
                    <td col="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
          
                

            </table>
        </form>
    </div>
</div>


<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    // echo "button clicked";
    //get all the value from form to update
         $id=$_POST['id'];
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];

        //create sql query to update admin

        $sql="update tbl_admin set full_name='$full_name',
        username='$username' where id='$id'";

//execute the qury
$res=mysqli_query($conn,$sql);
if($res==true)
{
    //qurey executed and admin updatedk
    $_SESSION['update']="<div class='success'>Admin Updated Successfully.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');

}
else
{
    //failed to update admin
    $_SESSION['update']="<div class='success'>Failed To Update Admin.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');

}
}
?>

<?php
include('partials/footer.php');
?>