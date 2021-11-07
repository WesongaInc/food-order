<?php $pageTitle = "Admin > Add New Admin> Food Ordering and Restaurant Booking System"; include("partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add New Admin</h1><br><br>
        <?php 
        // If we fail it will show the value that it failed
    if(isset($_SESSION['add'])){ //Checking whether the Session is set or not
        echo $_SESSION['add']; // Displaying Session Message
        unset($_SESSION['add']); // Removing Session Message
    }
?>
<br>
<br>
<br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name : </td>
                    <td><input type="text" name="full_name" placeholder="Enter Full Name"></td>
                </tr>

                <tr>
                    <td>Username : </td>
                    <td><input type="text" name="username" placeholder="Enter Username"></td>
                </tr>
                <tr>
                    <td>Password : </td>
                    <td><input type="password" name="password" placeholder="Enter Password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class=" btn-primary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
<?php include('partials/footer.php'); ?>

<?php 
//Process the Value from Form and Save it in Database
//Check Whether the submit button is clicked or not ?
if(isset($_POST['submit']))
{
    //Button Clicked
    //To check ==>> echo "Buttton Clicked";
    //1.Get the data from Form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //Password Encryption with MD5

    //2.SQL query to save the data into the Database
    $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
    ";
    //3.Execute Query and Save Data in Database 
    // include('../config/constants.php') -> included in menu.php for db connection
    // res takes results , if the query executed value will be true otherwise false
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4. Whether the (Query is Executed ) Data is iserted or not and display an appropriate message
    if($res==TRUE){
        //Data Inserted
        //echo "Data Inserted";
        //Create a session variable to display message .here add is a SESSION variable .
        $_SESSION['add']="<p class='btn-primary'>Admin Added Successfully</p>";
        //Redirect Page to Manage Admin. A dot(.) is used to concatenate string value
        header("location:".SITEURL.'admin/manage-admin.php');
    } else{
        //Failed to insert Data
        //echo "Failed to insert Data";
        //Create a session variable to display message
        $_SESSION['add']="<p class='btn-danger'>Failed To Add Admin</p>";
        //Redirect Page to Manage Admin. A dot(.) is used to concatenate string value
        header("location:".SITEURL.'admin/add-admin.php');
    }

}
else{
    //Button Not Clicked
    //To check ==>> echo "Buttton Not Clicked";
}
?>

