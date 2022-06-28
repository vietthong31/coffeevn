<?php
session_start();
require_once "../src/check_login.php";
require_once "../src/db.php";
require_once "../src/query_function.php";

$bo_phan = query_bophan();
$ca_lam = query_calamviec();

if (isset($_POST['add'])) {
  $sql = "INSERT INTO nhan_vien VALUES (null, ?, ?, ?, ?, ?, ?, null, null)";
  $stmt = $con->prepare($sql);
  $hoten = $_POST['hoten'];
  $ngaysinh = $_POST['ngaysinh'];
  $quequan = $_POST['quequan'];
  $bophan = $_POST['bophan'];
  $calam = $_POST['calam'];
  $currentDate = (new DateTime())->format('Y/m/d');

  $stmt->bind_param("sssiis", $hoten, $ngaysinh, $quequan, $bophan, $calam, $currentDate);
  $stmt->execute();
  header("Location: nhanvien.php");
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm nhân viên</title>
  <?php include '..component/head.html' ?>
  <link rel="stylesheet" href="resource/style/login.css">
</head>

<body>
  <div id='bg-img'></div>
  <main>
    <a href="admin/nhanvien.php"><span class="bi bi-arrow-left"></span>Về trang quản lý</a>
    <h1 class="mb-1">Thêm nhân viên mới</h1>

    <form action="" method="post" class="form">
      <div class="form-field">
        <label for="hoten">Họ tên</label>
        <input type="text" name='hoten' id='hoten' value="<?php echo $_POST["hoten"] ?? "" ?>">
      </div>
      <div class="form-field">
        <label for="ngaysinh">Ngày sinh</label>
        <input type="date" name='ngaysinh' id='ngaysinh' value="<?php echo $_POST['ngaysinh'] ?? "" ?>">
      </div>
      <div class="form-field">
        <label for="hoten">Quê quán</label>
        <input type="text" name='quequan' id='quequan' value="<?php echo $_POST['quequan'] ?? "" ?>">
      </div>

      <div class="form-field">
        <label for="bophan">Bộ phận</label>
        <select name="bophan" id="bophan">
          <?php
          for ($i = 0; $i < count($bo_phan); $i++) {
            $id = $bo_phan[$i]['id'];
            $ten = $bo_phan[$i]['ten'];
            echo "<option value='$id'>$ten</option>";
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

      <input type="submit" name="add" value="Thêm">
    </form>
  </main>
</body>

</html>