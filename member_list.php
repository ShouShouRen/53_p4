<?php
  session_start();
  require_once("pdo.php");
  extract($_POST);
  if(!isset($_SESSION["AUTH"])){
    header("Location: logout.php");
  }
  $sql = "SELECT * FROM users";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  $sql_log = "SELECT * FROM login_log";
  $stmt_log = $pdo->prepare($sql);
  $stmt_log->execute();
  $result_log = $stmt_log->fetchAll(PDO::FETCH_ASSOC);
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
  <div class="container" style="margin-top: 86px;">
    <div class="pt-3 pb-5">
      <div class="row justify-content-between align-items-center">
        <h5 class="text-center text-white border-start font-weight-bolder">會員管理</h5>
        <div class="row justify-content-around align-items-center text-white py-3 w-25">
          <input type="number" value="60" id="timeInput" class="form-control w-25">
          <button id="setTimeBtn" class="btn btn-sm btn-outline-light">設定</button>
          <span id="countdown">60秒</span>
          <button id="resetTimeBtn" class="btn btn-sm btn-outline-light">重新計時</button>
        </div>
      </div>
      <div class="p-4 bg-white rounded-lg show-lg">
        <div class="row justify-content align-items-center mb-3">
          <div class="col-6">
            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#adduser">新增使用者</button>
            <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#log">使用者登出入紀錄</button>
            <!-- Modal -->
            <div class="modal fade" id="adduser">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">新增使用者</h5>
                    <button class="close" data-dismiss="modal">
                      <span aria-hidden="true">&times</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="p-4" action="register_store.php" method="post">
                      <div class="py-2">
                        <label for="">使用者帳號</label>
                        <input type="text" name="user" class="form-control my-2" require>
                      </div>
                      <div class="py-2">
                        <label for="">使用者姓名</label>
                        <input type="text" name="user_name" class="form-control my-2" require>
                      </div>
                      <div class="py-2">
                        <label for="">使用者密碼</label>
                        <input type="password" name="pw" class="form-control" require>
                      </div>
                      <div class="text-right"><input type="submit" value="新增" class="btn btn-success"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="log">
              <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">使用者登出入紀錄</h5>
                    <button class="close" data-dismiss="modal">
                      <span aria-hidden="true">&times</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <table class="table p-4">
                      <tr>
                        <th>帳號</th>
                        <th>時間</th>
                        <th>狀態</th>
                      </tr>
                      <?php foreach($result_log as $row){?>
                      <tr>
                        <td><?=$row["user"]?></td>
                        <td><?=$row["login_time"]?></td>
                        <td><?=$row["status"]?></td>
                      </tr>
                      <?php }?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <form id="search-member" class="d-flex justify-content-end align-items-center">
              <div class="d-flex px-2">
                <label for="up-order">升冪</label>
                <input type="radio" name="use" id="up-order" value="up">
              </div>
              <div class="d-flex px-2">
                <label for="down-order">降冪</label>
                <input type="radio" name="use" id="down-order" value="down">
              </div>
              <input type="search" name="search" id="search-input" placeholder="請輸入使用者資料"
                class="form-control w-50 mr-2">
              <button type="submit" class="btn btn-secondary">查詢</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.js"></script>
<script src="./js/script.js"></script>

</html>