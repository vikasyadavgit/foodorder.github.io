<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
       <h1>Manage Order</h1>


       <br><br><br>

        <?php  
           if(isset($_SESSION['update']))
           {
               echo $_SESSION['update'];
               unset($_SESSION['update']);
           }
       ?>

       <br> <br>


        <table>
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>E-Mail</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php  
                //Get all the orders from Database
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //Display the Latest Order at First

                //Execute Query
                $res = mysqli_query($conn,$sql);

                //Count the Rows
                $count = mysqli_num_rows($res);

                $sn = 1; //Create a Serial Number and set its its intail value is 1.

                if($count>0)
                {
                    //Order Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get all the orders Details
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];

                        ?>
                         
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $food; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $qty;?></td>
                            <td><?php echo $total;?></td>
                            <td><?php echo $order_date;?></td>
                            <td><?php echo $status;?></td>
                            <td><?php echo $customer_name;?></td>
                            <td><?php echo $customer_contact;?></td>
                            <td><?php echo $customer_email;?></td>
                            <td><?php echo $customer_address;?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                            </td>
                        </tr>

                        <?php
                    }
                }
                else
                {
                    //Order Not Available
                    echo "<tr><td colspan='12' class='error'>Orders Not Available</td></tr>";
                }
            ?>

            

            

        </table>

    </div>
    
</div>

<?php include('partials/footer.php'); ?>