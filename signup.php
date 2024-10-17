<?php
session_start();
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            max-width: 500px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Customer Singup</h2>
    
    <?php
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    ?>

    <form action="customer_register.php" method="POST">
        <div class="form-group">
            <label for="c_name">ชื่อ-นามสกุล</label>
            <input type="text" class="form-control" name="c_name" required>
        </div>
        <div class="form-group">
            <label for="gender">เพศ</label>
            <select class="form-control" name="gender" required>
                <option value="">เลือกเพศ</option>
                <option value="male">ชาย</option>
                <option value="female">หญิง</option>
                <option value="other">อื่น ๆ</option>
            </select>
        </div>
        <div class="form-group">
            <label for="bday">วันเกิด</label>
            <input type="date" class="form-control" name="bday" required>
        </div>
        <div class="form-group">
            <label for="email">อีเมล</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="address">ที่อยู่</label>
            <textarea class="form-control" name="address" required></textarea>
        </div>
        <div class="form-group">
            <label for="phone">หมายเลขโทรศัพท์</label>
            <input type="text" class="form-control" name="phone" required>
        </div>
        <div class="form-group">
            <label for="password">รหัสผ่าน</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
            <label for="c_password">ยืนยันรหัสผ่าน</label>
            <input type="password" class="form-control" name="c_password" required>
        </div>
        <button type="submit" name="signup" class="btn btn-primary btn-block">สมัครสมาชิก</button>
    </form>
    <p class="text-center mt-3">มีบัญชีแล้ว? <a href="login.php">เข้าสู่ระบบ</a></p>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
