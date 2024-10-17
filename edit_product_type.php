<?php
session_start();
include("connectdb.php"); // รวมไฟล์เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่ง id ของลูกค้าหรือไม่
if (isset($_GET['id'])) {
    $pt_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // ดึงข้อมูลลูกค้าที่จะทำการแก้ไข
    $sql = "SELECT * FROM product_type WHERE pt_id = '$pt_id'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $product_type = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('ไม่พบลูกค้าที่ระบุ'); window.location.href='product_type_management.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ไม่มีการระบุ ID ของลูกค้า'); window.location.href='product_type_management.php';</script>";
    exit();
}

// ตรวจสอบว่ามีการส่งฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $pt_name = mysqli_real_escape_string($conn, $_POST['pt_name']);

    
    // อัปเดตข้อมูลลูกค้า
    $update_sql = "UPDATE product_type SET pt_name='$pt_name' WHERE pt_id='$pt_id'";
    
    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['success'] = "ข้อมูลลูกค้าได้รับการอัปเดตเรียบร้อยแล้ว";
        header("location: product_type_management.php");
        exit();
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลลูกค้า</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">แก้ไขข้อมูลลูกค้า</h2>
    
    <form method="post" action="">
        <div class="form-group">
            <label for="pt_name">ชื่อ-นามสกุล</label>
            <input type="text" class="form-control" id="pt_name" name="pt_name" value="<?php echo htmlspecialchars($product_type['pt_name']); ?>" required>
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
