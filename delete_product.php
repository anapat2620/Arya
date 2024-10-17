<?php
session_start();
include("connectdb.php"); // รวมไฟล์เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่ง id ของลูกค้าหรือไม่
if (isset($_GET['id'])) {
    $p_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // ลบข้อมูลลูกค้า
    $sql = "DELETE FROM product WHERE p_id = '$p_id'";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "ข้อมูลลูกค้าได้รับการลบเรียบร้อยแล้ว";
        header("location: product_management.php");
        exit();
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาด: " . mysqli_error($conn);
        header("location: product_management.php");
        exit();
    }
} else {
    $_SESSION['error'] = "ไม่มีการระบุ ID ของลูกค้า";
    header("location: product_management.php");
    exit();
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>