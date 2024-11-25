<?php
include 'connect.php';

// Kiểm tra xem 'stt' có tồn tại trong URL và có hợp lệ không
if (isset($_GET['stt']) && is_numeric($_GET['stt'])) {
    $stt = $_GET['stt'];

    // Lấy mã sinh viên dựa trên 'stt'
    $stmt = $conn->prepare("SELECT ma_sv FROM sinhvien WHERE stt = ?");
    $stmt->bind_param("i", $stt);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ma_sv = $row['ma_sv'];

        // Hiển thị hộp thoại xác nhận
        echo "<script>
                if (confirm('Bạn có chắc chắn muốn xóa sinh viên này và tất cả điểm của họ?')) {
                    // Gửi yêu cầu xóa điểm và sinh viên
                    window.location.href = 'delete_confirm.php?ma_sv=$ma_sv';
                } else {
                    window.location.href = 'danhsach.php';
                }
              </script>";
    } else {
        echo "<script>
                alert('Không tìm thấy sinh viên!');
                window.location.href = 'danhsach.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID không hợp lệ!');
            window.location.href = 'danhsach.php';
          </script>";
}

$conn->close();
?>
