<?php $pageTitle = "Update Admin> Admin > Food Ordering and Restaurant Booking System"; include("partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <?php
    //1.Get the ID if Admin to be deleted
     $id = $_GET['id'];
    // echo $id = $_GET['id']; shows id using get method

    //2.Create SQL query to get Details
    $sql = "SELECT * FROM tbl_admin WHERE id=$id";
    //2.1: Execute the query
    $res = mysqli_query($conn,$sql);
    //2.2: Check whether the query is executed successfully or not
    if($res==TRUE)
    {
        $count = mysqli_num_rows($res);
        if($count==1){
            //We have data in database
            while($rows=mysqli_fetch_assoc($res)){
                $full_name = $rows['full_name'];
                $username = $rows['username'];} 
            }else {
        //2.2.1:Create Session Variable to Display Message
        $_SESSION['update'] = "<p class='btn-danger'>Admin Not Found , Try Again Later</p>";
        //2.2.2: Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    }
        ?>
        <form action="" method="post">
        <table class="tbl-30">
                <tr>
                    <td>Full Name : </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>

                <tr>
                    <td>Username : </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php 
//Process the Value from Form and Save it in Database
//Check Whether the submit button is clicked or not ?
if(isset($_POST['submit']))
{
    //Button Clicked
    //echo "Buttton Clicked";

    //1.Get the data from Form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $id = $_POST['id'];

    //2.SQL query to update the Admin data into the Database
    $sql = "UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username'
    WHERE id='$id'";
    //3.Execute Query and Update Data in Database 
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4. Whether the (Query is Executed ) Data is updated or not and display an appropriate message
    if($res==TRUE){
        //Create a session variable to display message .here add is a SESSION variable .
        $_SESSION['update']="<p class='btn-primary'>Admin Updated Successfully</p>";
        //Redirect Page to Manage Admin. A dot(.) is used to concatenate string value
        header("location:".SITEURL.'admin/manage-admin.php');
    } else{
        //Create a session variable to display message
        $_SESSION['add']="<p class='btn-danger'>Failed To Update Admin</p>";
        //Redirect Page to Manage Admin. A dot(.) is used to concatenate string value
        header("location:".SITEURL.'admin/add-admin.php');
    }

}
else{
    //Button Not Clicked
    //echo "Buttton Not Clicked";
}
?>

<?php include('partials/footer.php'); ?>
