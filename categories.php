<?php include("partials-front/menu.php"); ?> 
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
//SQL query to display category from database
    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
    $res = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($res);
    if($count>0){
        while($row=mysqli_fetch_assoc($res)){
            //Get the values
            $id = $row['id'];
            $title = $row['title'];
            $image_name = $row['image_name'];
            ?>
            <a href="category-foods.php">
            <div class="box-3 float-container">
            <?php 
            // Check whether image_name(the image) is available or not
            if($image_name!=""){
                //Display image
                ?>
                <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve" width="100%" height="300px">
                <?php
            }
            else{
                //Display message
                echo "<div class='btn-secondary'>No Image Available</div>";
            }
            ?>
                

                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
            </a>
            <?php
        }

    }else{
        ?>
        <div class="btn-secondary">No Category Available</div>
        <?php 
    }
?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include("partials-front/footer.php"); ?> 