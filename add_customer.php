<?php
session_start();
include("connectdb.php"); // รวมไฟล์เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่งฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $c_name = mysqli_real_escape_string($conn, $_POST['c_name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $bday = mysqli_real_escape_string($conn, $_POST['bday']);
    $c_email = mysqli_real_escape_string($conn, $_POST['c_email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // ตรวจสอบว่าข้อมูลถูกกรอกหรือไม่
    if (!empty($c_name) && !empty($gender) && !empty($bday) && !empty($c_email) && !empty($address) && !empty($phone)) {
        // เพิ่มลูกค้าใหม่
        $sql = "INSERT INTO customer (c_name, gender, c_dob, c_email, c_address, c_phone) 
                VALUES ('$c_name', '$gender', '$bday', '$c_email', '$address', '$phone')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('เพิ่มลูกค้าเรียบร้อยแล้ว'); window.location.href='customer_management.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มลูกค้า</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body>

    <div class="container mt-4">
        <h2 class="text-center">เพิ่มลูกค้าใหม่</h2>

        <form method="post" action="">
            <div class="form-group">
                <label for="c_name">ชื่อ-นามสกุล</label>
                <input type="text" class="form-control" id="c_name" name="c_name" required>
            </div>
            <div class="form-group">
                <label for="gender">เพศ</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="">เลือกเพศ</option>
                    <option value="male">ชาย</option>
                    <option value="female">หญิง</option>
                    <option value="other">อื่นๆ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bday">วันเกิด</label>
                <input type="date" class="form-control" id="bday" name="bday" required>
            </div>
            <div class="form-group">
                <label for="c_email">อีเมล</label>
                <input type="email" class="form-control" id="c_email" name="c_email" required>
            </div>
            <div class="form-group">
                <label for="address">ที่อยู่</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="phone">เบอร์โทรศัพท์</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>

            <button type="submit" class="btn btn-success">บันทึก</button>
            <a href="customer_management.php" class="btn btn-secondary">ยกเลิก</a>
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