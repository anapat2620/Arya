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

        $sql = "UPDATE `customer` SET `c_name` = '$name',
                                      `c_email` = '$email',
                                      `c_address` = '$address',
                                      `c_phone` = '$phone',
                                      `gender` = '$gender',
                                      `c_dob` = '$bday',
                                      `c_password` = '$passwordHash'
                WHERE c_id = '" . $_SESSION['user_login'] . "'";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('Your info has been updated');</script>";
            header('location:my-profile.php');
        } else {
            echo "Update failed: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update My Profile - Anchisa Novel</title>
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
            padding: 15px;
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

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .buttons {
            text-align: center;
        }

        button {
            padding: 10px 20px;
            background-color: #246fa5;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
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

<div class="container">
    <form action="" method="post">
        <h1>Update My Profile</h1>

        <!-- Display success and error messages -->
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['warning'])) { ?>
            <div class="alert alert-warning" role="alert">
                <?= $_SESSION['warning']; unset($_SESSION['warning']); ?>
            </div>
        <?php } ?>

        <?php
        // Fetch user data for profile
        $sql = "SELECT * FROM `customer` WHERE c_id ='" . $_SESSION['user_login'] . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>

        <!-- Profile Update Form -->
        <label for="c_name">Name</label>
        <input type="text" name="c_name" value="<?= $row['c_name']; ?>" required>

        <label for="gender">Gender</label>
        <input type="radio" name="gender" value="Male" <?= ($row['gender'] == 'Male') ? 'checked' : ''; ?>> Male
        <input type="radio" name="gender" value="Female" <?= ($row['gender'] == 'Female') ? 'checked' : ''; ?>> Female
<br>
        <label for="bday">Date of Birth</label>
        <input type="date" name="bday" value="<?= $row['c_dob']; ?>" required>

        <label for="address">Address</label>
        <textarea name="address" required><?= $row['c_address']; ?></textarea>

        <label for="phone">Phone Number</label>
        <input type="text" name="phone" value="<?= $row['c_phone']; ?>" required>

        <label for="email">Email</label>
        <input type="text" name="email" value="<?= $row['c_email']; ?>" required>

        <label for="password">New Password</label>
        <input type="password" name="password" id="passwordField" required>

        <label>
            <input type="checkbox" id="showPasswordCheckbox" onclick="togglePassword()"> Show Password
        </label>

        <div class="buttons">
            <button type="button" class="cancelbtn" onclick="window.location.href='index.php'">Cancel</button>
            <button type="submit" name="update" class="signupbtn">Update</button>
        </div>
    </form>
</div>

<script>
function togglePassword() {
    var passwordField = document.getElementById("passwordField");
    var checkbox = document.getElementById("showPasswordCheckbox");
    if (checkbox.checked) {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}
</script>
</body>
</html>
<footer style="display: flex; justify-content: center; align-items: center; height: 60px;">
    &copy;2024 Anchisa Novel.
</footer>
