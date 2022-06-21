<?php
require_once 'db.php';

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $hoten = $_POST['hoten'] ?? "";
  $ngaysinh = $_POST['ngaysinh'] ?? "";
  $quequan = $_POST['quequan'] ?? "";
  $bophan = $_POST['bophan'] ?? "";
  $calam = $_POST['calam'] ?? "";

  $update = "UPDATE nhan_vien SET ho_ten = ?, ngay_sinh = ?, que_quan = ?, id_bo_phan = ?, id_ca_lam = ? WHERE id = ?";
  $stmt = $con->prepare($update);
  $stmt->bind_param("ssssss", $hoten, $ngaysinh, $quequan, $bophan, $calam, $id);
  $stmt->execute();
}

header("Location: /cafe/nhanvien.php");
