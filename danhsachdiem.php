<?php
include 'connect.php';

$sql = "SELECT diem.*, sinhvien.stt, sinhvien.hoten, monhoc.ten_mh 
        FROM diem 
        JOIN sinhvien ON diem.ma_sv = sinhvien.ma_sv 
        JOIN monhoc ON diem.ma_mh = monhoc.ma_mh";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách điểm sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Danh sách điểm sinh viên</h1>

        <!-- Tìm kiếm điểm -->
        <form action="timkiemdiem.php" method="get" class="mb-4">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Nhập mã sinh viên hoặc tên môn học">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                </div>
            </div>
        </form>

        <!-- Bảng danh sách điểm -->
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>STT</th>
                    <th>Mã sinh viên</th>
                    <th>Họ tên</th>
                    <th>Tên môn học</th>
                    <th>Điểm giữa kỳ</th>
                    <th>Điểm cuối kỳ</th>
                    <th>Điểm trung bình</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
                        <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $stt = 1; // Khởi tạo STT từ 1
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $stt . "</td>"; // Hiển thị số thứ tự
                        echo "<td>" . htmlspecialchars($row['ma_sv']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['hoten']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ten_mh']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['diem_gk']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['diem_ck']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['diem_tb']) . "</td>";
                        echo '<td>
                                <a href="suadiem.php?ma_sv=' . urlencode($row['ma_sv']) . '&ma_mh=' . urlencode($row['ma_mh']) . '" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="xoadiem.php?ma_sv=' . urlencode($row['ma_sv']) . '&ma_mh=' . urlencode($row['ma_mh']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Bạn có chắc chắn muốn xóa điểm này không?\')">Xóa</a>
                            </td>';
                        echo "</tr>";
                        $stt++; // Tăng STT lên 1
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Không có dữ liệu!</td></tr>";
                }
                ?>
            </tbody>

        </table>
                


            <div class="d-flex justify-content-between mt-4">
                <a href="themmoid.php" class="btn btn-primary">Thêm mới điểm</a>
                <a href="trangchu.php" class="btn btn-primary">Quay về Trang chủ</a>
            </div>


        
    </div>
</body>
</html>
