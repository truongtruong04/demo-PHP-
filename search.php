<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h2 class="my-4">Kết quả tìm kiếm sinh viên</h2>

        <?php
        include 'connect.php';

        // Kiểm tra từ khóa tìm kiếm
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

        if ($keyword) {
            // Sử dụng prepared statement để tìm kiếm
            $stmt = $conn->prepare("SELECT * FROM sinhvien WHERE ma_sv LIKE ? OR hoten LIKE ?");
            $search = '%' . $keyword . '%';
            $stmt->bind_param("ss", $search, $search);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            echo '<p class="text-danger">Vui lòng nhập từ khóa để tìm kiếm.</p>';
            $result = null;
        }
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
                if ($result && $result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $i++ . '</td>';
                        echo '<td>' . htmlspecialchars($row["ma_sv"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["hoten"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["ngaysinh"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["email"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["sdt"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["diachi"]) . '</td>';
                        echo '<td>
                                <a href="delete.php?stt=' . urlencode($row["stt"]) . '" class="btn btn-danger btn-sm">Xóa</a>
                                <a href="update.php?stt=' . urlencode($row["stt"]) . '" class="btn btn-primary btn-sm">Sửa</a>
                              </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="8" class="text-center">Không tìm thấy kết quả!</td></tr>';
                }
                ?>
            </tbody>
        </table>
        <a href="danhsach.php" class="btn btn-secondary">Danh sách</a>
    </div>
</body>
</html>
