<?php
include('partials/menu.php');
?>
<div class="main-content">
        <h1>Update Category</h1><br><br>

        <?php

//check whether the id is set or not
if(isset($_GET['id']))
{
    //get the id and all other detail 
    // echo"collecting data";
    $id=$_GET['id'];

    //create sql query to get all other details
    $sql="select * from tbl_category where id=$id";

    //execute the query

    $res=mysqli_query($conn,$sql);

    //count the rows to check whether the id is valid or not
    $count=mysqli_num_rows($res);
    if($count==1)
    {
        //get all data
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $current_image=$row['image_name'];
        $featured=$row['featured'];
        $active=$row['active'];
    }
    else
    {
        //redirect to manage category with session massage
        $_SESSION['no-category-found']="<div class='error'>Category Not Found</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
}
else
{
    //redirect to manage category
    header('location:'.SITEURL.'admin/manage-category.php');
}
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
        <tr>
            <td>Title : </td>
            <td>
                <input type="text" name="title" value="<?php echo $title?>">
            </td>
        </tr>

        <tr>
            <td>Current Image:</td>
            <td>
                <?php
if($current_image != "")
{
    //display the image
    ?>
    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ;?> " width="100px">
    <?php
}
else{
    //display massage
    echo "<div class='error'>Image Not Added</div>";
}
                ?>
            </td>
        </tr>
        <tr>
            <td>New Image:</td>
            <td>
                <input type="file" name="image" id="">
            </td>
        </tr>
        <tr>
            <td>Featured:</td>
            <td>
                <input <?php if($featured == "yes"){echo "checked";}?> type="radio" name="featured" value="yes">Yes
                <input <?php if($featured == "no"){echo "checked";}?> type="radio" name="featured" value="no">No
               
            </td>
        </tr>
        <tr>
            <td>Active:</td>
            <td>
                <input <?php if($active == "yes"){echo "checked";}?> type="radio" name="active" value="yes">Yes
                <input <?php if($active == "no"){echo "checked";}?> type="radio" name="active" value="no">No
            </td>
        </tr>
        <tr>
            <td>
                <input type="hidden" name="current_image" value="<?php echo $current_image ;?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Category" class="btn-primary">
            </td>

        </tr>
        </table>
        </form>
        <?php
        if(isset($_POST['submit']))
        {
            //1.get all the value from our form
            $id=$_POST['id'];
            $title=$_POST['title'];

            $current_image=$_POST['current_image'];
            $featured=$_POST['featured'];
            $active=$_POST['active'];

            //2.updating new image if selected
            //check whether the image is selected or not
            if(isset($_FILES['image']['name']))
            {
                //get the image detail
                $image_name=$_FILES['image']['name'];

                //check whether the image is availaable or not
                if($image_name !="")
                {
                    //image available
                    //A. upload the new image
                    
                        //Auto rename our image
                        //get the extention of our image (jpg,png,jpeg)eg:  food1.jpg
                        $ext=end(explode('.',$image_name));
                        //rename the image 
                        $image_name="Food_category_".rand(000,999).'.'.$ext;//eg.food_category_834.jpg




                        $source_path=$_FILES['image']['tmp_name'];
                        $destination_path="../images/category/".$image_name;

                        //finally upload the image
                        $upload=move_uploaded_file($source_path,$destination_path);

                        //check whether the image is uploaded or not 

                        //if image is not uploaded this will stop the proccess and redirect wit error massage

                        if($upload==false)
                        {
                            //set massage
                            $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                            //redirect to add-category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //stop the 
                            die();

            }

                    //B. remove the current image if available
                    if($current_image !="")
                    {
                        $remove_path="../images/category/".$current_image;

                        $remove=unlink($remove_path);
    
                        //check whether the image is remove or not 
                        //if fail to remove then display massage and stop proccess
    
                        if($remove==false)
                        {
                            //fail to remove image
                            $_SESSION['failed-remove']="<div class=='error'>Failed to remove current image</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();//stop the proccess
                        }
    
                    }
                    

                }
                else
                {
                    $image_name=$current_image;
                }
            }
            else
            {
                $image_name=$current_image;
            }

            //3.update the database
            $sql2="update tbl_category set
            title='$title',image_name='$image_name',featured='$featured',active='$active' where id=$id";

            //execute the query
            $res2=mysqli_query($conn,$sql2);

            //4.redirect to manage category with massage
            //check whether query executed or not 
            if($res2==true)
            {
                //category updated
                $_SESSION['update']="<div class='success'>Category Updated Successfully .</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                //failed to update category
                $_SESSION['update']="<div class='error'>Fail To Update Category .</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        ?>
    </div>
</div>


<?php
include('partials/footer.php');
?>
