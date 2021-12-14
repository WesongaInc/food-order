<?php $pageTitle = " Food > Admin > Food Ordering and Restaurant Booking System"; include("partials/menu.php"); ?>

        <!-- Main Content Section Starts --->
        <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>
            <br>
        <?php if(isset($_SESSION['add-food']))
        {
            echo $_SESSION['add-food'];
            unset($_SESSION['add-food']);
        }if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
         ?>
        <!-- Button to Add Admin Starts-->
    <br><a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-secondary">Add Food</a> <br><br>
    <!-- Button to Add Admin  Ends-->
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>

                </tr>
                <?php 
                    //Create SQL to Get All the Food
                    $sql ="SELECT * FROM tbl_food";
                    $res = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);
                    //Create a variable and assign the value for serial number
                    $sn = 1; 
                    if($count>0) {
                        // Food in Database
                        while($row=mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>
                                <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title ; ?></td>
                                <td><?php echo $price ; ?> taka </td>
                                <td><?php 
                                    // Check whether image name is available or not
                                    if($image_name!=""){
                                        //Display image
                                        ?>
                                        <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" width="100px">
                                        <?php
                                    }
                                    else{
                                        //Display message
                                        echo "<div class='btn-secondary'>No Image Available</div>";
                                    }
                                 ?></td>
                                <td><?php echo $featured ; ?></td>
                                <td><?php echo $active ; ?></td>
                                <td>
                                <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-primary">Update Food</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a> 
                                </td>
                            </tr>
                            <?php
                        }
                    }    else{
                        // No data & we will break the php to display message in the table 
                        ?>
                        <tr>
                            <td colspan="7"><div class="btn-secondary">No Food Available</div></td>
                        </tr>
                        <?php
                    }

                 ?>
                
            </table>
            </div>
        </div>
        <!-- Main Content Section Ends --->

<?php include('partials/footer.php'); ?>