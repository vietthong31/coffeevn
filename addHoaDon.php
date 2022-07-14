<?php
session_start();
require_once 'src/db.php';

$result = $con->query("SELECT * FROM san_pham");

if (isset($_POST['addBill'])) {

  $sanpham = $result->fetch_all(MYSQLI_ASSOC);

  // lọc input số lượng sản phẩm > 0
  $_SESSION['soluong_sp'] = array_filter($_POST, function ($v, $k) {
    return intval($v) > 0;
  }, ARRAY_FILTER_USE_BOTH);

  $_SESSION['tong_tien'] = 0;
  $_SESSION['sanpham'] = array();
  if (count($_SESSION['soluong_sp']) > 0) {

    foreach ($sanpham as $key => $sp) {
      if (array_key_exists($sp['id'], $_SESSION['soluong_sp'])) {
        $_SESSION['sanpham'][$sp['id']] = $sp;
      }
    }


    foreach ($_SESSION['sanpham'] as $key => $sp) {
      $_SESSION['tong_tien'] += intval($_SESSION['soluong_sp'][$sp['id']]) * $sp['don_gia'];
    }
  }
  // var_dump($_SESSION['sanpham']);
  // echo "<br>";
  // var_dump($_SESSION['soluong_sp']);
}



?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tạo hóa đơn mới</title>
  <?php include 'component/head.html' ?>
  <link rel="stylesheet" href="resource/style/dashboard.css">
  <link rel="stylesheet" href="resource/style/manage.css">
  <link rel="stylesheet" href="resource/style/form.css">
</head>

<body>
  <?php include 'component/header.php' ?>
  <?php include 'component/clientPanel.php' ?>
  <main>
    <h1>Tạo hóa đơn</h1>
    <form action="src/insertHoaDon.php" method="post" class="form">
      <div class="form-field">
        <label>Ngày</label>
        <input type="date" name="buydate" value="<?php echo date("Y-m-d"); ?>">
      </div>
      <div class="form-field">
        <label for="status">Tình trạng thanh toán</label>
        <select name="status" id="status">
          <option>Đã thanh toán</option>
          <option>Chưa thanh toán</option>
        </select>
      </div>
      <table class="mb-2 small">
        <tr>
          <th>Sản phẩm</th>
          <th>Số lượng</th>
          <th>Đơn giá</th>
        </tr>
        <?php if (isset($_SESSION['soluong_sp']) && count($_SESSION['soluong_sp']) > 0) : ?>
          <?php foreach ($_SESSION['sanpham'] as $key => $sp) : ?>
            <tr>
              <td><?php echo $sp['ten'] ?></td>
              <td><?php echo $_SESSION['soluong_sp'][$sp['id']] ?></td>
              <td><?php echo $sp['don_gia'] ?></td>
            </tr>
          <?php endforeach ?>
        <?php else : ?>
          <tr>
            <td colspan="3">Chưa chọn sản phẩm</td>
          </tr>
        <?php endif ?>
      </table>
      <div class="form-field">
        <label>Tổng tiền</label>
        <input type="number" name="total" value="<?php echo $_SESSION['tong_tien'] ?? "" ?>" readonly>
      </div>
      <input type="submit" name='add' value="Thêm">
    </form>
  </main>
  <?php include 'component/script.html' ?>
</body>

</html>