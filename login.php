<?php
session_start();
include("connectdb.php"); // เชื่อมต่อฐานข้อมูล

// ตรวจสอบการส่งข้อมูลจากฟอร์ม
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // ตรวจสอบว่ามีผู้ใช้อยู่ในระบบหรือไม่
    $sql = "SELECT * FROM customers WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $row['password'])) {
            // ตั้งค่า session และเปลี่ยนเส้นทางไปยังหน้าแรก
            $_SESSION['c_id'] = $row['c_id'];
            $_SESSION['c_name'] = $row['c_name'];
            header("Location: index.php");
            exit();
        } else {
            $error = "รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        $error = "ชื่อผู้ใช้ไม่ถูกต้อง";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            max-width: 400px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #246fa5;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .cancelbtn {
            background-color: #f44336; /* สีแดงสำหรับปุ่ม Cancel */
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .signupbtn {
            background-color: #4CAF50; /* สีเขียวสำหรับปุ่ม Login */
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .cancelbtn:hover, .signupbtn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

<div class="login-container">
    <img src="images/logo-m.png" alt="Anchisa Shop" width="350px">
    <br>
    <p class="text-center">
        Login in or
        <a href="signup.php">Sign Up</a>
    </p>
    <form action="login_db.php" method="post">
        <label for="email">Email</label>
        <input type="text" placeholder="Enter your email..." name="email" required />
        
        <label for="psw">Password</label>
        <input type="password" placeholder="Enter your password..." name="password" required />

        <div class="buttons">
            <a href="index.php">
                <button type="button" class="cancelbtn">Cancel</button>
            </a>
            <button type="submit" name="login" class="signupbtn">Login</button>
        </div>
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
