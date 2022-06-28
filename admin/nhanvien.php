<?php
session_start();
require '../src/db.php';
$sql = "SELECT * FROM view_nhanvien_info";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý nhân viên | coffeevn</title>
  <?php include '../component/head.html' ?>
</head>

<body>
  <?php include '../component/header.php' ?>
  <?php include '../component/panel.php' ?>
  <main>
    <h1>Quản lý nhân viên</h1>
    <p><a href="admin/addNhanVien.php">Thêm nhân viên</a></p>
    <table>
      <thead>
        <th>Mã</th>
        <th>Họ tên</th>
        <th>Ngày sinh</th>
        <th>Quê quán</th>
        <th>Bộ phận</th>
        <th>Ngày bắt đầu làm</th>
        <th>Tài khoản</th>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
          <tr>
            <td class='id'><?php echo $row['id'] ?></td>
            <td><?php echo $row['ho_ten'] ?></td>
            <td><?php echo $row['ngay_sinh'] ?></td>
            <td><?php echo $row['que_quan'] ?></td>
            <td><?php echo $row['bo_phan'] ?></td>
            <td><?php echo $row['ngay_bat_dau'] ?></td>
            <td><?php echo $row['tai_khoan'] ?></td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>
  </main>
  <?php include '../component/script.html' ?>
</body>

</html>