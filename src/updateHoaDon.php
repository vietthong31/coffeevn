<?php
require_once 'db.php';

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $ngay = $_POST['ngay'] ?? "";
  $tinhtrang = $_POST['tinhtrang'] ?? "";

  $update = "UPDATE hoa_don SET ngay = ?, tinh_trang = ? WHERE id = ?";
  $stmt = $con->prepare($update);
  $stmt->bind_param("ssi", $ngay, $tinhtrang, $id);
  $stmt->execute();
}

header("Location: /cafe/hoadon.php");
