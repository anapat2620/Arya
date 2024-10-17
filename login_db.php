<?php 
    session_start();
    require_once 'db.php';

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

      
        if (empty($email)) {
            $_SESSION['error'] = 'Please fill in email!';
            header("location: login.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = ' Incorrect email format!';
            header("location: login.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'Please fill in password';
            header("location: login.php");
        } else {
            try {

                $check_data = $conn->prepare("SELECT * FROM `customer` WHERE c_email = :email");
                $check_data->bindParam(":email", $email);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {      

                    if ($email == $row['c_email']) {
                        if (password_verify($password, $row['c_password'])) {
                            if ($row['urole'] == 'admin') {
                                $_SESSION['admin_login'] = $row['c_id'];
                                header("location: admin.php");
                            } else {
                                $_SESSION['login'] = $_POST['email'];
                                $_SESSION['user_login'] = $row['c_id'];
                                $_SESSION['user_name'] = $row['c_name'];
                                
                                
                                
                                header("location: index.php");
                            }
                        } else {
                            $_SESSION['error'] = 'Incorrect password!';
                            header("location: login.php");
                        }
                    } else {
                        $_SESSION['error'] = 'Incorrect email!';
                        header("location: login.php");
                    }

                } else {
                    $_SESSION['error'] = "No data in the system!";
                    header("location: login.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>