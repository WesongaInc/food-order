<?php $pageTitle = " Food > Admin > Food Ordering and Restaurant Booking System"; include("partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food Page</h1><br>
        <?php 
        if(isset($_SESSION['add-food']))
        {
            echo $_SESSION['add-food'];
            unset($_SESSION['add-food']);
        }if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
         ?><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title : </td>
                    <td><input type="text" name="title" placeholder="Title of Food" required> </td>
                </tr>
                <tr>
                    <td>Description : </td>
                    <td><textarea name="description"  cols="30" rows="5" placeholder="Description of the Food"></textarea> </td>
                </tr>
                <tr>
                    <td>Price : </td>
                    <td><input type="number" placeholder="Price of the Food" name="price"> Taka</td>
                </tr>
                <tr>
                    <td> Select Image : </td>
                    <td> <input type="file" name="image"></td>
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
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-third">
                    </td>
                </tr>

            </table>
        </form>
        <?php 
        if(isset($_POST['submit'])){
            //1.Get the data from form 
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                //For radio input type , we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }else{
                    $featured = "No";
                }
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }else{
                    $active = "No";
                }

            //2.Upload the image if selected
            if(isset($_FILES['image']['name'])){
                $image_name = $_FILES['image']['name'];

                if($image_name!=""){
                    $ext = end(explode('.',$image_name));
                    //Rename the image
                    $image_name = "Food-Name-".rand(0000,9999).'.'.$ext; 
                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../images/food/".$image_name;
                    //Finally upload the image
                    $upload = move_uploaded_file($src,$dst);
                    //Check whether the image is uploaded or not
                    // If the image is not uploaded then we will stop the process and redirect with error message
                    if($upload==false){
                        //Set message
                        $_SESSION['upload'] = "<div class='btn-secondary text-center'> <br> Failed to upload image<br></div>";   
                        header("location:".SITEURL.'admin/add-food.php');
                        //Stop the process
                        die();
                    }
                }    
                
            }else{
                //Don't upload the image and set the image name as blank
                $image_name="";
            }

            //3.Insert into Database 
            // For numerical value we donot need to pass value inside quotes
            //But for string it is compulsory to add quotes
            //A. SQL query to save or add food
            $sql2 =" INSERT INTO tbl_food SET
            title='$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id= $category,
            featured='$featured',
            active='$active' ";
            //B.Execute the query
            $res2 = mysqli_query($conn,$sql2);
            //C.Check Data inserted or not
            if($res2==true){
                // Data Inserted Successfully
                $_SESSION['add-food'] = "<div class='btn-primary text-center'><br>Food Added Successful <br></div>";   
                header("location:".SITEURL.'admin/manage-food.php');
            }else{
                //Failed
                $_SESSION['add-food'] = "<div class='btn-secondary text-center'> <br> Failed to Add Food <br></div>";   
                header("location:".SITEURL.'admin/manage-food.php');
            }

            //4.Redirect with message to manage food page
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>