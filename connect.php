<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "QuanLySinhVien"; // Tên cơ sở dữ liệu của bạn

// Kết nối cơ sở dữ liệu
$conn = mysqli_connect($servername, $username, $password, $db);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Đảm bảo hiển thị tiếng Việt không bị lỗi
mysqli_set_charset($conn, "utf8");
?>
