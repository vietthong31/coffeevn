<?php
session_start();
require '../src/db.php';
$sql = "SELECT * FROM danh_muc";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý danh mục | coffeevn</title>
  <?php include '../component/head.html' ?>
</head>

<body>
  <?php include '../component/header.php' ?>
  <?php include '../component/panel.php' ?>
  <main>
    <h1>Quản lý danh mục</h1>
    <p><a href="admin/addDanhMuc.php">Thêm danh mục</a></p>
    <table>
      <thead>
        <th>Mã</th>
        <th style="width: 20%;">Danh mục</th>
        <th>Mô tả</th>
        <th colspan="2" class="actions"></th>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
          <tr>
            <td class='id'><?php echo $row['id'] ?></td>
            <td><?php echo $row['ten'] ?></td>
            <td><?php echo $row['mo_ta'] ?></td>
            <td class="action"><a href="src/deleteDanhMuc.php?id=<?php echo $row['id'] ?>"><span class="bi bi-trash3"></span></a></td>
            <td class="action"><a href="admin/editDanhMuc.php?id=<?php echo $row['id'] ?>"><span class="bi bi-pencil-square"></span></a></td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>
  </main>
  <?php include '../component/script.html' ?>
</body>

</html>