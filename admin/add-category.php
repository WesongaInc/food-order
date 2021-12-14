<?php $pageTitle = "Category > Add New Category > Food Ordering and Restaurant Booking System"; include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1> <br>
        <?php if(isset($_SESSION['add-cat']))
        {
            echo $_SESSION['add-cat'];
            unset($_SESSION['add-cat']);
        }if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
         ?><br>

        <!-- Add Category form starts here -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title : </td>
                    <td><input type="text" name="title" placeholder="Category Title" required> </td>
                </tr>
                <tr>
                    <td> Select Image : </td>
                    <td> <input type="file" name="image"></td>
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
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <!-- Add Category form ends here -->
        <?php 

if(isset($_POST['submit']))
{
    //Button Clicked
    //echo "Buttton Clicked";
    //1.Get the data from Form
    $title = $_POST['title'];
    //For radio input type , we need to check whether the button is selected or not
    if(isset($_POST['featured']))
    {
        //Get the value
        $featured = $_POST['featured'];
    }else{
        //Set the default value
        $featured = "No";
    }
    if(isset($_POST['active']))
    {
        //Get the value
        $active = $_POST['active'];
    }else{
        //Set the default value
        $active = "No";
    }
    // Check Whether the image is selected or not and set the value for image accordingly
    //print_r($_FILES['image']);
    //die(); // Break the code here
    if(isset($_FILES['image']['name'])){
        //Upload the image 
        //To upload the image we need image name , source path and destination path
        $image_name = $_FILES['image']['name'];
        //Auto rename image to avoid replace having the same image name
        //Get the extension of the image e.g. food1.png
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
            header("location:".SITEURL.'admin/add-category.php');
            //Stop the process
            die();
        }
        
    }else{
        //Don't upload the image and set the image name as blank
        $image_name="";
    }
    
    //2. SQL query to insert database
    $sql = "INSERT INTO tbl_category SET
    title='$title',
    image_name = '$image_name',
    featured='$featured',
    active='$active' ";

    //3. Execute the query
    $res = mysqli_query($conn,$sql);
    if($res==true){
        //Query executed
        $_SESSION['add-cat'] = "<div class='btn-primary text-center'><br>Category Added Successful <br></div>";   
        header("location:".SITEURL.'admin/manage-category.php');
    }else{
        //Failed
        $_SESSION['add-cat'] = "<div class='btn-secondary text-center'> <br> Failed to add Category <br></div>";   
        header("location:".SITEURL.'admin/add-category.php');
    }

}
else{
    //Button Not Clicked
    //echo "Buttton Not Clicked";
} ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>