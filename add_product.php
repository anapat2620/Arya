<?php
session_start();
include("connectdb.php"); // รวมไฟล์เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่งฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $p_id = mysqli_real_escape_string($conn, $_POST['p_id']);
    $p_name = mysqli_real_escape_string($conn, $_POST['p_name']);
    $p_detail = mysqli_real_escape_string($conn, $_POST['p_detail']);
    $p_price = mysqli_real_escape_string($conn, $_POST['p_price']);
    $p_type = mysqli_real_escape_string($conn, $_POST['p_type']);

    // อัปโหลดรูปภาพ
    $p_picture = '';
    if (isset($_FILES['p_picture']) && $_FILES['p_picture']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "images/"; // โฟลเดอร์ที่จะเก็บไฟล์รูปภาพ
        $p_picture = $target_dir . basename($_FILES["p_picture"]["name"]);

        // อัปโหลดไฟล์
        if (move_uploaded_file($_FILES["p_picture"]["tmp_name"], $p_picture)) {
            // ถ้าการอัปโหลดไฟล์สำเร็จ
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ');</script>";
        }
    } else {
        echo "<script>alert('กรุณาเลือกไฟล์รูปภาพ');</script>";
    }

    // อัปเดตข้อมูลสินค้า
    $insert_sql = "INSERT INTO product (p_id, p_name, p_detail, p_price, p_picture, p_type) VALUES ('$p_id','$p_name', '$p_detail', '$p_price', '$p_picture', '$p_type')";

    if (mysqli_query($conn, $insert_sql)) {
        $_SESSION['success'] = "ข้อมูลสินค้าถูกเพิ่มเรียบร้อยแล้ว";
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
    <title>เพิ่มข้อมูลสินค้า</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <h2 class="text-center">เพิ่มข้อมูลสินค้า</h2>

        <form method="post" action="" enctype="multipart/form-data"> <!-- เพิ่ม enctype สำหรับการอัปโหลดไฟล์ -->
            <div class="form-group">
                <label for="p_id">ID</label>
                <input type="text" class="form-control" id="p_id" name="p_id" required>
            </div>
            <div class="form-group">
                <label for="p_name">ชื่อสินค้า</label>
                <input type="text" class="form-control" id="p_name" name="p_name" required>
            </div>
            <div class="form-group">
                <label for="p_detail">รายละเอียดสินค้า</label>
                <input type="text" class="form-control" id="p_detail" name="p_detail" required>
            </div>
            <div class="form-group">
                <label for="p_price">ราคาสินค้า</label>
                <input type="text" class="form-control" id="p_price" name="p_price" required>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label for="file-input" class=" form-control-label">Picture</label></div>
                <div class="col-12 col-md-9"><input type="file" id="file-input" name="p_picture" class="form-control-file"></div>
            </div>
            <div class="form-group">
                <label for="p_type">ประเภท</label>
                <input type="text" class="form-control" id="p_type" name="p_type" required>
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