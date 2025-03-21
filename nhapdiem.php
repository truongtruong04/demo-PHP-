<?php
include 'connect.php';

$ma_lop = $_GET['ma_lop'];

// Lấy danh sách sinh viên trong lớp
$sql = "SELECT sinhvien.*, lop_sinhvien.ma_lop FROM lop_sinhvien 
        JOIN sinhvien ON lop_sinhvien.ma_sv = sinhvien.ma_sv 
        WHERE lop_sinhvien.ma_lop = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ma_lop);
$stmt->execute();
$result = $stmt->get_result();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['diem_gk'] as $ma_sv => $diem_gk) {
        $diem_ck = $_POST['diem_ck'][$ma_sv];
        $ma_mh = $_POST['ma_mh']; // Môn học của lớp

        // Thêm hoặc cập nhật điểm
        $stmt = $conn->prepare("REPLACE INTO diem (ma_sv, ma_mh, diem_gk, diem_ck) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdd", $ma_sv, $ma_mh, $diem_gk, $diem_ck);
        $stmt->execute();
    }
    echo "<script>alert('Nhập điểm thành công!'); window.location.href = 'danhsachlophoc.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập điểm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Nhập điểm cho lớp <?php echo htmlspecialchars($ma_lop); ?></h1>
        <form method="post">
            <input type="hidden" name="ma_mh" value="<?php echo htmlspecialchars($_GET['ma_mh']); ?>">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã sinh viên</th>
                        <th>Họ tên</th>
                        <th>Điểm giữa kỳ</th>
                        <th>Điểm cuối kỳ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['ma_sv']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['hoten']) . "</td>";
                            echo '<td><input type="number" name="diem_gk[' . $row['ma_sv'] . ']" class="form-control" required></td>';
                            echo '<td><input type="number" name="diem_ck[' . $row['ma_sv'] . ']" class="form-control" required></td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>Không có sinh viên nào trong lớp!</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Lưu điểm</button>
        </form>
    </div>
</body>
</html>