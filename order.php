<?php
include('partials-front/menu.php');
?>

<?php
//check food id is set or not
if(isset($_GET['food_id']))
{
    //get food id and details of the selected food
    $food_id=$_GET['food_id'];
    //get the details of the selected food
    $sql="select * from tbl_food where id=$food_id";
    //execute qry
    $res=mysqli_query($conn,$sql);
    //count rows
    $count=mysqli_num_rows($res);
    if($count==1) 
    {
        //we have data
        //GET data from database
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $price=$row['price'];
        $image_name=$row['image_name'];
        // $total=$row['total'];
        // $qty=$row['qty'];
    }
    else
    {
        //no data of food
        //redirect home page
        header('location'.SITEURL);
    }

}
else
{
    //redirect ot home page
    header('location:'.SITEURL);
}
?>

    <!-- fOOD sEARCH Section Starts Here -->

    
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        //check whether the image is available or not
                        if($image_name=="")
                        {
                            //image not available
                            echo "<div class='error'>Image is not available</div>";
                        }
                        else
                        {
                            //image available
                            ?>
                           <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }

                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php  echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>"> 
                        <p class="food-price">Rs.<?php  echo $price ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>"> 

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                        <!-- <h3><?php  echo "your total"; ?></h3>
                        <input type="text" name="food" value="<?php echo $qty*$price; ?>">  -->

                       
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                //check submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //get all the details from the form
                    $food =$_POST['food'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];

                    $total=$price*$qty;
                    $order_date=date("y-m-d h:i:sa");
                    $status="orderd";   //orderd,on delivery,delivered,cancelled
                    $customer_name=$_POST['full-name'];
                    $customer_contact=$_POST['contact'];
                    $customer_email=$_POST['email'];
                    $customer_address=$_POST['address'];

                    //save the order in  database
                    //create sql to save data 
                    $sql2="insert into tbl_order set
                    food='$food',
                    price=$price,
                    qty=$qty,
                    total=$total,
                    order_date='$order_date',
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                    
                    ";
// echo $sql2;
// die();
                    //execute qry
                    $res2=mysqli_query($conn,$sql2);
                    if($res2==true)
                    {
                        //qry executed and order saved
                        $_SESSION['order']="<div class='success text-center'>ORDER PLACED SUCCESSFULLY. </div>";
                        header('location:'.SITEURL);

                    }
                    else
                    {
                        //failed to save the order
                        $_SESSION['order']="<div class='error text-center''>FAILED TO PLACE THE ORDER</div>";
                        header('location:'.SITEURL);
                    }



                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
include('partials-front/footer.php');
?>