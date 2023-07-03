<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1><br><br>

        
<?php
   if(isset($_SESSION['add']))
   {
    echo $_SESSION['add'];
    unset($_SESSION['add']);
   }
   if(isset($_SESSION['upload']))
   {
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
   }
?>


        <!-- add category form starts-->

<form action="" method="POST" enctype="multipart/form-data">
    <!-- enctype property will allow to upload the image in database -->
    <table class="tbl-30">
    <tr>
        <td>Title: </td>
        <td>
            <input type="text" name="title" placeholder="Category Title">
        </td>
    </tr>

    <tr>
        <td>Select Image</td>
        <td>
            <input type="file" name="image">
        </td>
    </tr>


    <tr>
        <td>Featured: </td>
        <td>
            <input type="radio" name="featured" value="yes">Yes
            <input type="radio" name="featured" value="no">No
        </td>
    </tr>
    <tr>
        <td>Active: </td>
        <td>
            <input type="radio" name="active" value="yes">Yes
            <input type="radio" name="active" value="no">No
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <input type="submit" name="submit" value="Add Category" class="btn-primary">
        </td>
    </tr>

    </table>
</form>
        <!-- add category form ends -->


        <?php   
         //check whether the submit button is clicked or not

         if(isset($_POST['submit']))
         {
            // echo "button clicked";
            
            //1.get the value from category form
            $title=$_POST['title'];

            //for radio input type we need to check the button is selected or not
            if(isset($_POST['featured']))
            {
                //get the value from form 
                $featured=$_POST['featured'];

            }
            else
            {
                //set the default value
                $featured="no";
            }
            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else
            {
                $active="no";
            }

            //check whether  the image is selected  or not and set the value for image name accordingly
       //  print_r($_FILES['image']);

        // die();//brack the code here

        if(isset($_FILES['image']['name']))
        {
            //upload the image
            //to upload image we need image name source path and destiantion path
            $image_name=$_FILES['image']['name'];

            //upload image only if image is selected
            if($image_name !="")
            {

                        

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
                            header('location:'.SITEURL.'admin/add-category.php');
                            //stop the 
                            die();

            }
        }
        
        }
        else
        {
            //dont upload image and set the image_name value as blank
            $image_name="";
        }

           //2.create sql query to insert category into database
           $sql="insert into tbl_category set
            title='$title',
            image_name='$image_name',
            featured='$featured', 
            active='$active'";

           //3.execute the query and save in database
           $res=mysqli_query($conn,$sql);

           //4.check whether the query is executed or not and data added or not
           if($res==true)
           {
            //query executed and category added
            $_SESSION['add']="<div class='success'>Category Added successfully.</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
           }
           else
           {
            //fail to add category
            //query executed and category added
            $_SESSION['add']="<div class='error'>Failed TO Add Category.</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
           }
         }
         else
         {
            // echo "not clicked";
         }
        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>