<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        /* CSS tùy chỉnh cho nút */
        .btn-custom {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: box-shadow 0.3s ease;
        }
        .btn-custom:hover {
            box-shadow: 0px 4px 10px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>
<body>
    <h1 class="text-center">Danh sách sinh viên</h1>
    <form action="search.php" method="get" class="mb-3">
        <input type="text" name="keyword" placeholder="Nhập mã sinh viên để tìm" class="form-control w-50 d-inline-block">
        <input type="submit" value="Tìm kiếm" class="btn btn-primary">
    </form>

    <?php
    include 'connect.php';

    // Lấy danh sách sinh viên từ cơ sở dữ liệu
    $sql = "SELECT * FROM sinhvien";
    $result = mysqli_query($conn, $sql);
    ?>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>STT</th>
                <th>Mã Sinh viên</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
    <?php
    if (mysqli_num_rows($result) > 0) {
        $i = 1; // Khởi tạo biến đếm
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $i++ . '</td>'; // Sử dụng $i cho STT và tự tăng
            echo '<td>' . htmlspecialchars($row["ma_sv"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["hoten"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["ngaysinh"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["email"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["sdt"]) . '</td>';
            echo '<td>' . htmlspecialchars($row["diachi"]) . '</td>';
            echo '<td>
                    <a href="delete.php?stt=' . urlencode($row["stt"]) . '" class="btn btn-danger btn-sm">Xóa</a>
                    <a href="update.php?stt=' . urlencode($row["stt"]) . '" class="btn btn-warning btn-sm">Sửa</a>
                  </td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="8" class="text-center">Danh sách rỗng !!!</td></tr>';
    }
    ?>
</tbody>

    </table>
    <div class="d-flex justify-content-between mt-4">
        <a href="themmoi.php" class="btn btn-primary">Thêm mới sinh viên</a>
        <a href="trangchu.php" class="btn btn-primary">Quay về Trang chủ</a>
    </div>

    

</body>
</html>
