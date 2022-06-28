<?php
session_start();
require_once "../src/check_login.php";
require_once "../src/db.php";

if (isset($_POST['add'])) {
  $sql = "INSERT INTO bo_phan (ten, mo_ta) VALUES (?, ?)";
  $stmt = $con->prepare($sql);
  $ten = $_POST["ten"];
  $mota = $_POST["mota"];
  $stmt->bind_param("ss", $ten, $mota);
  $stmt->execute();
  header("Location: bophan.php");
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm bộ phận</title>
  <?php include '../component/head.html' ?>
  <link rel="stylesheet" href="resource/style/login.css">
</head>

<body>
  <div id='bg-img'></div>
  <main>
    <a href="admin/bophan.php"><span class="bi bi-arrow-left"></span>Về trang quản lý</a>
    <h1 class="mb-1">Thêm bộ phận mới</h1>

    <form action="" method="post" class="form">
      <div class="form-field">
        <label for="ten">Tên</label>
        <input type="text" name='ten' id='ten' value="<?php echo $_POST['ten'] ?? "" ?>">
      </div>
      <div class="form-field">
        <label for="mota">Mô tả</label>
        <textarea name="mota" id="mota" cols="30" rows="10"><?php echo $_POST['mo_ta'] ?? "" ?></textarea>
      </div>

      <input type="submit" name="add" value="Thêm">
    </form>
  </main>
</body>

</html>