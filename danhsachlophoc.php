<?php
include 'connect.php';

$sql = "SELECT lophoc.*, monhoc.ten_mh FROM lophoc 
        JOIN monhoc ON lophoc.ma_mh = monhoc.ma_mh";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách lớp học</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Danh sách lớp học</h1>

        <!-- Tìm kiếm lớp học -->
        <form action="timkiemlophoc.php" method="get" class="mb-4">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Nhập mã hoặc tên lớp học để tìm kiếm">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                </div>
            </div>
        </form>

        <!-- Bảng danh sách lớp học -->
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Mã lớp</th>
                    <th>Tên lớp</th>
                    <th>Môn học</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['ma_lop']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ten_lop']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ten_mh']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ngaybatdau']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ngayketthuc']) . "</td>";
                        echo '<td>
                                <a href="sualophoc.php?ma_lop=' . urlencode($row['ma_lop']) . '" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="xoalophoc.php?ma_lop=' . urlencode($row['ma_lop']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Bạn có chắc chắn muốn xóa lớp học này không?\')">Xóa</a>
                                <a href="nhapdiem.php?ma_lop=' . urlencode($row['ma_lop']) . '" class="btn btn-primary btn-sm">Nhập điểm</a>
                              </td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Không có lớp học nào!</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-between mt-4">
        <a href="themlophoc.php" class="btn btn-primary">Thêm mới lớp học</a>
        <a href="trangchu.php" class="btn btn-primary">Quay về Trang chủ</a>
        </div>


    </div>
</body>
</html>
