<?php
require_once 'db.php';
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $stmt = $con->prepare("DELETE FROM bo_phan WHERE id = ?");
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();
  if ($result) {
    header("Location: /cafe/admin/bophan.php");
  }
} else {
  header("Location: /cafe/admin/bophan.php");
}
