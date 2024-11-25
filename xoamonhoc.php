<?php
include 'connect.php';

if (isset($_GET['ma_mh'])) {
    $ma_mh = $_GET['ma_mh'];
    $stmt = $conn->prepare("DELETE FROM monhoc WHERE ma_mh = ?");
    $stmt->bind_param("s", $ma_mh);

    if ($stmt->execute()) {
        echo "<script>alert('Xóa môn học thành công!'); window.location.href = 'danhsachmonhoc.php';</script>";
    } else {
        echo "<script>alert('Lỗi: " . $stmt->error . "');</script>";
    }
}
?>
