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
                    <td><input type="radio" name="featured" value="Yes">Yes 
                    <input type="radio" name="featured" value="No">No
                </td>
                </tr>
                <tr>
                    <td>Active : </td>
                    <td><input type="radio" name="active" value="Yes">Yes 
                    <input type="radio" name="active" value="No">No
                </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Category" class="btn-third">
                    </td>
                </tr>
        </table>
    </form>
    </div>
</div>


<?php include('partials/footer.php'); ?>
