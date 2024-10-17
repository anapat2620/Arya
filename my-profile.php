<?php
session_start();
require_once 'connectdb.php';

if (strlen($_SESSION['login']) == 0) {
    header('location:login.php');
} else {
    if (isset($_POST['update'])) {
        $name = $_POST['c_name'];
        $gender = $_POST['gender'];
        $bday = date('Y-m-d', strtotime($_POST['bday']));
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Anchisa Novel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #246fa5;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        nav {
            text-align: center;
            margin: 15px 0;
        }

        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #c9e3ed;
        }

        nav a:hover {
            color: #007BFF;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 30px;
            text-decoration: underline;
        }

        p {
            border: 2px solid gray;
            padding: 8px;
            border-radius: 15px;
            background-color: #f9f9f9;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        .buttons {
            text-align: center;
            margin-top: 20px;
        }

        .buttons a {
            text-decoration: none;
        }

        .cancelbtn {
            padding: 10px 20px;
            background-color: #246fa5;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .cancelbtn:hover {
            background-color: #007BFF;
        }

    </style>
</head>

<body>

<header>
    <h1>Anchisa Novel</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="product.php">Product</a>
        <a href="#">About Us</a>
        <a href="#admin_login.php">Admin</a>
        </nav>
</header>

<!-- Profile Section -->
<div class="container">
    <form action="" method="post">

        <h1>My Profile</h1>

        <?php
        // Fetch user data for profile
        $sql = "SELECT * FROM `customer` WHERE c_id ='" . $_SESSION['user_login'] . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>

        <!-- Display user information -->
        <label for="fname">Name:</label>
        <p><?= $row['c_name']; ?></p>

        <label for="gender">Gender:</label>
        <p><?= $row['gender']; ?></p>

        <label for="date">Date of Birth:</label>
        <p><?= $row['c_dob']; ?></p>

        <label for="address">Address:</label>
        <p><?= $row['c_address']; ?></p>

        <label for="phone">Phone Number:</label>
        <p><?= $row['c_phone']; ?></p>

        <label for="email">Email:</label>
        <p><?= $row['c_email']; ?></p>

        <!-- Action buttons -->
        <div class="buttons">
            <a href="index.php">
                <button type="button" class="cancelbtn">Back</button>
            </a>
            <a href="profile.php">
                <button type="button" class="cancelbtn">Update</button>
            </a>
        </div>
    </form>
</div>
</body>
</html>
<footer style="display: flex; justify-content: center; align-items: center; height: 60px;">
    &copy;2024 Anchisa Novel.
</footer>