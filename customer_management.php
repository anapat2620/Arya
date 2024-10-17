<?php
session_start();
include("connectdb.php");

// Fetch customer data from the database
$sql = "SELECT * FROM `customer`";
$result = mysqli_query($conn, $sql);
$customers = []; // สร้างอาร์เรย์เพื่อเก็บข้อมูลลูกค้า

while ($row = mysqli_fetch_assoc($result)) {
    $customers[] = $row; // เพิ่มข้อมูลลูกค้าในอาร์เรย์
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Type Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">Customer Management</h2>
    <div class="text-right mb-3">
        <a href="add_customer.php" class="btn btn-success">เพิ่ม</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>รหัสลูกค้า</th>
                <th>ชื่อ-นามสกุล</th>
                <th>เพศ</th>
                <th>วันเกิด</th>
                <th>อีเมล</th>
                <th>เบอร์โทรศัพท์</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?php echo htmlspecialchars($customer['c_id']); ?></td>
                    <td><?php echo htmlspecialchars($customer['c_name']); ?></td>
                    <td><?php echo htmlspecialchars($customer['gender']); ?></td>
                    <td><?php echo htmlspecialchars($customer['c_dob']); ?></td>
                    <td><?php echo htmlspecialchars($customer['c_email']); ?></td>
                    <td><?php echo htmlspecialchars($customer['c_phone']); ?></td>
                    <td>
                        <a href="customer_edit.php?id=<?php echo $customer['c_id']; ?>" class="btn btn-warning">แก้ไข</a> 
                        <a href="customer_delete.php?id=<?php echo $customer['c_id']; ?>" class="btn btn-danger" onclick="return confirm('คุณแน่ใจหรือไม่ว่าจะลบลูกค้านี้?');">ลบ</a>
                    </td>>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<div class="container mt-4">
    <div class="text-left mb-3">
        <a href="index_admin.php" class="btn btn-success">Back</a>
    </div>
    </div>
<?php
// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
<footer style="display: flex; justify-content: center; align-items: center; height: 60px;">
    <p>&copy;2024 Anchisa Novel.</p>
</footer>
