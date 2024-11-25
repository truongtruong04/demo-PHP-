<?php
include 'connect.php';

if (isset($_GET['ma_mh'])) {
    $ma_mh = $_GET['ma_mh'];
    $stmt = $conn->prepare("SELECT * FROM monhoc WHERE ma_mh = ?");
    $stmt->bind_param("s", $ma_mh);
    $stmt->execute();
    $result = $stmt->get_result();
    $monhoc = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_mh = trim($_POST['ten_mh']);
    $sotinchi = intval($_POST['sotinchi']);

    if ($ten_mh && $sotinchi > 0) {
        $stmt = $conn->prepare("UPDATE monhoc SET ten_mh = ?, sotinchi = ? WHERE ma_mh = ?");
        $stmt->bind_param("sis", $ten_mh, $sotinchi, $ma_mh);

        if ($stmt->execute()) {
            echo "<script>alert('Cập nhật môn học thành công!'); window.location.href = 'danhsachmonhoc.php';</script>";
        } else {
            echo "<script>alert('Lỗi: " . $stmt->error . "');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng nhập thông tin hợp lệ!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa môn học</title>
</head>
<body>
    <div class="container">
        <h1>Sửa môn học</h1>
        <form method="post">
            <div class="form-group">
                <label for="ten_mh">Tên môn học</label>
                <input type="text" name="ten_mh" id="ten_mh" class="form-control" value="<?php echo htmlspecialchars($monhoc['ten_mh']); ?>" required>
            </div>
            <div class="form-group">
                <label for="sotinchi">Số tín chỉ</label>
                <input type="number" name="sotinchi" id="sotinchi" class="form-control" value="<?php echo htmlspecialchars($monhoc['sotinchi']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="danhsachmonhoc.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
