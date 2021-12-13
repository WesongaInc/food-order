<?php $pageTitle = "Admin >> Food Ordering and Restaurant Booking System"; include("partials/menu.php"); ?>

        <!-- Main Content Section Starts --->
        <div class="main-content">
        <div class="wrapper">
      <?php 
    if(isset($_SESSION['add'])){
        echo $_SESSION['add']; // Displaying Session Message
        unset($_SESSION['add']); // Removing Session Message
    }
    if(isset($_SESSION['delete'])){
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }
    if(isset($_SESSION['update'])){
        echo $_SESSION['update']; 
        unset($_SESSION['update']);
    }
    if(isset($_SESSION['user-not-found'])){
        echo $_SESSION['user-not-found']; 
        unset($_SESSION['user-not-found']);
    }
?>
            <h1>Manage Admin</h1>


    <!-- Button to Add Admin Starts-->
    <br><a href="add-admin.php" class="btn-secondary">Add Admin</a> <br><br>
    <!-- Button to Add Admin  Ends-->
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full name</th>
                    <th>username</th>
                    <th>Actions</th>
                </tr>

                <?php 
                // query to get all admin from tbl-admin
                $sql = "SELECT * FROM tbl_admin";
                //Execute the query
                $res = mysqli_query($conn,$sql);
                //Check whether the query is executed or not
                if($res==TRUE)
                {
                    //1.Count Rows to check whether we have data in database or not
                    $count = mysqli_num_rows($res); // Function to get all the rows in database
                    $sn = 1; //Create a variable and assign the value for serial number
                    //2. Check the number of rows
                    if($count>0){
                        //We have data in database
                        while($rows=mysqli_fetch_assoc($res)){
                            //$rows=mysqli_fetch_assoc($res) will fetch the data of rows
                            //Using while loop to get all data from database
                            //This while loop will run as long as we have data in database

                            //Get Individual data $ declares variable and 'inside this column names are placed'
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                            //Display the value in tbl_admin Table
                            ?>
                            <!-- Html Part Starts for Table -->
                            <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $full_name; ?></td>
                    <td><?php echo $username; ?></td>
                    <td>
                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-primary">Update Admin</a>
                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-third">Change Password</a>
                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a> 
                    </td>
                </tr>
                            <!-- Html Part Starts for Table -->

                            <?php

                        }
                    }else{
                        //We don't have data in database
                        echo "No Admin Added";
                    }

                }


                ?>
            </table>
            </div>
        </div>
        <!-- Main Content Section Ends --->

<?php include('partials/footer.php'); ?>