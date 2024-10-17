<?php
// เริ่มต้นเซสชัน
session_start();
include("connectdb.php"); // รวมไฟล์เชื่อมต่อฐานข้อมูล

// ค้นหาสินค้า
$search_query = "";
if (isset($_POST['search'])) {
    $search_query = mysqli_real_escape_string($conn, $_POST['search']);
}

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">Product Management</h2>

    <!-- ฟอร์มค้นหา -->
    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <form method="post" action="">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="ค้นหาชื่อสินค้า" value="<?= htmlspecialchars($search_query); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">ค้นหา</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="text-right mb-3">
        <a href="add_product.php" class="btn btn-success">เพิ่มสินค้า</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>ชื่อสินค้า</th>
                <th>รายละเอียด</th>
                <th>ราคา</th>
                <th>ภาพ</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // ค้นหาหรือดึงข้อมูลสินค้าจากฐานข้อมูล
            if (!empty($search_query)) {
                $sql = "SELECT * FROM product WHERE p_name LIKE '%$search_query%'";
            } else {
                $sql = "SELECT * FROM product";
            }

            $result = mysqli_query($conn, $sql);
            while ($data = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?= $data['p_id']; ?></td>
                <td><?= $data['p_name']; ?></td>
                <td><?= $data['p_detail']; ?></td>
                <td><?= number_format($data['p_price'], 2); ?> บาท</td>
                <td><img src="images/<?= $data['p_picture']; ?>" width="100" alt="<?= $data['p_name']; ?>"></td>
                <td>
                    <a href="edit_product.php?id=<?= $data['p_id']; ?>" class="btn btn-warning">แก้ไข</a>
                    <a href="delete_product.php?id=<?= $data['p_id']; ?>" class="btn btn-danger" onclick="return confirm('คุณแน่ใจว่าต้องการลบสินค้านี้หรือไม่?');">ลบ</a>
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

