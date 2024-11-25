<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách môn học</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Danh sách môn học</h1>
        <form action="timkiemmonhoc.php" method="get" class="mb-3">
            <input type="text" name="keyword" placeholder="Nhập mã hoặc tên môn học" class="form-control w-50 d-inline-block">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>

        <?php
        include 'connect.php';

        // Lấy danh sách môn học từ cơ sở dữ liệu
        $sql = "SELECT * FROM monhoc";
        $result = mysqli_query($conn, $sql);
        ?>

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
                if (mysqli_num_rows($result) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
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
                    echo '<tr><td colspan="5" class="text-center">Không có môn học nào!</td></tr>';
                }
                ?>
            </tbody>
        </table>
                <div class="d-flex justify-content-between mt-4">
            <a href="themmoi_monhoc.php" class="btn btn-primary">Thêm mới môn học</a>
            <a href="trangchu.php" class="btn btn-primary">Quay về Trang chủ</a>
                </div>

    </div>
</body>
</html>
