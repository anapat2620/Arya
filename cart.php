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
error_reporting(E_NOTICE);

	@session_start();
	include("connectdb.php");
	$sql = "select * from product where p_id='{$_GET['id']}' ";
	$rs = mysqli_query($conn, $sql) ;
	$data = mysqli_fetch_array($rs);
	$id = $_GET['id'] ;
	
	if(isset($_GET['id'])) {
		$_SESSION['sid'][$id] = $data['p_id'];
		$_SESSION['sname'][$id] = $data['p_name'];
		$_SESSION['sprice'][$id] = $data['p_price'];
		$_SESSION['sdetail'][$id] = $data['p_detail'];
		$_SESSION['spicture'][$id] = $data['p_picture'];
		@$_SESSION['sitem'][$id]++;
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cart</title>
<link href="bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>
<blockquote>
<h2>Cart</h2>
<table width="100%" class="table">
	<tr>
		<th width="5%">No.</th>
		<th width="19%">Product image</th>
		<th width="24%">Name</th>
		<th width="14%">Price</th>
		<th width="15%">Quantity</th>
		<th width="14%">Total</th>
		<th width="9%">&nbsp;</th>
	</tr>
<?php
if(!empty($_SESSION['sid'])) {
	foreach($_SESSION['sid'] as $pid) {
		@$i++;
		$sum[$pid] = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid] ;
		@$total += $sum[$pid] ;
?>
	<tr>
		<td><?=$i;?></td>
		<td><img src="images/<?=$_SESSION['spicture'][$pid];?>" width="120"></td>
		<td><?=$_SESSION['sname'][$pid];?></td>
		<td><?=number_format($_SESSION['sprice'][$pid],0);?></td>
		<td> <?=$_SESSION['sitem'][$pid];?></td>
		<td><?=number_format($sum[$pid],0);?></td>
		<td><a href="clear2.php?id=<?=$pid;?>" class="btn btn-danger">Delete</a></td>
	</tr>
<?php } // end foreach ?>
	<tr>
		<td colspan="5" align="right"><strong>SubTotal</strong> &nbsp; </td>
		<td><strong><?=number_format($total,0);?></strong></td>
		<td><strong>Baht</strong></td>
	</tr>
<?php 
} else {
?>
	<tr>
		<td colspan="7" height="50" align="center">There are no products in the cart.</td>
	</tr>
<?php } // end if ?>
</table>
<a href="product.php" class="btn btn-primary">Back To Product</a>  
<a href="clear.php" class="btn btn-warning">Clear All</a> 
<?php
if(empty($_SESSION['sid'])) {
?>
<a href="#" class="btn btn-success" onClick="alert('Please select product');">Order</a> 
<?php } else { ?>
<a href="save.php" class="btn btn-success">Order</a>
<?php } ?>
</blockquote>
</body>
</html>
<br><br><br><br><br>
<footer style="display: flex; justify-content: center; align-items: center; height: 60px;">
    <p>&copy;2024 Anchisa Novel.</p>
</footer>



