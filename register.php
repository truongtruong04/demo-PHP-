<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $user_type = $_POST['user_type'];

    // Kiểm tra nhập liệu
    if (empty($username) || empty($password) || empty($confirm_password) || empty($user_type)) {
        $error = "Vui lòng điền đầy đủ thông tin!";
    } elseif ($password !== $confirm_password) {
        $error = "Mật khẩu xác nhận không khớp!";
    } else {
        // Kiểm tra xem username đã tồn tại chưa
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Tên tài khoản đã tồn tại!";
        } else {
            // Mã hóa mật khẩu trước khi lưu
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Thêm tài khoản vào database
            $stmt = $conn->prepare("INSERT INTO users (username, password, user_type) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashed_password, $user_type);

            if ($stmt->execute()) {
                $success = "Đăng ký thành công! Vui lòng đăng nhập.";
                header("Location: login.php?success=" . urlencode($success));
                exit;
            } else {
                $error = "Lỗi khi tạo tài khoản!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Đăng ký tài khoản</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="post" class="mt-4">
            <div class="form-group">
                <label for="username">Tên tài khoản</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Xác nhận mật khẩu</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="user_type">Loại tài khoản</label>
                <select name="user_type" id="user_type" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="giangvien">Giảng viên</option>
                    <option value="sinhvien">Sinh viên</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
        </form>
        <p class="mt-3 text-center">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
    </div>
</body>
</html>
