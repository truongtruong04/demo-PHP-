<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý hệ thống</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .main-container {
            text-align: center;
        }

        .buttons-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .buttons-container .btn {
            margin: 10px;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .image-container {
            margin-top: 20px;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5 main-container">
        <h1 class="mb-4">Hệ thống Quản lý Sinh viên</h1>
        <div class="buttons-container">
            <a href="danhsach.php" class="btn btn-primary">Danh sách Sinh viên</a>
            <a href="danhsachdiem.php" class="btn btn-success">Danh sách Điểm</a>
            <a href="danhsachmonhoc.php" class="btn btn-warning">Danh sách Môn học</a>
            <a href="danhsachlophoc.php" class="btn btn-danger">Danh sách Lớp học</a>
        </div>

        <!-- Thêm ảnh mới -->
        <div class="image-container">
            <img src="eaut.jpg" alt="EAUT 2025 Tuyển sinh">
        </div>
    </div>
</body>
</html>
