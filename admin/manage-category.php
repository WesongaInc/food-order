<?php $pageTitle = " Category > Admin > Food Ordering and Restaurant Booking System"; include("partials/menu.php"); ?>

        <!-- Main Content Section Starts --->
        <div class="main-content">
        <div class="wrapper">
            <h1>Manage Category</h1> 
            <?php if(isset($_SESSION['add-cat']))
        {
            echo $_SESSION['add-cat'];
            unset($_SESSION['add-cat']);
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
        ?>
    <!-- Button to Add Admin Starts-->
    <br><a href="add-category.php" class="btn-secondary">Add Category</a> <br>
        <br>

    <!-- Button to Add Admin  Ends-->
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                <?php 
                //Get all Category data from database
                    $sql = "SELECT * FROM tbl_category";
                    //Execute Category
                    $res = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);
                    //Create a variable and assign the value for serial number
                    $sn = 1; 
                    // Check whether we have data in database
                    if($count>0)
                    {
                        // we have data in database and will display data
                        while($row=mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>
                                <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title ; ?></td>
                                <td><?php 
                                    // Check whether image name is available or not
                                    if($image_name!=""){
                                        //Display image
                                        ?>
                                        <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" width="100px">
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
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-primary">Update Category</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a> 
                                </td>
                            </tr>
                            <?php
                        }

                    }else{
                        // No data & we will break the php to display message in the table 
                        ?>
                        <tr>
                            <td colspan="6"><div class="btn-secondary">No Category Available</div></td>
                        </tr>
                        <?php
                    }
                 ?>
                
                
            </table>
            </div>
        </div>
        <!-- Main Content Section Ends --->

<?php include('partials/footer.php'); ?>