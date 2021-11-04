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
                <li><a href="../admin/manage-admin.php">Admin</a></li>
                <li><a href="../admin/manage-category.php">Category</a></li>
                <li><a href="../admin/manage-food.php">Food</a></li>
                <li><a href="../admin/manage-order.php">Order</a></li>

            </ul>
            </div>
        </div>
        <!-- Menu Section Ends --->