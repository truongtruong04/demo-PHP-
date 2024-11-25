<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_lop = trim($_POST['ma_lop']);
    $ten_lop = trim($_POST['ten_lop']);
    $ma_mh = trim($_POST['ma_mh']);
    $ngaybatdau = trim($_POST['ngaybatdau']);
    $ngayketthuc = trim($_POST['ngayketthuc']);

    if ($ma_lop && $ten_lop && $ma_mh && $ngaybatdau && $ngayketthuc) {
        $stmt = $conn->prepare("INSERT INTO lophoc (ma_lop, ten_lop, ma_mh, ngaybatdau, ngayketthuc) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $ma_lop, $ten_lop, $ma_mh, $ngaybatdau, $ngayketthuc);

        if ($stmt->execute()) {
            echo "<script>alert('Thêm lớp học thành công!'); window.location.href = 'danhsachlophoc.php';</script>";
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
    <title>Thêm Lớp Học</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Thêm Lớp Học</h1>
        <form method="post">
            <div class="form-group">
                <label for="ma_lop">Mã Lớp</label>
                <input type="text" name="ma_lop" id="ma_lop" class="form-control" placeholder="Nhập mã lớp học" required>
            </div>
            <div class="form-group">
                <label for="ten_lop">Tên Lớp</label>
                <input type="text" name="ten_lop" id="ten_lop" class="form-control" placeholder="Nhập tên lớp học" required>
            </div>
            <div class="form-group">
                <label for="ma_mh">Mã Môn Học</label>
                <input type="text" name="ma_mh" id="ma_mh" class="form-control" placeholder="Nhập mã môn học" required>
            </div>
            <div class="form-group">
                <label for="ngaybatdau">Ngày Bắt Đầu</label>
                <input type="date" name="ngaybatdau" id="ngaybatdau" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="ngayketthuc">Ngày Kết Thúc</label>
                <input type="date" name="ngayketthuc" id="ngayketthuc" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Thêm</button>
            <a href="danhsachlophoc.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
