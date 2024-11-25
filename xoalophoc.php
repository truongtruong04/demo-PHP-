<?php
include 'connect.php';

$ma_lop = $_GET['ma_lop'];
$stmt = $conn->prepare("DELETE FROM lophoc WHERE ma_lop = ?");
$stmt->bind_param("s", $ma_lop);

if ($stmt->execute()) {
    echo "<script>alert('Xóa lớp học thành công!'); window.location.href = 'danhsachlophoc.php';</script>";
} else {
    echo "<script>alert('Lỗi: " . $stmt->error . "');</script>";
}
?>
