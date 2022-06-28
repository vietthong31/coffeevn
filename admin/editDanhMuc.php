<?php
session_start();

require_once "../src/check_login.php";
require_once "../src/db.php";
require_once "../src/query_function.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
  header("Location: admin/danhmuc.php");
} else {
  $sql = "SELECT * FROM danh_muc WHERE id = " . $_GET['id'];
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
  <title>Cập nhật sản phẩm</title>
  <?php include '../component/head.html' ?>
  <link rel="stylesheet" href="resource/style/login.css">
</head>

<body>
  <div id='bg-img'></div>
  <main>
    <a href="admin/danhmuc.php"><span class="bi bi-arrow-left"></span>Về trang quản lý</a>
    <h1 class="mb-1">Cập nhật danh mục mã <?php echo $row['id'] ?></h1>

    <form action="src/updateDanhMuc.php" method="post" class="form">
      <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
      <div class="form-field">
        <label for="ten">Tên danh mục</label>
        <input type="text" name='ten' id='ten' value="<?php echo $row['ten'] ?>" required>
      </div>

      <div class="form-field">
        <label for="mota">Mô tả</label>
        <textarea name="mota" id="mota" cols="30" rows="10"><?php echo $row['mo_ta'] ?></textarea>
      </div>

      <input type="submit" name="update" value="Cập nhật">
    </form>
  </main>
</body>

</html>