<?php
session_start();
include("connectdb.php"); // เชื่อมต่อฐานข้อมูล

// ดึงข้อมูลคำสั่งซื้อจากฐานข้อมูล
$sql = "SELECT * FROM orders_detail";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail Management - Anchisa Novel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Order Detail Management</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>รหัสคำสั่งซื้อ</th>
                    <th>ยอดรวม (บาท)</th>
                    <th>รหัสสินค้า</th>
                    <th>จำนวน</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['oid']; ?></td>
                        <td><?= $row['od_id']; ?></td>
                        <td><?= $row['pid']; ?></td>
                        <td><?= $row['item']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<div class="container mt-4">
    <div class="text-left mb-3">
        <a href="index_admin.php" class="btn btn-success">Back</a>
    </div>
    </div>
<?php
// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
<footer style="display: flex; justify-content: center; align-items: center; height: 60px;">
    <p>&copy;2024 Anchisa Novel.</p>
</footer>
