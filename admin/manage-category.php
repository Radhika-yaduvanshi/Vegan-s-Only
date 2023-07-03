<?php
include('partials/menu.php');
?>

    <!-- main content section starts -->
    <div class="main-content">
        <div class="wrapper">
<h1>Manage Category</h1><br>

<?php
   if(isset($_SESSION['add']))
   {
    echo $_SESSION['add'];
    unset($_SESSION['add']);
   }
   if(isset($_SESSION['delete']))
   {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
   }
   if(isset($_SESSION['update']))
   {
    echo $_SESSION['update'];
    unset($_SESSION['update']);
   }
   if(isset($_SESSION['no-category-found']))
   {
    echo $_SESSION['no-category-found'];
    unset($_SESSION['no-category-found']);
   }
   if(isset($_SESSION['update']))
   {
    echo $_SESSION['update'];
    unset($_SESSION['update']);
   }
   if(isset($_SESSION['failed-remove']))
   {
    echo $_SESSION['failed-remove'];
    unset($_SESSION['failed-remove']);
   }


?><br>
<!-- button to add admin -->
<a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
<br><br>
<table class="tbl-full text-center">
    <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Action</th>
        <!-- <th>Password</th> -->
    </tr>

    <?php
$sql='select * from tbl_category';

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
            $title=$rows['title'];
            $image_name=$rows['image_name'];
            $featured=$rows['featured'];
            $active=$rows['active'];

            //display the value in our table

            ?>

            
    <tr>
        <td><?php echo $sn++;?></td>
        <td><?php echo $title;?></td>
        <td>
            <?php
                if($image_name!="")
                {
                    //display the image
                    ?>

                    <img src="<?php  echo SITEURL; ?>images/category/<?php echo  $image_name ?>" alt="img" width="100px">

                    <?php
                    
                }
                else{
                    echo "<div class='error'>Image Not Added</div>";
                }
             ?>
        </td>
        <td><?php echo $featured;?></td>
        <td><?php echo $active;?></td>
        <td>
            <!-- <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class='btn-primary'>Change Password</a> -->
            <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
            <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name" class="btn-danger">Delete Category</a>
            
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

   