<?php
include('partials-front/menu.php');
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
        
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            //getting foods from database that are active and featred
            //qry
            $sql2="select * from tbl_food where active='yes' and featured='yes' limit 6";
            //execute qry
            $res2=mysqli_query($conn,$sql2);
            //count rows
            $count2=mysqli_num_rows($res2);

            //check whether   food is available or not
            if($count2>0)
            {
                //food available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //get the value
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name=$row['image_name'];
                    ?>
                            <div class="food-menu-box">
                                        <div class="food-menu-img">
                                            <?php
                                                //check whether image is availabe or not
                                                if($image_name=="")
                                                {
                                                    //image is not available
                                                    echo "<div class='error'>Image Not Added.</div>";

                                                }
                                                else
                                                {
                                                    //image available

                                                    ?>
                                                    <img src="<?php  echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                                    <?php
                                                }

                                            ?>
                                            
                                        </div>

                                        <div class="food-menu-desc">
                                            <h4><?php echo $title ?></h4>
                                            <p class="food-price"><?php echo 'Rs.'.$price; ?></p>
                                            <p class="food-detail">
                                            <?php echo $description; ?>
                                            </p>
                                            <br>

                                            <a href="<?php echo SITEURL ?>order.php?food_id=<?php  echo $id;?>" class="btn btn-primary">Order Now</a>

                                        </div>
                                    </div>

                    <?php
                }
            }
            else
            {
                //food not available
                echo "<div class='error'>FOOD NOT AVAILABLE</div>";

            }


            ?>

        

<!-- 
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div> -->

           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php
include('partials-front/footer.php');
?>