<?php
include('partials/menu.php');
?>

    <!-- main content section starts -->
    <div class="main-content">
        <div class="wrapper">
<h1>Manage Food</h1>
<br>

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
   if(isset($_SESSION['no-food-found']))
   {
    echo $_SESSION['no-food-found'];
    unset($_SESSION['no-food-found']);
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
<a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
<br><br>
<table class="tbl-full">
    <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>action</th>
    </tr>
<?php
//create a query to get all the food
$sql="select * from tbl_food ";
//execute the query
$res=mysqli_query($conn,$sql);

//count rows to check whether we have food or not
$count=mysqli_num_rows($res);

//create serial number  variable and set default value as 1
$sn=1;
if($count>0)
{
    //we have food 
    //get the food and display
    while($row=mysqli_fetch_assoc($res))
    {
        //get the value from individuall colums
        $id=$row['id'];
        $title=$row['title'];
        $price=$row['price'];
        $image_name=$row['image_name'];
        $featured=$row['featured'];
        $active=$row['active'];
        ?>
  <tr>
        <td><?php echo $sn++;?></td>
        <td><?php echo $title;?></td>
        <td><?php echo $price;?></td>
        <td>
        <?php
        //  echo $image_name;
        //check whether we have image or not
        if($image_name=="")
        {
                //DOnot have image,display error
                 echo "<div class='error'>Image Not Added.</div>";
        }
        else
        {
            //we have image display image
            ?>
            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="100px" >
            <?php
        }
        
         ?>
        </td>
        <td><?php echo $featured;?></td>
        <td><?php echo $active;?></td>
        <td>
            <!-- <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class='btn-primary'>Change Password</a> -->
            <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
            <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name" class="btn-danger">Delete Food</a>
            
        </td>
    </tr>
        <?php
    }
}
else
{
    //no food
    echo "<tr><td colspan='7'> Food Not Added Yet.</td></tr>";
}
?>
  
   
</table>
</div>
</div>
<?php
include('partials/footer.php');
?>

   