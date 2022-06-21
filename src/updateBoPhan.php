<?php
require_once 'db.php';

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $ten = $_POST['ten'] ?? "";
  $mota = $_POST['mota'] ?? "";

  $update = "UPDATE bo_phan SET ten = ?, mo_ta = ? WHERE id = ?";
  $stmt = $con->prepare($update);
  $stmt->bind_param("sss", $ten, $mota, $id);
  $stmt->execute();
}

header("Location: /cafe/bophan.php");
