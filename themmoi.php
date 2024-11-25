<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Thêm mới sinh viên</title>
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Thêm Mới Sinh Viên</h1>
            <hr class="my-4">
        </div>

        <?php
        include 'connect.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ma_sv = trim($_POST['ma_sv']);
            $hoten = trim($_POST['hoten']);
            $ngaysinh = trim($_POST['ngaysinh']);
            $email = trim($_POST['email']);
            $sdt = trim($_POST['sdt']);
            $diachi = trim($_POST['diachi']);

            if ($ma_sv && $hoten && $ngaysinh && $email && $sdt && $diachi) {
                // Sử dụng prepared statement để thêm mới dữ liệu
                $stmt = $conn->prepare("INSERT INTO sinhvien (ma_sv, hoten, ngaysinh, email, sdt, diachi) 
                                        VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $ma_sv, $hoten, $ngaysinh, $email, $sdt, $diachi);

                if ($stmt->execute()) {
                    echo "<script>alert('Thêm dữ liệu thành công!');</script>";
                } else {
                    echo "<script>alert('Lỗi: " . $stmt->error . "');</script>";
                }

                $stmt->close();
            } else {
                echo "<script>alert('Bạn phải nhập đầy đủ thông tin');</script>";
            }

            $conn->close();
        }
        ?>

        <form action="themmoi.php" method="post">
            <fieldset class="form-group">
                <label for="ma_sv">Mã Sinh viên</label>
                <input type="text" name="ma_sv" id="ma_sv" class="form-control" placeholder="Nhập mã sinh viên" required>
            </fieldset>
            <fieldset class="form-group">
                <label for="hoten">Họ tên</label>
                <input type="text" name="hoten" id="hoten" class="form-control" placeholder="Nhập họ tên sinh viên" required>
            </fieldset>
            <fieldset class="form-group">
                <label for="ngaysinh">Ngày sinh</label>
                <input type="date" name="ngaysinh" id="ngaysinh" class="form-control" required>
            </fieldset>
            <fieldset class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" required>
            </fieldset>
            <fieldset class="form-group">
                <label for="sdt">Số điện thoại</label>
                <input type="tel" name="sdt" id="sdt" class="form-control" pattern="[0-9]{10}" placeholder="10 chữ số" required>
            </fieldset>
            <fieldset class="form-group">
                <label for="diachi">Địa chỉ</label>
                <textarea name="diachi" id="diachi" class="form-control" rows="3" placeholder="Nhập địa chỉ" required></textarea>
            </fieldset>

            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a href="danhsach.php" class="btn btn-secondary">Danh sách</a>
        </form>
    </div>
</body>
</html>
