<?php
session_start();
require_once 'src/db.php';

$id_nhanvien = $_SESSION['id_nhanvien'];
$sql = "SELECT * FROM view_nhanvien_info WHERE id = $id_nhanvien";
$result = $con->query($sql);
$nv = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tài khoản | coffeevn</title>
  <?php include 'component/head.html' ?>
  <link rel="stylesheet" href="resource/style/form.css">
</head>

<body>
  <?php include 'component/header.php' ?>
  <?php include 'component/clientpanel.php' ?>
  <main>
    <h1>Thông tin tài khoản</h1>

    <form action="src/updateNhanVien.php" method="post" class="form">
      <input type="text" name='id' value="<?php echo $nv['id'] ?>" hidden>
      <div class="form-field">
        <label for="hoten">Họ tên</label>
        <input type="text" name="hoten" id="hoten" value="<?php echo $nv['ho_ten'] ?>">
      </div>
      <div class="form-field">
        <label for="ngaysinh">Ngày sinh</label>
        <input type="date" name="ngaysinh" id="ngaysinh" value="<?php echo $nv['ngay_sinh'] ?>">
      </div>
      <div class="form-field">
        <label for="quequan">Quê quán</label>
        <input type="text" name="quequan" id="quequan" value="<?php echo $nv['que_quan'] ?>">
      </div>
      <div class="form-field">
        <label for="taikhoan">Tài khoản</label>
        <input type="text" name="taikhoan" id="taikhoan" value="<?php echo $nv['tai_khoan'] ?>" readonly>
      </div>
      <div class="form-field">
        <label for="matkhau">Mật khẩu</label>
        <input type="password" name="matkhau" id="matkhau" value="<?php echo $nv['mat_khau'] ?>">
      </div>
      <div>
        <a href="src/deleteNhanVien.php?id=<?php echo $nv['id'] ?>" class="text-danger">Xóa tài khoản</a>
        <input type="submit" value="Cập nhật">
      </div>
    </form>

  </main>
  <?php include 'component/script.html' ?>
</body>

</html>