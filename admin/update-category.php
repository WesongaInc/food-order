<?php $pageTitle = " Update > Category > Food Ordering and Restaurant Booking System"; include("partials/menu.php"); ?>
<?php
    //Check whether the id is set or not
    if(isset($_GET['id'])){
        // Get id and it's details
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($res);
        if($count==1){
            //Get All the data
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
        }
        else{
            //Redirect to category page
            $_SESSION['update'] = "<br><p class='btn-danger'>Category not Found! </p><br>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    }else{
        //Redirect to category page
        $_SESSION['update'] = "<p class='btn-danger'>Category not Found! </p>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30" >
            <tr>
                <td>Title</td>
                <td><input type="text" name="title" value="<?php echo $title;?>"></td>
            </tr>
            <tr>
                <td>Current Image</td>
                <td><?php
                    if($current_image!=""){
                        //Display image
                        ?>
                        <img src="<?php echo SITEURL; ?>/images/category/<?php echo $current_image; ?>" width="100px">
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
                        <input type="submit" name="submit" value="Update Category" class="btn-third">
                    </td>
                </tr>
        </table>
    </form>
    <?php
        if(isset($_POST['submit'])){
            //1.Get all the values from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
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
                    $image_name = "Food_Category_".rand(000,999).'.'.$ext; //Renamed to -> Food_Category_001.png
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;

                    //Finally upload the image
                    $upload = move_uploaded_file($source_path,$destination_path);
                    //Check whether the image is uploaded or not
                    // If the image is not uploaded then we will stop the process and redirect with error message
                    if($upload==false){
                        //Set message
                        $_SESSION['upload'] = "<div class='btn-secondary text-center'> <br> Failed to upload image<br></div>";   
                        header("location:".SITEURL.'admin/manage-category.php');
                        //Stop the process
                        die();
                    }
                    //B.Remove the current image if available
                    if($current_image!=""){
                        $remove_path = "../images/category/".$current_image;
                        $remove = unlink($remove_path);
                        //B.1.If failed to remove image the display message and stop!
                        if($remove==false)
                        {
                            $_SESSION['upload'] = "<div class='btn-secondary text-center'> <br> Failed to Remove image<br></div>";   
                            header("location:".SITEURL.'admin/manage-category.php');
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
            $sql2 = "UPDATE tbl_category SET
                title = '$title',
                featured = '$featured',
                image_name = '$image_name',
                active = '$active'
                WHERE id=$id
             ";
             $res2 = mysqli_query($conn,$sql2);

            //4.Redirect to category page
            //Check whether query is executed or not!
            if($res2==true){
                $_SESSION['update'] = "<br><p class='btn-primary'>Category updated Successfully! </p><br>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }else{
                $_SESSION['update'] = "<br><p class='btn-danger'>Failed to update Category ! </p><br>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }


        }
?>
    </div>
</div>


<?php include('partials/footer.php'); ?>
