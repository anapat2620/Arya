<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #246fa5;
        }

        .sidebar a {
            color: white;
        }

        .sidebar a:hover {
            background-color: #8d6e63;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar p-3">
            <h3 class="text-center text-white">Admin</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="index_admin.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product_management.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product_type_management.php">Product Type</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order_management.php">Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customer_management.php">Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_login.php">Logout</a>
                </li>
            </ul>
        </nav>

       <!-- Main Content -->
<div class="container-fluid p-4">
    <h2 class="text-center">Welcome to Admin Dashboard</h2>
    <br><br>
    <div class="row">
        <?php
        include 'connectdb.php';
        // Fetch product count
        $sql = "SELECT COUNT(p_id) AS product_count FROM `product`";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $product_count = $row['product_count'];
        ?>

        <div class="col-xl-3 col-lg-6 mb-4">
            <div class="card" style="height: 160px;">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="stat-widget-one text-center">
                        <div class="stat-icon dib"><i class="ti-star text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Product</div>
                            <div class="stat-digit"><?= $product_count ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Fetch customer count
        $sql = "SELECT COUNT(c_id) AS customer_count FROM `customer`";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $customer_count = $row['customer_count'];
        ?>

        <div class="col-xl-3 col-lg-6 mb-4">
            <div class="card" style="height: 160px;">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="stat-widget-one text-center">
                        <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Customer</div>
                            <div class="stat-digit"><?= $customer_count ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Fetch orders count
        $sql = "SELECT COUNT(oid) AS orders_count FROM `orders`";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $orders_count = $row['orders_count'];
        ?>

        <div class="col-xl-3 col-lg-6 mb-4">
            <div class="card" style="height: 160px;">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="stat-widget-one text-center">
                        <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Orders</div>
                            <div class="stat-digit"><?= $orders_count ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- End Row -->
</div> <!-- End Container Fluid -->

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>