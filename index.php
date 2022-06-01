<?php
session_start();

if (isset($_SESSION['login'])) {
  header("Location: dashboard.php");
}

require_once "src/db.php";

if (isset($_POST["btn"])) {
  $username = $_POST["tk"];
  $pwd = $_POST["mk"];

  $sql = "SELECT * FROM nhan_vien WHERE tai_khoan = '$username' and mat_khau = '$pwd'";

  $result = mysqli_query($con, $sql) or die("Truy vấn bị lỗi!!!");
  if ($result && $result->num_rows > 0) {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
  } else {
    $error = $result->num_rows == 0 ? "Xem lại tài khoản/ mật khẩu" : "Truy vấn lỗi";
  }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập quản trị | coffeevn</title>
  <?php include 'component/head.html' ?>
  <link rel="stylesheet" href="resource/style/login.css">
</head>

<body>
  <div id='bg-img'></div>
  <main>
    <h1 class="mb-1">Đăng nhập</h1>
    <em class="error">
      <?php
      if (isset($error)) {
        echo "<span class='bi bi-exclamation-lg'></span>" . $error;
      }
      ?>
    </em>
    <form action="" method="post" class="login-form">
      <div class="form-field">
        <label for="username">Tài khoản</label>
        <input type="text" name="tk" id="username" value="<?php if (isset($_POST["tk"])) echo $_POST["tk"] ?>">
      </div>
      <div class="form-field">
        <label for="pwd">Mật khẩu</label>
        <input type="password" name="mk" id="pwd" value="<?php if (isset($_POST["mk"])) echo $_POST["mk"] ?>">
      </div>
      <input type="submit" name="btn" id="" value="Đăng nhập">
    </form>
  </main>
</body>

</html>