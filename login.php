<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); // Không mã hóa mật khẩu
    $user_type = $_POST['user_type'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ? AND user_type = ?");
    $stmt->bind_param("sss", $username, $password, $user_type);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];
        $_SESSION['ma_sv'] = $user['ma_sv'];

        // Chuyển hướng dựa vào loại tài khoản
        if ($user['user_type'] == 'admin' || $user['user_type'] == 'giangvien') {
            header("Location: trangchu.php");
        } elseif ($user['user_type'] == 'sinhvien') {
            header("Location: xemdiem.php");
        }
        exit;
    } else {
        $error = "Tên tài khoản hoặc mật khẩu không đúng!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Đăng nhập hệ thống</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
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
                <label for="user_type">Loại tài khoản</label>
                <select name="user_type" id="user_type" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="giangvien">Giảng viên</option>
                    <option value="sinhvien">Sinh viên</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
        </form>
    </div>
</body>
</html>
