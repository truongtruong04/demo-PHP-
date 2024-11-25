<?php
include 'connect.php';

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$stmt = $conn->prepare("
    SELECT diem.*, sinhvien.hoten, monhoc.ten_mh
    FROM diem
    JOIN sinhvien ON diem.ma_sv = sinhvien.ma_sv
    JOIN monhoc ON diem.ma_mh = monhoc.ma_mh
    WHERE diem.ma_sv LIKE ? OR monhoc.ten_mh LIKE ?
");
$search = '%' . $keyword . '%';
$stmt->bind_param("ss", $search, $search);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm điểm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Kết quả tìm kiếm</h1>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Mã sinh viên</th>
                    <th>Họ tên</th>
                    <th>Mã môn học</th>
                    <th>Tên môn học</th>
                    <th>Điểm giữa kỳ</th>
                    <th>Điểm cuối kỳ</th>
                    <th>Điểm trung bình</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['ma_sv']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['hoten']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ma_mh']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ten_mh']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['diem_gk']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['diem_ck']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['diem_tb']) . "</td>";
                        echo '<td>
                                <a href="suadiem.php?ma_sv=' . urlencode($row['ma_sv']) . '&ma_mh=' . urlencode($row['ma_mh']) . '" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="xoadiem.php?ma_sv=' . urlencode($row['ma_sv']) . '&ma_mh=' . urlencode($row['ma_mh']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Bạn có chắc chắn muốn xóa điểm này không?\')">Xóa</a>
                              </td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Không tìm thấy kết quả!</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="danhsachdiem.php" class="btn btn-secondary">Quay lại danh sách</a>
    </div>
</body>
</html>
