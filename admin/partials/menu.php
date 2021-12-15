        <!-- Database Connection Starts --->
        <?php include('../config/constants.php'); ?>
        <!-- Database Connection Ends --->
        <!-- Authorization Check Starts --->
        <?php include('login-check.php'); ?>
        <!-- Authorization Check Ends --->
        
<html>
    <head>
    <title>
   <?php if (isset($pageTitle)) {
       echo $pageTitle;
   } else {
       echo "Admin Panel > Food Ordering and Restaurant Booking System ";
   }?>
</title>

        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="wrapper">
            <h1 class="text-center adminHead">Admin Panel</h1>
        </div>
        <!-- Menu Section Starts --->
        <div class="menu text-center">
            <div class="wrapper">
            <ul>
                <li><a href="../admin/index.php">Dashboard</a></li>
                <li><a href="<?php echo SITEURL; ?>">Visit Website</a></li>
                <li><a href="../admin/manage-admin.php">Admin</a></li>
                <li><a href="../admin/manage-category.php">Category</a></li>
                <li><a href="../admin/manage-food.php">Food</a></li>
                <li><a href="../admin/manage-order.php">Order</a></li>
                <li class="btn-primary"><a href="../admin/index.php"><?php echo $_SESSION['user']; ?></a></li>
                <li><a href="../admin/logout.php">LogOut</a></li>


            </ul>
            </div>
        </div>
        <!-- Menu Section Ends --->

