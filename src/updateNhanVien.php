<?php
require_once 'db.php';

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $hoten = $_POST['hoten'] ?? "";
  $ngaysinh = $_POST['ngaysinh'] ?? "";
  $quequan = $_POST['quequan'] ?? "";
  $matkhau = $_POST['matkhau'] ?? "";

  $update = "UPDATE nhan_vien SET ho_ten = ?, ngay_sinh = ?, que_quan = ?, mat_khau = ? WHERE id = ?";
  $stmt = $con->prepare($update);
  $stmt->bind_param("sssss", $hoten, $ngaysinh, $quequan, $matkhau, $id);
  $stmt->execute();
}

header("Location: /cafe/account.php");
