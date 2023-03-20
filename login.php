<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
  <title>咖啡商品展示系統-會員登入</title>
</head>
<body>
  <div class="container">
    <div class="position-relative">
      <div class="col-6 p-5 d-center rounded-lg shadow-lg text-white" style="background-color: rgba(255,255,255,0.4); backdrop-filter: blur(200px);">
        <div class="text-center">
          <img src="./images/logo.png" alt="" class="w-25">
          <h2 class="p-3">咖啡商品展示系統</h2>
        </div>
        <form action="login_check.php" class="p-4" method="post">
          <div class="my-1">
            <label for="">帳號:</label>
            <input type="text" class="form-control my-3" name="user" require>
            <?php if(isset($_SESSION["error"]) && $_SESSION["error"] === "account") {?>
              <div class="text-danger font-weight-bolder">帳好錯誤</div>
            <?php } ;?>
          </div>
          <div class="my-1">
            <label for="">密碼:</label>
            <input type="text" class="form-control my-3" name="pw" require>
            <?php if(isset($_SESSION["error"]) && $_SESSION["error"] === "password") {?>
              <div class="text-danger font-weight-bolder">帳好錯誤</div>
            <?php } ;?>
          </div>
          <div class="my-1">
            <label for="">驗證碼:</label>
            <input type="text" class="form-control my-3" name="user" require>
            <?php if(isset($_SESSION["error"]) && $_SESSION["error"] === "account") {?>
              <div class="text-danger font-weight-bolder">帳好錯誤</div>
            <?php } ;?>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.js"></script>
<script src="./js/script.js"></script>
</html>