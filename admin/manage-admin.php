<?php
include('partials/menu.php');
?>

    <!-- main content section starts -->
    <div class="main-content">
        <div class="wrapper">
<h1>Manage Admin</h1>
<br>

<?php
if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];//Displaying session massage
    unset($_SESSION['add']);//Removing session massage
}
if(isset($_SESSION['delete']))
{
    echo $_SESSION['delete'];//Displaying session massage
    unset($_SESSION['delete']);//Removing session massage
}
if(isset($_SESSION['update']))
{
    echo $_SESSION['update'];//Displaying session massage
    unset($_SESSION['update']);//Removing session massage
}
if(isset($_SESSION['user-not-found']))
{
    echo $_SESSION['user-not-found'];//Displaying session massage
    unset($_SESSION['user-not-found']);//Removing session massage
}
if(isset($_SESSION['upload']))
{
    echo $_SESSION['upload'];//Displaying session massage
    unset($_SESSION['upload']);//Removing session massage
}
?>
<br>
<br>
<!-- button to add admin -->
<a href="add-admin.php" class="btn-primary">Add Admin</a>
<br><br>
<table class="tbl-full">
    <tr>
        <th>S.N</th>
        <th>Full Name</th>
        <th>User Name</th>
        <th>Actions</th>
    </tr>
<?php
$sql='select * from tbl_admin';
//execute the qurey

$res=mysqli_query($conn,$sql);
//check wther the qury is executed or not
if($res==TRUE)
{
    //count rows to check wether we have data on database or not

    $count=mysqli_num_rows($res);//function to get all the rows in database
    //ceck the num of rows 

    $sn=1;//create a variable and assign the value
    if($count>0)
    {
        //we have data in databasse
        while($rows=mysqli_fetch_assoc($res))
        {
            //using while loop to get all the data from database
            //while loop will run as long as we have data in database

            //get individual data

            $id=$rows['id'];
            $full_name=$rows['full_name'];
            $username=$rows['username'];

            //display the value in our table

            ?>

            
    <tr>
        <td><?php echo $sn++;?></td>
        <td><?php echo $full_name;?></td>
        <td><?php echo $username;?></td>
        <td>
            <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class='btn-primary'>Change Password</a>
            <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
            <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
            
        </td>
    </tr>
            <?php
        }
    }
    else
    echo "we dont have any data";
}

?>


   
</table>
</div>
</div>
<?php
include('partials/footer.php');
?>

   