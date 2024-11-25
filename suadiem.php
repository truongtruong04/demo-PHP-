<?php
include 'connect.php';

// Kiểm tra sự tồn tại của 'ma_sv' và 'ma_mh'
if (isset($_GET['ma_sv'], $_GET['ma_mh'])) {
    $ma_sv = $_GET['ma_sv'];
    $ma_mh = $_GET['ma_mh'];

    // Lấy thông tin điểm hiện tại
    $stmt = $conn->prepare("
        SELECT diem.*, sinhvien.hoten, monhoc.ten_mh 
        FROM diem 
        JOIN sinhvien ON diem.ma_sv = sinhvien.ma_sv 
        JOIN monhoc ON diem.ma_mh = monhoc.ma_mh 
        WHERE diem.ma_sv = ? AND diem.ma_mh = ?
    ");
    $stmt->bind_param("ss", $ma_sv, $ma_mh);
    $stmt->execute();
    $result = $stmt->get_result();
    $diem = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $diem_gk = floatval($_POST['diem_gk']);
        $diem_ck = floatval($_POST['diem_ck']);

        // Cập nhật điểm
        $stmt = $conn->prepare("UPDATE diem SET diem_gk = ?, diem_ck = ? WHERE ma_sv = ? AND ma_mh = ?");
        $stmt->bind_param("ddss", $diem_gk, $diem_ck, $ma_sv, $ma_mh);

        if ($stmt->execute()) {
            echo "<script>alert('Cập nhật điểm thành công!'); window.location.href = 'danhsachdiem.php';</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra khi cập nhật điểm!');</script>";
        }
    }
} else {
    echo "<script>alert('Thông tin không hợp lệ!'); window.location.href = 'danhsachdiem.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa điểm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Sửa Điểm</h1>
        <form method="post">
            <div class="form-group">
                <label for="diem_gk">Điểm giữa kỳ</label>
                <input type="number" name="diem_gk" id="diem_gk" step="0.1" class="form-control" value="<?php echo htmlspecialchars($diem['diem_gk']); ?>" required>
            </div>
            <div class="form-group">
                <label for="diem_ck">Điểm cuối kỳ</label>
                <input type="number" name="diem_ck" id="diem_ck" step="0.1" class="form-control" value="<?php echo htmlspecialchars($diem['diem_ck']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="danhsachdiem.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
