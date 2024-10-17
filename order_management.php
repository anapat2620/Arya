<?php
session_start();
include("connectdb.php"); // เชื่อมต่อฐานข้อมูล

// ลบคำสั่งซื้อ
if (isset($_GET['delete'])) {
    $order_id = $_GET['delete'];
    $sql_delete = "DELETE FROM orders WHERE order_id = '$order_id'";
    if (mysqli_query($conn, $sql_delete)) {
        echo "<script>alert('ลบคำสั่งซื้อสำเร็จ'); window.location.href='order_management.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการลบ');</script>";
    }
}

// ดึงข้อมูลคำสั่งซื้อจากฐานข้อมูล
$sql = "SELECT * FROM orders";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management - Anchisa Novel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Order Management</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>รหัสคำสั่งซื้อ</th>
                    <th>ยอดรวม (บาท)</th>
                    <th>วันที่สั่งซื้อ</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['oid']; ?></td>
                        <td><?= number_format($row['ototal'], 2); ?> บาท</td>
                        <td><?= $row['odate']; ?></td>
                        <td>
                            <a href="#order_detail_management.php?order_id=<?= $row['oid']; ?>" class="btn btn-warning btn-sm">ดูเพิ่มเติม</a>
                        </td>
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
