<?php
// เริ่มต้นเซสชัน
session_start();
include("connectdb.php"); // รวมไฟล์เชื่อมต่อฐานข้อมูล
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Type Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">Product Type Management</h2>
    <div class="text-right mb-3">
        <a href="add_product_type.php" class="btn btn-success">เพิ่มประเภทสินค้า</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>ชื่อประเภทสินค้า</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // ดึงข้อมูลประเภทสินค้าจากฐานข้อมูล
            $sql = "SELECT * FROM product_type";
            $result = mysqli_query($conn, $sql);
            while ($data = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?= $data['pt_id']; ?></td>
                <td><?= $data['pt_name']; ?></td>
                <td>
                    <a href="edit_product_type.php?id=<?= $data['pt_id']; ?>" class="btn btn-warning">แก้ไข</a>
                    <a href="delete_product_type.php?id=<?= $data['pt_id']; ?>" class="btn btn-danger" onclick="return confirm('คุณแน่ใจว่าต้องการลบประเภทสินค้านี้หรือไม่?');">ลบ</a>
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
