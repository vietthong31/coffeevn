<?php
require_once 'db.php';
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $stmt = $con->prepare("DELETE FROM hoa_don WHERE id = ?");
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();
}

header("Location: /cafe/hoadon.php");
