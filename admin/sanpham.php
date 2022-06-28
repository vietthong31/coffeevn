<?php
session_start();
require '../src/db.php';
include '../component/pagination.php';

$limit = 5; // số dòng mỗi trang

$result2 = $con->query("SELECT * FROM san_pham");
$totalPage = ceil($result2->num_rows / $limit); // tổng số trang


if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}
$_SESSION['sanpham_page'] = $page;

$initialPage = ($page - 1) * $limit; // tính index để giới hạn LIMIT

$sql = "SELECT sp.id, sp.ten, dm.ten AS ten_danh_muc, don_gia, hinh_anh FROM san_pham sp INNER JOIN danh_muc dm ON sp.id_danh_muc = dm.id ORDER BY sp.id LIMIT " . $initialPage . ',' . $limit;
$result = $con->query($sql);

?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý sản phẩm | coffeevn</title>
  <?php include '../component/head.html' ?>
</head>

<body>
  <?php include '../component/header.php' ?>
  <?php include '../component/panel.php' ?>
  <main>
    <h1>Quản lý sản phẩm</h1>

    <p><a href="admin/addSanPham.php">Thêm sản phẩm</a></p>

    <table class="mb-auto">
      <thead>
        <th>Mã</th>
        <th>Tên sản phẩm</th>
        <th>Danh mục</th>
        <th>Đơn giá (VND)</th>
        <th class="img">Hình ảnh</th>
        <th colspan="2" class="actions"></th>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
          <tr>
            <td class='id'><?php echo $row['id'] ?></td>
            <td><?php echo $row['ten'] ?></td>
            <td><?php echo $row['ten_danh_muc'] ?></td>
            <td><?php echo $row['don_gia'] ?></td>
            <td><img src="<?php echo 'resource/img/' . ($row['hinh_anh'] == '' ? 'placeholder.png' : $row['hinh_anh']) ?>" width="80" height="80"></td>
            <td class="action"><a href="src/deleteSanPham.php?id=<?php echo $row['id'] ?>"><span class="bi bi-trash3"></span></a></td>
            <td class="action"><a href="admin/editSanPham.php?id=<?php echo $row['id'] ?>"><span class="bi bi-pencil-square"></span></a></td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

    <?php echo pagination($totalPage, $page, "admin/sanpham.php?page=") ?>

  </main>
  <?php include '../component/script.html' ?>
</body>

</html>