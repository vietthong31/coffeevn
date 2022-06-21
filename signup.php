<?php
require_once "src/db.php";

session_start();

if (isset($_SESSION['login'])) {
  header("Location: dashboard.php");
}

$error = array();

if (isset($_POST["btn"])) {
  $username = $_POST["tk"];
  $pwd = $_POST["mk"];
  $hoTen = $_POST['hoten'];
  $ngaySinh = $_POST['ngaysinh'];
  $queQuan = $_POST['quequan'];
  $currentDate = (new DateTime())->format('Y/m/d');

  if (empty($username) || empty($pwd) || empty($hoTen) || empty($ngaySinh)) {
    array_push($error, "Chưa điền đủ thông tin");
  }

  if (!empty($ngaySinh)) {
    $now = (new DateTime())->getTimestamp();
    $ngaySinhTime = strtotime($ngaySinh);
    $secs = $now - $ngaySinhTime;
    $years = $secs / 86400 / 30.417 / 12;
    if ($years < 18) {
      array_push($error, "Tuổi lớn hơn hoặc bằng 18");
    }
  }

  $result = $con->query("SELECT * FROM nhan_vien WHERE tai_khoan = '$username'");
  if ($result->num_rows > 0) {
    array_push($error, "Tài khoản đã tồn tại");
  }

  if (!empty($error)) {
    $sql = "INSERT INTO nhan_vien VALUES (null, ?, ?, ?, 4, 3, '$currentDate', ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sssss', $hoTen, $ngaySinh, $queQuan, $username, $pwd);
    $success = $stmt->execute();
    if ($success) {
      $_SESSION['signupSuccess'] = true;
      header("Location: success.php");
    }
  }
}

?>


<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký | coffeevn</title>
  <?php include 'component/head.html' ?>
  <link rel="stylesheet" href="resource/style/login.css">
</head>

<body>
  <div id="bg-img"></div>
  <main>
    <h1 class="mb-1">Quản trị mới</h1>
    <ul class="error">
      <?php
      if (isset($error)) {
        for ($i = 0; $i < count($error); $i++) {
          echo "<li>" . $error[$i] . "</li>";
        }
      }
      ?>
    </ul>
    <form action="" method="post" class="login-form">
      <div class="form-field">
        <label for="username" class="required">Tài khoản</label>
        <input type="text" name="tk" id="username" value="<?php if (isset($_POST["tk"])) echo $_POST["tk"] ?>" required>
      </div>

      <div class="form-field">
        <label for="pwd" class="required">Mật khẩu</label>
        <input type="password" name="mk" id="pwd" value="<?php if (isset($_POST["mk"])) echo $_POST["mk"] ?>" required>
      </div>

      <div class="form-field">
        <label for="hoten" class="required">Họ tên</label>
        <input type="text" name="hoten" id="hoten" value="<?php if (isset($_POST["hoten"])) echo $_POST["hoten"] ?>" required>
      </div>

      <div class="form-field">
        <label for="ngaysinh" class="required">Ngày sinh</label>
        <input type="date" name="ngaysinh" id="ngaysinh" value="<?php if (isset($_POST["ngaysinh"])) echo $_POST["ngaysinh"] ?>" required>
      </div>

      <div class="form-field">
        <label for="quequan">Quê quán</label>
        <input type="text" name="quequan" id="quequan" value="<?php if (isset($_POST["quequan"])) echo $_POST["quequan"] ?>">
      </div>
      <input type="submit" name="btn" id="" value="Đăng ký">
    </form>
  </main>
</body>

</html>

<?php


?>