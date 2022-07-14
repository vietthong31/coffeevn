<?php
session_start();
require_once 'src/db.php';
include 'component/pagination.php';

$limit = 5; // số dòng mỗi trang

$result2 = $con->query("SELECT * FROM hoa_don");
$totalPage = ceil($result2->num_rows / $limit); // tổng số trang


if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}
$_SESSION['sanpham_page'] = $page;

$initialPage = ($page - 1) * $limit; // tính index để giới hạn LIMIT


$sql = "SELECT * FROM hoa_don";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý hóa đơn | coffeevn</title>
  <?php include 'component/head.html' ?>
</head>

<body>
  <?php include 'component/header.php' ?>
  <?php
  if ($_SESSION['bophan'] == '4') {
    include 'component/panel.php';
  } else {
    include 'component/clientpanel.php';
  }
  ?>
  <main>
    <h1>Quản lý hóa đơn</h1>
    <?php echo pagination($totalPage, $page, "hoadon.php?page=") ?>

    <table class="small mb-5">
      <thead>
        <th>Mã</th>
        <th>Ngày</th>
        <th>Tình trạng</th>
        <th>Tổng tiền</th>
        <th colspan="3" class="actions"></th>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
          <tr>
            <td class='id'><?php echo $row['id'] ?></td>
            <td><?php echo $row['ngay'] ?></td>
            <td><?php echo $row['tinh_trang'] ?></td>
            <td><?php echo $row['tong_tien'] ?></td>
            <td class="action"><a href="hoadon.php?id=<?php echo $row['id'] ?>"><span class="bi bi-eye"></span></a></td>
            <td class="action"><a href="src/deleteHoaDon.php?id=<?php echo $row['id'] ?>"><span class="bi bi-trash3"></span></a></td>
            <td class="action"><a href="editHoaDon.php?id=<?php echo $row['id'] ?>"><span class="bi bi-pencil-square"></span></a></td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

    <?php
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      include "component/chitiethoadon.php";
    }
    ?>

  </main>
  <?php include 'component/script.html' ?>
</body>

</html>