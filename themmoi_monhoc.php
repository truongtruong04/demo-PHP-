<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_mh = trim($_POST['ma_mh']);
    $ten_mh = trim($_POST['ten_mh']);
    $sotinchi = intval($_POST['sotinchi']);

    if ($ma_mh && $ten_mh && $sotinchi > 0) {
        $stmt = $conn->prepare("INSERT INTO monhoc (ma_mh, ten_mh, sotinchi) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $ma_mh, $ten_mh, $sotinchi);

        if ($stmt->execute()) {
            echo "<script>alert('Thêm mới môn học thành công!'); window.location.href = 'danhsachmonhoc.php';</script>";
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
    <title>Thêm mới môn học</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h2>Thêm Mới Môn Học</h2>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="ma_mh">Mã môn học</label>
                        <input type="text" name="ma_mh" id="ma_mh" class="form-control" placeholder="Nhập mã môn học" required>
                    </div>
                    <div class="form-group">
                        <label for="ten_mh">Tên môn học</label>
                        <input type="text" name="ten_mh" id="ten_mh" class="form-control" placeholder="Nhập tên môn học" required>
                    </div>
                    <div class="form-group">
                        <label for="sotinchi">Số tín chỉ</label>
                        <input type="number" name="sotinchi" id="sotinchi" class="form-control" placeholder="Nhập số tín chỉ" required>
                    </div>
                    <button type="submit" class="btn btn-success">Thêm mới</button>
                    <a href="danhsachmonhoc.php" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
