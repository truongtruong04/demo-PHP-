<?php
include 'connect.php';

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$stmt = $conn->prepare("SELECT * FROM monhoc WHERE ma_mh LIKE ? OR ten_mh LIKE ?");
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
    <title>Kết quả tìm kiếm môn học</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Kết quả tìm kiếm</h1>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>STT</th>
                    <th>Mã Môn học</th>
                    <th>Tên Môn học</th>
                    <th>Số tín chỉ</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $i++ . '</td>';
                        echo '<td>' . htmlspecialchars($row['ma_mh']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['ten_mh']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['sotinchi']) . '</td>';
                        echo '<td>
                                <a href="suamonhoc.php?ma_mh=' . urlencode($row['ma_mh']) . '" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="xoamonhoc.php?ma_mh=' . urlencode($row['ma_mh']) . '" class="btn btn-danger btn-sm">Xóa</a>
                              </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5" class="text-center">Không tìm thấy môn học nào!</td></tr>';
                }
                ?>
            </tbody>
        </table>
        <a href="danhsachmonhoc.php" class="btn btn-secondary">Trở về danh sách</a>
    </div>
</body>
</html>
