<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProductDetails - Anchisa Novel</title>
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
            color: #333;
        }

        nav a:hover {
            color: #007BFF;
        }

        section {
            padding: 20px;
            text-align: center;
        }
        .underline {
            text-decoration: underline;
            /* เพิ่มขีดเส้นใต้ */
        }

        .colored-text {
            color: #246fa5;
            /* เปลี่ยนเป็นสีที่คุณต้องการ */
        }
    </style>
</head>

<body>
    <header>
        <h1>Anchisa Novel</h1>
        <nav>
            <a href="index.php" style="color: #c9e3ed;">Home</a>
            <a href="product.php" style="color: #c9e3ed;">Product</a>
            <a href="#" style="color: #c9e3ed;">About Us</a>
            <a href="#admin_login.php" style="color: #c9e3ed;">Admin</a>
        </nav>
    </header>


    <?php
    include("connectdb.php");
    ?>
    <!doctype html>
    <html>
    <link href="bootstrap.css" rel="stylesheet" type="text/css">

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <meta charset="utf-8">
        <title>All Product</title>
        <style>
            h2 {
                text-align: center;
            }
        </style>
    </head>

    <br>

    <body>
        <p style="text-align: right;">
            <a href="cart.php" class="btn btn-success" style="margin-right: 20px;"> <!-- ปรับระยะห่างที่นี่ -->
                <i class="fas fa-shopping-cart"></i> <!-- ไอคอนรถเข็นจาก Font Awesome -->
            </a>
        </p>




        <a href="#product.php" style="margin-right: 15px; font-size: 18px; color: white;">All</a>
        <a href="product.php" style="margin-right: 15px; font-size: 18px;">All</a>
        <?php
        $sql2 = "select  *  from product_type ";
        $rs2 = mysqli_query($conn, $sql2);
        while ($data2 = mysqli_fetch_array($rs2, MYSQLI_BOTH)) {
        ?>
            <a href="product.php?pt=<?= $data2['pt_id']; ?>"
                style="margin-right: 15px; font-size: 18px;"><?= $data2['pt_name']; ?></a>
        <?php } ?>

        <br><br>
        <form class="form-inline text-right" action="product.php" method="post">
            <fieldset>
                <!-- Text input-->
                <div class="form-group">
                    <div class="col-md-4 mx-auto">
                        <input name="kw" type="text" placeholder="Search...." class="form-control input-md">
                    </div>
                </div>
                <!-- Button -->
                <div class="form-group">
                    <div class="col-md-4 mx-auto">
                        <button id="singlebutton" name="singlebutton" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </fieldset>
        </form>
        <br><br>

        <?php
        // เชื่อมต่อกับฐานข้อมูล
        include("connectdb.php");

        // รับค่า ID จาก URL
        $product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // ตรวจสอบว่ามี ID ที่ถูกต้องหรือไม่
        if ($product_id > 0) {
            // ดึงข้อมูลสินค้าจากฐานข้อมูล
            $sql = "SELECT * FROM product WHERE p_id = $product_id";
            $result = mysqli_query($conn, $sql);

            // ตรวจสอบว่าพบสินค้าที่มี ID นี้หรือไม่
            if (mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_array($result, MYSQLI_BOTH);
            } else {
                echo "ไม่พบสินค้าที่ต้องการ";
                exit;
            }
        } else {
            echo "ไม่มีสินค้าที่ระบุ";
            exit;
        }

        mysqli_close($conn);
        ?>

        <!DOCTYPE html>
        <html lang="th">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $data['p_name']; ?> - Product Detail</title>
            <link href="bootstrap.css" rel="stylesheet" type="text/css">
        </head>

        <body>
            <div class="container">
                <h1 class="text-center"></h1>
                <div class="row">
                    <div class="col-md-6">
                        <img src="images/<?= $data['p_picture']; ?>" width="400" alt="<?= $data['p_name']; ?>"
                            style="border: 5px solid #ddd; padding: 10px;">
                    </div>
                    <br><br>
                    <div class="col-md-6">
                        <h3><strong class="colored-text"><?= $data['p_name']; ?></strong></h3>
                        <h4 class="underline">Details</h4>
                        <p><?= $data['p_detail']; ?></p>
                        <br>
                        <h4>Price <?= number_format($data['p_price'], 0); ?> Baht</h4>
                        <br>
                        <a href="cart.php?id=<?= $data['p_id']; ?>" class="btn btn-success">Add To Cart</a>
                    </div>
                </div>
            </div>
        </body>

        </html>
    </body>

    </html>
</body>

</html>
<br><br><br><br><br>
<footer style="display: flex; justify-content: center; align-items: center; height: 60px;">
    <p>&copy;2024 Anchisa Novel.</p>
</footer>