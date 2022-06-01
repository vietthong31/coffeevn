<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý CoffeeVN</title>
  <?php include 'component/head.html' ?>
  <link rel="stylesheet" href="resource/style/dashboard.css">
</head>

<body>
  <?php include 'component/header.php' ?>
  <?php include 'component/panel.php' ?>
  <main>
    <h1>Dashboard</h1>
    <div id='statistic'>
      <div>
        <span>Nhân viên</span>
        <span class="number">300</span>
      </div>
      <div>
        <span>Sản phẩm</span>
        <span class="number">33</span>
      </div>
      <div>
        <span>Doanh thu</span>
        <span class="number">30.000</span>
      </div>
    </div>
  </main>
  <?php include 'component/script.html' ?>
</body>

</html>