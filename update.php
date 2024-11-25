<?php
include 'connect.php';

// Kiểm tra 'stt' từ URL
$stt = isset($_GET['stt']) ? intval($_GET['stt']) : 0;

if ($stt > 0) {
    // Sử dụng prepared statement để lấy thông tin sinh viên
    $stmt = $conn->prepare("SELECT * FROM sinhvien WHERE stt = ?");
    $stmt->bind_param("i", $stt);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if (!$student) {
        echo "<script>alert('Sinh viên không tồn tại!'); window.location.href = 'danhsach.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID không hợp lệ!'); window.location.href = 'danhsach.php';</script>";
    exit;
}

// Xử lý khi cập nhật
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_sv = trim($_POST['ma_sv']);
    $hoten = trim($_POST['hoten']);
    $ngaysinh = trim($_POST['ngaysinh']);
    $email = trim($_POST['email']);
    $sdt = trim($_POST['sdt']);
    $diachi = trim($_POST['diachi']);

    if ($ma_sv && $hoten && $ngaysinh && $email && $sdt && $diachi) {
        // Sử dụng prepared statement để cập nhật thông tin
        $stmt = $conn->prepare("UPDATE sinhvien SET ma_sv = ?, hoten = ?, ngaysinh = ?, email = ?, sdt = ?, diachi = ? WHERE stt = ?");
        $stmt->bind_param("ssssssi", $ma_sv, $hoten, $ngaysinh, $email, $sdt, $diachi, $stt);

        if ($stmt->execute()) {
            echo "<script>alert('Cập nhật thành công!'); window.location.href = 'danhsach.php';</script>";
        } else {
            echo "<script>alert('Lỗi khi cập nhật: " . $stmt->error . "');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Cập nhật thông tin sinh viên</h2>
        <form action="" method="post">
            <div class="form-group">
                <label>Mã sinh viên:</label>
                <input type="text" name="ma_sv" value="<?php echo htmlspecialchars($student['ma_sv']); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Họ tên:</label>
                <input type="text" name="hoten" value="<?php echo htmlspecialchars($student['hoten']); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Ngày sinh:</label>
                <input type="date" name="ngaysinh" value="<?php echo htmlspecialchars($student['ngaysinh']); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <input type="text" name="sdt" value="<?php echo htmlspecialchars($student['sdt']); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Địa chỉ:</label>
                <input type="text" name="diachi" value="<?php echo htmlspecialchars($student['diachi']); ?>" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="danhsach.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
