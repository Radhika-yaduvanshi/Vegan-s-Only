<?php
include('partials/menu.php');
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1><br><br>

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
        <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Title Of The Food">
                        </td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description" id="" cols="20" rows="5" placeholder="Description for the food"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>
                        <input type="number" name="price" placeholder="Price">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category" id="">
                                <?php  
                                //create php code to display categories from database

                                //1.create sql to get all active categories froom database
                                $sql="select * from tbl_category where active='yes'"; 
                                //executing query
                                $res=mysqli_query($conn,$sql);
                                //count rows
                                $count=mysqli_num_rows($res);

                                //if count is grater then 0 we have category else we do not have category
                                if($count>0)
                                {
                                    //we have category
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id=$row['id'];
                                        $title=$row['title'];
                                        ?>
                                           <option value="<?php  echo $id ;?>"><?php echo $title; ?></option>


                                        <?php
                                    }
                                }
                                else
                                {
                                    //we dont have catagory
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }

                                //2.display on dropdown


                                ?>
                               
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="yes">Yes
                            <input type="radio" name="featured" value="no">NO
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="yes">Yes
                            <input type="radio" name="active" value="no">NO
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Food" class="btn-primary">
                        </td>
                    </tr>


                </table>
    
        </form>

        <?php
        //check whether the button is clicked or not
        if(isset($_POST['submit']))
        {
            // echo " clicked";
            //1.get the data from form 
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $category=$_POST['category'];

            //whether radio buttoon for featured and active are checked or not
            if(isset($_POST['featured']))
            {
                $featured=$_POST['featured'];
            }
            else
            {
                $featured="no";//setting default value
            }
            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else
            {
                $active="no";//setting default value
            }

            //2.upload the image if selected

            //check whether the select image is clicked or not and upload the image only if the image is selected
            if(isset($_FILES['image']['name']))
            {
                //get the details of the selected image
                $image_name=$_FILES['image']['name'];

                //check whether the image is selected or not upload image only if selected
                if($image_name != "")
                {
                    //image selected
                    //A.rename image 
                    //get the extention of selected image(jpg,)
                        // $ext=end(explode('.',$image_name));
                        $ext=end(explode('.',$image_name));
                        //create new name for image
                        $image_name="Food-name-".rand(0000,9999).".".$ext;//new image name may be "food-name-6766.jpg"
                    //B.upload the image
                    //get source path and destination path

                    //source path is the current location of the image
                    $src=$_FILES['image']['tmp_name'];

                    //dedtination path for the image to upload
                    $dst="../images/food/".$image_name;
                    //finally upload food image
                    $upload=move_uploaded_file($src,$dst);

                    //check whether the image uploaded or not
                    if($upload==false)
                    {
                        //failed to uploa image
                        //redirect to add food page withe error massage
                        $_SESSION['upload']="<div class'error'>Failed to upload image</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        //stop the process
                        die();
                    }
                }
                
            }
            else
            {
                $image_name="";//setting default value as blank
            }

            //3. insert into database

            //create a sql query to save or add data in database
            //for numerical value not need to valu inside quoted but for string value it is compulsary to add quotes ''

            $sql2="insert into tbl_food set
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id=$category,
            featured='$featured',
            active='$active'
            ";


            // $sql2= " INSERT INTO `tbl_food`( `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES ('[$title]','[$description]','[$price]','[$image_name]','[$category]','[$featured]','[$active]')";


            //execute the query

            $res2=mysqli_query($conn,$sql2);

            //check whether data inserted or not
            if($res2==true)
            {
                //data inserted successfullly
                $_SESSION['add']="<div class='success'>Food added successfully</div>";
                // header('location:'.SITEURL.'admin/manage-food.php');
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else
            {
                //fail to insert data
                $_SESSION['add']="<div class='error'>Fail to add Food</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }



            //4.redirect with massage to manage food page
        }
        ?>
    </div>
</div>


<?php
include('partials/footer.php');
?>