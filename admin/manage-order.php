<?php
include('partials/menu.php');
?>

    <!-- main content section starts -->
    <div class="main-content">
        <div class="wrapper">
<h1>Manage Order</h1>

<!-- button to add admin -->
<!-- <a href="#" class="btn-primary">Add Order</a> -->
<br><br>

<?php
if(isset($_SESSION['update']))
{
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}
?>
<table class="tbl-full">
    <tr>
        <th>S.N</th>
        <th>Food</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Customer Name</th>
        <th>Customer Contact</th>
        <th>Customer Email</th>
        <th>Customer Address</th>
        <th>Action</th>
    </tr>

    <?php
    //get all the orders from database

    $sql="select * from tbl_order order by id desc ";//display the latest order at first
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);
    $sn=1;//serial no and 
    if($count>0)
    {
        //order available
        while($row=mysqli_fetch_assoc($res))
        {
            //get all the order details
            $id=$row['id'];
            $food=$row['food'];
            $price=$row['price'];
            $qty=$row['qty'];
            $total=$row['total'];
            $order_date=$row['order_date'];
            $status=$row['status'];
            $customer_name=$row['customer_name'];
            $customer_contact=$row['customer_contact'];
            $customer_email=$row['customer_email'];
            $customer_address=$row['customer_address'];

            ?>
                            <tr>
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $food;?></td>
                    <td><?php echo $price;?></td>
                    <td><?php echo $qty;?></td>
                    <td><?php echo $total;?></td>
                    <td><?php echo $order_date;?></td>
                    

                    <td>
                        <?php 
                        // Ordered, On delivery, Delivered, Order Canceled
                        //Ordered,On delivery,
                        if ($status == "Ordered") {
                            echo "<label>$status</label>";
                        } elseif ($status == "Ondelivery") {
                            echo "<label style='color: orange;'>$status</label>";
                        } elseif ($status == "Delivered") {
                            echo "<label style='color: green;'>$status</label>";
                        } elseif ($status == "canceled") {
                            echo "<label style='color: blue;'>$status</label>";
                        }
                        
                        ?>
                    </td>
                    
                    <td><?php echo $customer_name;?></td>
                    <td><?php echo $customer_contact;?></td>
                    <td><?php echo $customer_email;?></td>
                    <td><?php echo $customer_address;?></td>
                    <td>
                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update Order</a>
                        <!-- <a href="" class="btn-danger">Delete Admin</a> -->
                        
                    </td> 
            </tr>
            <?php
        }

    }
    else
    {
        //order not available
        echo "<tr><td colspan='12' class='error'>Order Not Available.</td></tr>";
    }
    ?>
    
</table>
</div>
</div>
<?php
include('partials/footer.php');
?>

   