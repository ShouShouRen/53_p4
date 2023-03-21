<?php
  session_start();
  require_once("pdo.php");
  extract($_POST);
  if(!isset($_SESSION["AUTH"])){
    header("Location: logout.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
  <title>咖啡商品展示系統</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a href="index.php" class="navbar-brand">
        <img src="./images/logo.png" class="mx-3 logo" alt="">
        <span>咖啡商品展示系統</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav ml-auto my-2" style="max-height: 100px">
          <li class="nav-item">
            <?php echo $_SESSION["AUTH"]["role"] == 0 ? '<a class="nav-link" href="create_product.php">上架商品</a>':'';?>
          </li>
          <li class="nav-item">
            <?php echo $_SESSION["AUTH"]["role"] == 0 ? '<a class="nav-link" href="member_list.php">會員管理</a>':''; ?>
          </li>
          <li class="nav-item">
            <?php echo isset($_SESSION["AUTH"]) ? '<a class="nav-link btn btn-outline-warning" href="logout.php">登出</a>' : ''; ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</body>
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.js"></script>
<script src="./js/script.js"></script>

</html>