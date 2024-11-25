<?php
include 'connect.php';

// Kiểm tra sự tồn tại và hợp lệ của 'ma_sv' và 'ma_mh'
if (isset($_GET['ma_sv'], $_GET['ma_mh'])) {
    $ma_sv = $_GET['ma_sv'];
    $ma_mh = $_GET['ma_mh'];

    // Chuẩn bị câu lệnh xóa
    $stmt = $conn->prepare("DELETE FROM diem WHERE ma_sv = ? AND ma_mh = ?");
    $stmt->bind_param("ss", $ma_sv, $ma_mh);

    // Thực thi câu lệnh và kiểm tra kết quả
    if ($stmt->execute()) {
        echo "<script>alert('Xóa điểm thành công!'); window.location.href = 'danhsachdiem.php';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra khi xóa điểm!'); window.location.href = 'danhsachdiem.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Thông tin không hợp lệ!'); window.location.href = 'danhsachdiem.php';</script>";
}

$conn->close();
?>
