<?php
session_start();
include("connectdb.php"); // รวมไฟล์เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่ง ID ของสินค้าหรือไม่
if (isset($_GET['id'])) {
    $p_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // ดึงข้อมูลสินค้าที่จะทำการแก้ไข
    $sql = "SELECT * FROM product WHERE p_id = '$p_id'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('ไม่พบสินค้าที่ระบุ'); window.location.href='product_management.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ไม่มีการระบุ ID ของสินค้า'); window.location.href='product_management.php';</script>";
    exit();
}

// ตรวจสอบว่ามีการส่งฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $p_name = mysqli_real_escape_string($conn, $_POST['p_name']);
    $p_detail = mysqli_real_escape_string($conn, $_POST['p_detail']);
    $p_price = mysqli_real_escape_string($conn, $_POST['p_price']);
    $p_type = mysqli_real_escape_string($conn, $_POST['p_type']);
    
    // อัปโหลดรูปภาพ
    $p_picture = '';
    if (isset($_FILES['p_picture']) && $_FILES['p_picture']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/"; // โฟลเดอร์ที่จะเก็บไฟล์รูปภาพ
        $p_picture = $target_dir . basename($_FILES["p_picture"]["name"]);
        
        // อัปโหลดไฟล์
        if (move_uploaded_file($_FILES["p_picture"]["tmp_name"], $p_picture)) {
            // ถ้าการอัปโหลดไฟล์สำเร็จ
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ');</script>";
            $p_picture = $product['p_picture']; // ถ้าอัปโหลดไม่สำเร็จให้ใช้รูปเก่า
        }
    } else {
        $p_picture = $product['p_picture']; // ใช้รูปเดิมถ้าไม่มีการอัปโหลดใหม่
    }
    
    // อัปเดตข้อมูลสินค้า
    $update_sql = "UPDATE product SET p_name='$p_name', p_detail='$p_detail', p_price='$p_price', p_picture='$p_picture', p_type='$p_type' WHERE p_id='$p_id'";
    
    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['success'] = "ข้อมูลสินค้าถูกอัปเดตเรียบร้อยแล้ว";
        header("location: product_management.php");
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
    <title>แก้ไขข้อมูลสินค้า</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">แก้ไขข้อมูลสินค้า</h2>
    
    <form method="post" action="" enctype="multipart/form-data"> <!-- เพิ่ม enctype สำหรับการอัปโหลดไฟล์ -->
        <div class="form-group">
            <label for="p_name">ชื่อสินค้า</label>
            <input type="text" class="form-control" id="p_name" name="p_name" value="<?php echo htmlspecialchars($product['p_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="p_detail">รายละเอียดสินค้า</label>
            <input type="text" class="form-control" id="p_detail" name="p_detail" value="<?php echo htmlspecialchars($product['p_detail']); ?>" required>
        </div>
        <div class="form-group">
            <label for="p_price">ราคาสินค้า</label>
            <input type="text" class="form-control" id="p_price" name="p_price" value="<?php echo htmlspecialchars($product['p_price']); ?>" required>
        </div>
        <div class="form-group">
            <label for="p_picture">รูปภาพ</label>
            <input type="file" class="form-control-file" id="p_picture" name="p_picture">
            <small class="form-text text-muted">หากไม่ต้องการเปลี่ยนรูปภาพ ให้เว้นว่างไว้</small>
        </div>
        <div class="form-group">
            <label for="p_type">ประเภท</label>
            <input type="text" class="form-control" id="p_type" name="p_type" value="<?php echo htmlspecialchars($product['p_type']); ?>" required>
        </div>       
        <button type="submit" class="btn btn-success">บันทึก</button>
        <a href="product_management.php" class="btn btn-secondary">ยกเลิก</a>
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
