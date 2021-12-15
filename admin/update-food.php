<?php $pageTitle = " Update > Food > Food Ordering and Restaurant Booking System"; include("partials/menu.php"); ?>
<?php
    //Check whether the id is set or not
    if(isset($_GET['id'])){
        // Get id and it's details
        $id = $_GET['id'];
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
        $res2 = mysqli_query($conn,$sql2);
        $count2 = mysqli_num_rows($res2);
        if($count2==1){
            //Get All the data
            $row2 = mysqli_fetch_assoc($res2);
            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];
        }
        else{
            //Redirect to food page
            $_SESSION['update'] = "<br><p class='btn-danger'>Food not Found! </p><br>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

    }else{
        //Redirect to food page
        $_SESSION['update'] = "<p class='btn-danger'>Food not Found! </p>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30" >
            <tr>
                <td>Title</td>
                <td><input type="text" name="title" value="<?php echo $title;?>"></td>
            </tr>
            <tr>
                <td>Description : </td>
                <td><textarea name="description"  cols="30" rows="5" ><?php echo $description;?></textarea> </td>
                </tr>
                <tr>
                <td>Price : </td>
                <td><input type="number" name="price" value="<?php echo $price;?>"> Taka</td>
                </tr>
            <tr>
                <td>Current Image</td>
                <td><?php
                    if($current_image!=""){
                        //Display image
                        ?>
                        <img src="<?php echo SITEURL; ?>/images/food/<?php echo $current_image; ?>" width="100px">
                        <?php
                    }else{
                        //Display Message
                        echo "<div class='btn-secondary'>No Image Available</div>";
                    }
                ?></td>
            </tr>
            <tr>
                <td>New Image</td>
                <td><input type="file" name="image" ></td>
            </tr>
            <tr>
                    <td>Category : </td>
                    <td>
                        <select name="category">

                            <?php 
                            //PhP code to display categories from database
                            //1.SQL to get all Active Categories
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn,$sql);
                            $count = mysqli_num_rows($res);
                            if($count>0){
                                //2.Display on Dropdown
                                while($row=mysqli_fetch_assoc($res)){
                                    // Get the details of category
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                                    ?>
                                <option <?php if($current_category==$category_id) {echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php
                                }
                            }else{

                                //No Active Categories
                                ?>
                                <option value="0">No Active Categories</option>
                                <?php
                            }
                            
                            ?>
                        </select>
                    </td>
                </tr>
            <tr>
                    <td>Featured : </td>
                    <td><input <?php if($featured=="Yes"){ echo "checked";} ?> type="radio" name="featured" value="Yes">Yes 
                    <input <?php if($featured=="No"){ echo "checked";} ?> type="radio" name="featured" value="No">No
                </td>
                </tr>
                <tr>
                    <td>Active : </td>
                    <td><input <?php if($active=="Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes">Yes 
                    <input <?php if($active=="No"){ echo "checked";} ?> type="radio" name="active" value="No">No
                </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-third">
                    </td>
                </tr>
        </table>
    </form>
    <?php
        if(isset($_POST['submit'])){
            //1.Get all the values from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];
            //2.Updating new image if selected
            if(isset($_FILES['image']['name'])){
                //Get the image details
                $image_name = $_FILES['image']['name'];
                //check whether the image is available or not
                if($image_name!=""){
                    //Image Available
                    //A.Upload the new image
                    //Auto rename image to avoid replace having the same image name , Get the extension of the image e.g. food1.png
                    $ext = end(explode('.',$image_name));
                    //Rename the image
                    $image_name = "Food-Name-".rand(0000,9999).'.'.$ext; //Renamed to -> Food-Name-0001.png
                    $src_path = $_FILES['image']['tmp_name'];
                    $dest_path = "../images/food/".$image_name;

                    //Finally upload the image
                    $upload = move_uploaded_file($src_path,$dest_path);
                    //Check whether the image is uploaded or not
                    // If the image is not uploaded then we will stop the process and redirect with error message
                    if($upload==false){
                        //Set message
                        $_SESSION['upload'] = "<div class='btn-secondary text-center'> <br> Failed to upload image<br></div>";   
                        header("location:".SITEURL.'admin/manage-food.php');
                        //Stop the process
                        die();
                    }
                    //B.Remove the current image if available
                    if($current_image!=""){
                        //Current image is available
                        $remove_path = "../images/food/".$current_image;
                        $remove = unlink($remove_path);
                        //B.1.If failed to remove image the display message and stop!
                        if($remove==false)
                        {
                            $_SESSION['upload'] = "<div class='btn-secondary text-center'> <br> Failed to Remove image<br></div>";   
                            header("location:".SITEURL.'admin/manage-food.php');
                        //Stop the process
                        die();
                        }
                    }
                        
                }else{
                    $image_name=$current_image;
                }
            }else{
                $image_name=$current_image;
            }

            //3.Update the database
            $sql3 = "UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
             ";
             $res3 = mysqli_query($conn,$sql3);

            //4.Redirect to category page
            //Check whether query is executed or not!
            if($res3==true){
                $_SESSION['update'] = "<br><p class='btn-primary'>Food updated Successfully! </p><br>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }else{
                $_SESSION['update'] = "<br><p class='btn-danger'>Failed to update Food ! </p><br>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }


        }
?>
    </div>
</div>


<?php include('partials/footer.php'); ?>
