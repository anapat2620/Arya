<?php
session_start();
include("connectdb.php"); // รวมไฟล์เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่งฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $pt_id = mysqli_real_escape_string($conn, $_POST['pt_id']);
    $pt_name = mysqli_real_escape_string($conn, $_POST['pt_name']);
    
    // ตรวจสอบว่าชื่อประเภทสินค้าถูกกรอกหรือไม่
    if (!empty($pt_name)) {
        // เพิ่มประเภทสินค้าใหม่
        $sql = "INSERT INTO product_type (pt_id, pt_name) VALUES ('$pt_id', '$pt_name')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('เพิ่มประเภทสินค้าเรียบร้อยแล้ว'); window.location.href='product_type_management.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('กรุณากรอกชื่อประเภทสินค้า');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มประเภทสินค้า</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">เพิ่มประเภทสินค้า</h2>
    
    <form method="post" action="">
        <div class="form-group">
            <label for="pt_id">ID</label>
            <input type="text" class="form-control" id="pt_id" name="pt_id" required>
        </div>
        <div class="form-group">
            <label for="pt_name">ชื่อประเภทสินค้า</label>
            <input type="text" class="form-control" id="pt_name" name="pt_name" required>
        </div>
        
        <button type="submit" class="btn btn-success">บันทึก</button>
        <a href="product_type_management.php" class="btn btn-secondary">ยกเลิก</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
