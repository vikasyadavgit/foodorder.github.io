<?php include('partials-front/menu.php'); ?>

    <!-- FOOD SEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- FOOD SEARCH Section Ends Here -->



    <!-- FOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                //Display Foods that are active
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                //Execute the Query
                $res = mysqli_query($conn,$sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check Whether the food are available or not
                if($count>0)
                {
                    //Foods Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php  
                                    //Check whether image available or not
                                    if($image_name=="")
                                    {
                                        //Image not available.
                                        echo "<div class='error'>Image Not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve" width="100px" height="100px">
                                        <?php
                                    }
                                ?>
                                
                             </div>

                             <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">Rs.<?php echo $price; ?></p>
                                <p class="food-detail">
                                  <?php echo $description; ?>
                                </p>
                                 <br>

                                 <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                         </div>

                        <?php
                    }

                }
                else
                {
                    //Food Not Available
                    echo "<div class='error'>Food not Found.</div>";
                }
            ?>

            

            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>