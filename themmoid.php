<?php
include 'connect.php';

// Lấy danh sách sinh viên
$sql_sv = "SELECT ma_sv, hoten FROM sinhvien";
$result_sv = mysqli_query($conn, $sql_sv);

// Lấy danh sách môn học
$sql_mh = "SELECT ma_mh, ten_mh FROM monhoc";
$result_mh = mysqli_query($conn, $sql_mh);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_sv = trim($_POST['ma_sv']);
    $ma_mh = trim($_POST['ma_mh']);
    $diem_gk = floatval($_POST['diem_gk']);
    $diem_ck = floatval($_POST['diem_ck']);

    if ($ma_sv && $ma_mh && $diem_gk >= 0 && $diem_ck >= 0) {
        $stmt = $conn->prepare("INSERT INTO diem (ma_sv, ma_mh, diem_gk, diem_ck) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdd", $ma_sv, $ma_mh, $diem_gk, $diem_ck);

        if ($stmt->execute()) {
            echo "<script>alert('Thêm điểm thành công!'); window.location.href = 'danhsachdiem.php';</script>";
        } else {
            echo "<script>alert('Lỗi: " . $stmt->error . "');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin hợp lệ!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm điểm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Thêm Điểm Sinh Viên</h1>
        <form method="post">
            <!-- Dropdown Mã sinh viên -->
            <div class="form-group">
                <label for="ma_sv">Mã sinh viên</label>
                <select name="ma_sv" id="ma_sv" class="form-control" required>
                    <option value="">Chọn mã sinh viên</option>
                    <?php while ($row_sv = mysqli_fetch_assoc($result_sv)) : ?>
                        <option value="<?= htmlspecialchars($row_sv['ma_sv']) ?>">
                            <?= htmlspecialchars($row_sv['ma_sv']) ?> - <?= htmlspecialchars($row_sv['hoten']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <!-- Dropdown Mã môn học -->
            <div class="form-group">
                <label for="ma_mh">Mã môn học</label>
                <select name="ma_mh" id="ma_mh" class="form-control" required>
                    <option value="">Chọn mã môn học</option>
                    <?php while ($row_mh = mysqli_fetch_assoc($result_mh)) : ?>
                        <option value="<?= htmlspecialchars($row_mh['ma_mh']) ?>">
                            <?= htmlspecialchars($row_mh['ma_mh']) ?> - <?= htmlspecialchars($row_mh['ten_mh']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <!-- Nhập điểm giữa kỳ -->
            <div class="form-group">
                <label for="diem_gk">Điểm giữa kỳ</label>
                <input type="number" name="diem_gk" id="diem_gk" step="0.1" class="form-control" placeholder="Nhập điểm giữa kỳ" required>
            </div>
            <!-- Nhập điểm cuối kỳ -->
            <div class="form-group">
                <label for="diem_ck">Điểm cuối kỳ</label>
                <input type="number" name="diem_ck" id="diem_ck" step="0.1" class="form-control" placeholder="Nhập điểm cuối kỳ" required>
            </div>
            <!-- Nút thêm -->
            <button type="submit" class="btn btn-success">Thêm điểm</button>
            <a href="danhsachdiem.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
