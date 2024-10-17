<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        header {
            background-color: #246fa5;
            color: white;
            padding: 10px 0;
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

        .text-center {
            text-align: center;
            /* จัดกลาง */
        }

        .login-container {
            margin-top: 100px;
        }

        footer {
            background-color: #246fa5;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* สำหรับรูปโลโก้ */
        footer img {
            margin-top: 10px;
        }
        
    </style>
</head>

<body>
    <header>
    <nav>
    <a href="index.php"><i class="fas fa-home"></i> Home</a>
</nav>
    </header>
    <div class="container login-container">
        <div class="text-center">
        <h2>Admin Login</h2>
        <br>
            <img src="images/logo-m.png" alt="Anchisa Shop" width="350px">
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="index_admin.php" method="post"> <!-- เปลี่ยนเป็น index_admin.php -->
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <p class="text-center mt-3">
                    <a href="#">Forgot Password?</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<footer>
</footer>