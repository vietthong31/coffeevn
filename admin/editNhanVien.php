<?php
session_start();

require_once "../src/check_login.php";
require_once "../src/db.php";
require_once "../src/query_function.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
  header("Location: admin/nhanvien.php");
} else {
  $sql = "SELECT * FROM nhan_vien WHERE id = " . $_GET['id'];
  $result = $con->query($sql);
  $row = $result->fetch_assoc();
}

$bo_phan = query_bophan();
$ca_lam = query_calamviec();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cập nhật nhân viên</title>
  <?php include '../component/head.html' ?>
  <link rel="stylesheet" href="resource/style/login.css">
</head>

<body>
  <div id='bg-img'></div>
  <main>
    <a href="admin/nhanvien.php"><span class="bi bi-arrow-left"></span>Về trang quản lý</a>
    <h1 class="mb-1">Cập nhật nhân viên mã <?php echo $row['id'] ?></h1>

    <form action="src/updateNhanVien.php" method="post" class="form">
      <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
      <div class="form-field">
        <label for="hoten">Họ tên</label>
        <input type="text" name='hoten' id='hoten' value="<?php echo $row['ho_ten'] ?>">
      </div>
      <div class="form-field">
        <label for="ngaysinh">Ngày sinh</label>
        <input type="date" name='ngaysinh' id='ngaysinh' value="<?php echo $row['ngay_sinh'] ?>">
      </div>
      <div class="form-field">
        <label for="hoten">Quê quán</label>
        <input type="text" name='quequan' id='quequan' value="<?php echo $row['que_quan'] ?>">
      </div>

      <div class="form-field">
        <label for="bophan">Bộ phận</label>
        <select name="bophan" id="bophan">
          <?php
          for ($i = 0; $i < count($bo_phan); $i++) {
            $id = $bo_phan[$i]['id'];
            $ten = $bo_phan[$i]['ten'];
            $selected = $bo_phan[$i]['id'] == $row['id_bo_phan'] ? "selected" : "";
            echo "<option value='$id' $selected>$ten</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-field">
        <label for="calam">Ca làm việc</label>
        <select name="calam" id="calam">
          <?php
          for ($i = 0; $i < count($ca_lam); $i++) {
            $id = $ca_lam[$i]['id'];
            $bat_dau = $ca_lam[$i]['gio_bat_dau'];
            $ket_thuc = $ca_lam[$i]['gio_ket_thuc'];
            echo "<option value='$id'>$bat_dau - $ket_thuc</option>";
          }
          ?>
        </select>
      </div>
      <input type="submit" name="update" value="Cập nhật">
    </form>
  </main>
</body>

</html>