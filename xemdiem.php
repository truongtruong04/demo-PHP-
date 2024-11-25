<?php
session_start();
include 'connect.php';

// Kiểm tra nếu chưa đăng nhập hoặc không phải sinh viên
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'sinhvien') {
    header("Location: login.php");
    exit;
}

// Lấy mã sinh viên từ session
$ma_sv = $_SESSION['ma_sv'];

$sql = "SELECT diem.*, monhoc.ten_mh 
        FROM diem 
        JOIN monhoc ON diem.ma_mh = monhoc.ma_mh 
        WHERE ma_sv = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ma_sv);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem điểm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Điểm của sinh viên</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Môn học</th>
                    <th>Điểm giữa kỳ</th>
                    <th>Điểm cuối kỳ</th>
                    <th>Điểm trung bình</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['ten_mh']); ?></td>
                        <td><?php echo htmlspecialchars($row['diem_gk']); ?></td>
                        <td><?php echo htmlspecialchars($row['diem_ck']); ?></td>
                        <td><?php echo htmlspecialchars($row['diem_tb']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="login.php" class="btn btn-primary">Đăng xuất</a>
    </div>
</body>
</html>
