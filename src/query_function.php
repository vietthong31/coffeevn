<?php
require_once 'db.php';

function query_bophan()
{
  global $con;
  $result = $con->query("SELECT * FROM bo_phan");
  return $result->fetch_all(MYSQLI_ASSOC);
}


function query_calamviec()
{
  global $con;
  $result = $con->query("SELECT * FROM ca_lam_viec");
  return $result->fetch_all(MYSQLI_ASSOC);
}

function query_danhmuc()
{
  global $con;
  $result = $con->query("SELECT * FROM danh_muc");
  return $result->fetch_all(MYSQLI_ASSOC);
}
