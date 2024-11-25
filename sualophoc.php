<?php
include 'connect.php';

$ma_lop = $_GET['ma_lop'];
$stmt = $conn->prepare("SELECT * FROM lophoc WHERE ma_lop = ?");
$stmt->bind_param("s", $ma_lop);
$stmt->execute();
$result = $stmt->get_result();
$lophoc = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_lop = trim($_POST['ten_lop']);
    $ma_mh = trim($_POST['ma_mh']);
    $ngaybatdau = trim($_POST['ngaybatdau']);
    $ngayketthuc = trim($_POST['ngayketthuc']);

    if ($ten_lop && $ma_mh && $ngaybatdau && $ngayketthuc) {
        $stmt = $conn->prepare("UPDATE lophoc SET ten_lop = ?, ma_mh = ?, ngaybatdau = ?, ngayketthuc = ? WHERE ma_lop = ?");
        $stmt->bind_param("sssss", $ten_lop, $ma_mh, $ngaybatdau, $ngayketthuc, $ma_lop);

        if ($stmt->execute()) {
            echo "<script>alert('Cập nhật lớp học thành công!'); window.location.href = 'danhsachlophoc.php';</script>";
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
    <title>Sửa Lớp Học</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Sửa Lớp Học</h1>
        <form method="post">
            <div class="form-group">
                <label for="ten_lop">Tên Lớp</label>
                <input type="text" name="ten_lop" id="ten_lop" class="form-control" value="<?php echo htmlspecialchars($lophoc['ten_lop']); ?>" required>
            </div>
            <div class="form-group">
                <label for="ma_mh">Mã Môn Học</label>
                <input type="text" name="ma_mh" id="ma_mh" class="form-control" value="<?php echo htmlspecialchars($lophoc['ma_mh']); ?>" required>
            </div>
            <div class="form-group">
                <label for="ngaybatdau">Ngày Bắt Đầu</label>
                <input type="date" name="ngaybatdau" id="ngaybatdau" class="form-control" value="<?php echo htmlspecialchars($lophoc['ngaybatdau']); ?>" required>
            </div>
            <div class="form-group">
                <label for="ngayketthuc">Ngày Kết Thúc</label>
                <input type="date" name="ngayketthuc" id="ngayketthuc" class="form-control" value="<?php echo htmlspecialchars($lophoc['ngayketthuc']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="danhsachlophoc.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
