<?php
session_start();

require_once "src/check_login.php";
require_once "src/db.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
  header("Location: admin/sanpham.php");
} else {
  $sql = "SELECT * FROM hoa_don WHERE id = " . $_GET['id'];
  $result = $con->query($sql);
  $row = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cập nhật thông tin hóa đơn</title>
  <?php include 'component/head.html' ?>
  <link rel="stylesheet" href="resource/style/login.css">
</head>

<body>
  <div id='bg-img'></div>
  <main>
    <a href="hoadon.php"><span class="bi bi-arrow-left"></span>Về trang quản lý</a>
    <h1 class="mb-1">Cập nhật hóa đơn mã <?php echo $row['id'] ?></h1>

    <form action="src/updateHoaDon.php" method="post" class="form">
      <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
      <div class="form-field">
        <label for="ngay">Ngày</label>
        <input type="date" name='ngay' id='ngay' value="<?php echo $row['ngay'] ?>" required>
      </div>

      <div class="form-field">
        <label for="tinhtrang">Tình trạng</label>
        <select name="tinhtrang" id="tinhtrang" required>
          <option>Đã thanh toán</option>
          <option>Chưa thanh toán</option>
        </select>
      </div>

      <input type="submit" name="update" value="Cập nhật">
    </form>
  </main>
</body>

</html>