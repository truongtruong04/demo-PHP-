<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý hệ thống</title>
    <!-- Thêm CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Hệ thống Quản lý Sinh viên</h1>
        <div class="row text-center">
            <!-- Nút dẫn tới danh sách sinh viên -->
            <div class="col-md-3">
                <a href="danhsach.php" class="btn btn-primary btn-block p-3">
                    <i class="fas fa-user-graduate"></i> Danh sách Sinh viên
                </a>
            </div>
            <!-- Nút dẫn tới danh sách điểm -->
            <div class="col-md-3">
                <a href="danhsachdiem.php" class="btn btn-success btn-block p-3">
                    <i class="fas fa-chart-line"></i> Danh sách Điểm
                </a>
            </div>
            <!-- Nút dẫn tới danh sách môn học -->
            <div class="col-md-3">
                <a href="danhsachmonhoc.php" class="btn btn-warning btn-block p-3">
                    <i class="fas fa-book"></i> Danh sách Môn học
                </a>
            </div>
            <!-- Nút dẫn tới danh sách lớp học -->
            <div class="col-md-3">
                <a href="danhsachlophoc.php" class="btn btn-danger btn-block p-3">
                    <i class="fas fa-chalkboard-teacher"></i> Danh sách Lớp học
                </a>
            </div>
        </div>
    </div>

    <!-- Thêm JS Bootstrap và FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
