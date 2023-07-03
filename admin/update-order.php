<?php  
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1><br><br>

        <?php
            //check whether the is is set or not
            if(isset($_GET['id']))
            {
                //get the order details
                $id=$_GET['id'];
                //get all other details based on this id 
                //qry to get order details
                $sql="select * from tbl_order where id=$id";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                if($count==1){
                    //detail available
                    $row=mysqli_fetch_assoc($res);
                    $food=$row['food'];
                    $price=$row['price'];
                    $qty=$row['qty'];
                    $status=$row['status'];
                    $customer_name=$row['customer_name'];
                    $customer_contact=$row['customer_contact'];
                    $customer_email=$row['customer_email'];
                    $customer_address=$row['customer_address'];

                }
                else
                {
                    //detail not available
                    //redirect ot manage order
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                //redirect to order manage page
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Food Name</td>
                <td><b><?php echo $food;?><b></td>
            </tr>
            <tr>
                <td>Food Price</td>
                <td><b>Rs <?php echo $price;?><b></td>
            </tr>

            <tr>
                <td>Qty</td>
                <td>
                    <input type="number" name="qty" value="">
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>

                    <!-- <select name="status" id="">
                        <option <?php// if($status=="Ordered"){echo "Selected";} ?>value="Ordered">Ordered</option>
                        <option <?php //if($status=="On delivery"){echo "Selected";} ?>value="On delivery">On delivery</option>
                        <option <?php //if($status=="Delevered"){echo "Selected";} ?>value="Delevered">Delevered</option>
                        <option <?php //if($status=="Orderd Cancle"){echo "Selected";} ?>value="Orderd Cancle">Orderd Cancle</option>
                    </select> -->



                    <select name="status" id="">
    <option <?php if ($status == "Ordered") { echo "selected"; } ?> value="Ordered">Ordered</option>
    <option <?php if ($status == "Ondelivery") { echo "selected"; } ?> value="Ondelivery">Ondelivery</option>
    <option <?php if ($status == "Delivered") { echo "selected"; } ?> value="Delivered">Delivered</option>
    <option <?php if ($status == "canceled") { echo "selected"; } ?> value="canceled">canceled</option>
</select>

                </td>
            </tr>
            <tr>
                <td>Customer Name:</td>
                <td>
                    <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                </td>
            </tr>
            <tr>
                <td>Customer Contact:</td>
                <td>
                    <input type="number" name="customer_contact" value="<?php echo $customer_contact;?>">
                </td>
            </tr>
            <tr>
                <td>Customer E-mail:</td>
                <td>
                    <input type="email" name="customer_email" value="<?php echo $customer_email;?>">
                </td>
            </tr>
            <tr>
                <td>Customer Adddress:</td>
                <td>
                    <textarea name="customer_address" value="<?php echo $customer_address;?>"></textarea>
                </td>
            </tr>
            <!-- <tr>
                <td>Customer Address:</td>
                <td>
                    <textarea type="email" name="customer_address" value="<?php echo $customer_address;?>"></textarea>
                </td> -->
            </tr>


            <tr>
                <td colspan='2'>
                    <input type="hidden" name="id" value="<?php echo $id ;?>">
                    <input type="hidden" name="price" value="<?php echo $price;?>">
                    <input type="submit" name="submit" value="Update Order" class="btn-primary">

                </td>
            </tr>
        </table>

        </form>
<?php
//check whether update button is clicked or not

if(isset($_POST['submit']))
{
    // echo "clicked";
    //get all the values from form
    //update the vlaues 
  $id=$_POST['id'];
  $price=$_POST['price'];

// $price = floatval($row['price']);
  $qty=$_POST['qty'];
  $total= $price * $qty;
  $status=$_POST['status'];
  $customer_name=$_POST['customer_name'];
  $customer_contact=$_POST['customer_contact'];
  $customer_email=$_POST['customer_email'];
  $customer_address=$_POST['customer_address'];

  //update the valuevs
  $sql2="update tbl_order set
  qty=$qty,
  total=$total,
  status='$status',
  customer_name='$customer_name',
  customer_contact='$customer_contact',
  customer_email='$customer_email',
  customer_address='$customer_address'
  where id=$id
  ";

  //execute the qry
  $res2=mysqli_query($conn,$sql2);
  //qry executed or not
  if($res2==true)
  {
    //updated
    $_SESSION['update']="<div class='success'>Order Upadated Successfully.</div>";
    header('location:'.SITEURL.'admin/manage-order.php');
  }
  else
  {
    //not updated
    $_SESSION['update']="<div class='error'>Filed to update order.</div>";
    header('location:'.SITEURL.'admin/manage-order.php');
  }
    //redirect to manage order with massage
}

?>

    </div>
</div>

<?php  
include('partials/footer.php');
?>