<?php
session_start();
require_once '../src/db.php';
$nv = $con->query("SELECT * FROM nhan_vien");
$soluongNV = $nv->num_rows;

$sp = $con->query("SELECT * FROM san_pham");
$soluongSP = $sp->num_rows;

$hoa_don = $con->query("SELECT * FROM hoa_don");
$tong_doanh_thu = 0;
$doanh_thu_thang = 0;


while ($row = $hoa_don->fetch_assoc()) {
  if ($row['tinh_trang'] == 'Đã thanh toán') {
    $tong_doanh_thu += $row['tong_tien'];

    if (date('m', strtotime($row['ngay'])) == date('m')) {
      $doanh_thu_thang += $row['tong_tien'];
    }
  }
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý CoffeeVN</title>
  <?php include '../component/head.html' ?>
  <link rel="stylesheet" href="resource/style/dashboard.css">
</head>

<body>
  <?php include '../component/header.php' ?>
  <?php include '../component/panel.php' ?>
  <main>
    <h1>Dashboard</h1>
    <div id='statistic'>
      <div>
        <span>Nhân viên</span>
        <span class="number"><?php echo $soluongNV ?></span>
      </div>
      <div>
        <span>Sản phẩm</span>
        <span class="number"><?php echo $soluongSP ?></span>
      </div>
      <div>
        <span>Tổng doanh thu (vnd)</span>
        <span class="number"><?php echo number_format($tong_doanh_thu, 0) ?></span>
        <span>Tháng <?php echo date('m/Y') . ": " . number_format($doanh_thu_thang) ?></span>
      </div>
    </div>
  </main>
  <?php include '../component/script.html' ?>
</body>

</html>