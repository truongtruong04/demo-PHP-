<?php
$servername = "127.0.0.1:8118";
$username = "root";
$password = "123456";
$db = "quanlysinhvien"; // Tên cơ sở dữ liệu của bạn

// Kết nối cơ sở dữ liệu
$conn = mysqli_connect($servername, $username, $password, $db);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Đảm bảo hiển thị tiếng Việt không bị lỗi
mysqli_set_charset($conn, "utf8");
?>
