<?php
session_start();
include("connectdb.php"); // รวมไฟล์เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่ง id ของลูกค้าหรือไม่
if (isset($_GET['id'])) {
    $c_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // ดึงข้อมูลลูกค้าที่จะทำการแก้ไข
    $sql = "SELECT * FROM customer WHERE c_id = '$c_id'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $customer = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('ไม่พบลูกค้าที่ระบุ'); window.location.href='customer_management.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ไม่มีการระบุ ID ของลูกค้า'); window.location.href='customer_management.php';</script>";
    exit();
}

// ตรวจสอบว่ามีการส่งฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $c_name = mysqli_real_escape_string($conn, $_POST['c_name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $bday = mysqli_real_escape_string($conn, $_POST['bday']);
    $c_email = mysqli_real_escape_string($conn, $_POST['c_email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    
    // อัปเดตข้อมูลลูกค้า
    $update_sql = "UPDATE customer SET c_name='$c_name', gender='$gender', c_dob='$bday', c_email='$c_email', c_address='$address', c_phone='$phone' WHERE c_id='$c_id'";
    
    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['success'] = "ข้อมูลลูกค้าได้รับการอัปเดตเรียบร้อยแล้ว";
        header("location: customer_management.php");
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
            <label for="c_name">ชื่อ-นามสกุล</label>
            <input type="text" class="form-control" id="c_name" name="c_name" value="<?php echo htmlspecialchars($customer['c_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="gender">เพศ</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="ชาย" <?php echo ($customer['gender'] == 'ชาย') ? 'selected' : ''; ?>>ชาย</option>
                <option value="หญิง" <?php echo ($customer['gender'] == 'หญิง') ? 'selected' : ''; ?>>หญิง</option>
                <option value="อื่นๆ" <?php echo ($customer['gender'] == 'อื่นๆ') ? 'selected' : ''; ?>>อื่นๆ</option>
            </select>
        </div>
        <div class="form-group">
            <label for="bday">วันเกิด</label>
            <input type="date" class="form-control" id="bday" name="bday" value="<?php echo htmlspecialchars($customer['c_dob']); ?>" required>
        </div>
        <div class="form-group">
            <label for="c_email">อีเมล</label>
            <input type="email" class="form-control" id="c_email" name="c_email" value="<?php echo htmlspecialchars($customer['c_email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="address">ที่อยู่</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($customer['c_address']); ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">เบอร์โทรศัพท์</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($customer['c_phone']); ?>" required>
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
