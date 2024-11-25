<?php
include 'connect.php';

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$stmt = $conn->prepare("SELECT lophoc.*, monhoc.ten_mh FROM lophoc 
                        JOIN monhoc ON lophoc.ma_mh = monhoc.ma_mh 
                        WHERE lophoc.ma_lop LIKE ? OR lophoc.ten_lop LIKE ?");
$search = '%' . $keyword . '%';
$stmt->bind_param("ss", $search, $search);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm lớp học</title>
    <
