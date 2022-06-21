<?php

require 'src/db.php';
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
  <?php include 'component/head.html' ?>
</head>

<body>
  <?php include 'component/header.php' ?>
  <?php include 'component/panel.php' ?>
  <main>
    <h1>Quản lý nhân viên</h1>
    <p><a href="addNhanVien.php">Thêm nhân viên</a></p>
    <table>
      <thead>
        <th>Mã</th>
        <th>Họ tên</th>
        <th>Ngày sinh</th>
        <th>Quê quán</th>
        <th>Bộ phận</th>
        <th>Ngày bắt đầu làm</th>
        <th colspan="2" class="actions"></th>
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

            <td class="action">
              <?php if (isset($_SESSION['username']) && $_SESSION['username'] != $row['tai_khoan']) : ?>
                <a href="src/deleteBoPhan.php?id=<?php echo $row['id'] ?>"><span class="bi bi-trash3"></span></a>
              <?php endif ?>
            </td>
            <td class="action">
              <a href="editNhanVien.php?id=<?php echo $row['id'] ?>"><span class="bi bi-pencil-square"></span></a>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>
  </main>
  <?php include 'component/script.html' ?>
</body>

</html>