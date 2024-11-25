<?php
include 'connect.php';

// Kiểm tra xem 'ma_sv' có tồn tại trong URL hay không
if (isset($_GET['ma_sv'])) {
    $ma_sv = $_GET['ma_sv'];

    // Xóa điểm của sinh viên từ bảng 'diem'
    $stmt1 = $conn->prepare("DELETE FROM diem WHERE ma_sv = ?");
    $stmt1->bind_param("s", $ma_sv);

    if ($stmt1->execute()) {
        // Sau khi xóa điểm, xóa sinh viên từ bảng 'sinhvien'
        $stmt2 = $conn->prepare("DELETE FROM sinhvien WHERE ma_sv = ?");
        $stmt2->bind_param("s", $ma_sv);

        if ($stmt2->execute()) {
            echo "<script>
                    alert('Đã xóa sinh viên và các điểm liên quan thành công!');
                    window.location.href = 'danhsach.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Lỗi khi xóa sinh viên: " . $stmt2->error . "');
                    window.location.href = 'danhsach.php';
                  </script>";
        }
        $stmt2->close();
    } else {
        echo "<script>
                alert('Lỗi khi xóa điểm: " . $stmt1->error . "');
                window.location.href = 'danhsach.php';
              </script>";
    }

    $stmt1->close();
} else {
    echo "<script>
            alert('Mã sinh viên không hợp lệ!');
            window.location.href = 'danhsach.php';
          </script>";
}

$conn->close();
?>
