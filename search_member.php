<?php
  session_start();
  require_once("pdo.php");
  $sql = "SELECT * FROM users";
  extract($_POST);
  if($use == 'up'){
    $sql.=" ORDER BY user_id ASC";
  }else{
    $sql.=" ORDER BY user_id DESC";
  }
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if(isset($_POST["search"])){
    $filtered_result = [];
    if(!empty($search)){
      foreach ($result as $row) {
        if (strpos($row['user'], $search) !== false) {
          array_push($filtered_result, $row);
        } else if (strpos($row['user_id'], $search) !== false) {
          array_push($filtered_result, $row);
        } else if (strpos($row['user_name'], $search) !== false) {
          array_push($filtered_result, $row);
        }
      }
      $html = "";
    foreach ($filtered_result as $row) {
      $html .= '<tr>
          <td>' . $row["user_id"] . '</td>
          <td>' . $row["user"] . '</td>
          <td>' . $row["pw"] . '</td>
          <td>' . $row["user_name"] . '</td>
          <td>';
      switch ($row["role"]) {
          case 0:
              $html .= "管理員";
              break;
          case 1:
              $html .= "一般使用者";
              break;
      }
      $html .= '</td>
          <td>';
      if ($row["id"] == 1) {
          $html .= '<!-- 隱藏切換權限的連結 -->';
      } elseif ($row["id"] == $_SESSION["AUTH"]["id"]) {
          $html .= '<span class="text-secondary">切換權限</span>';
      } else {
          $html .= '<a class="btn btn-outline-secondary" href="switch_role.php?role=' . $row["role"] . '&id=' . $row["id"] . '">權限修改</a>';
      }
      if ($row["id"] == 1) {
          $html .= '<!-- 隱藏修改的連結 -->';
      } else {
          $html .= '<button class="btn btn-outline-secondary btn-edit" data-id="' . $row["id"] . '" data-toggle="modal" data-target="#edit">修改</button>
          <!-- Modal -->
          <div class="modal fade" id="edit">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">修改使用者</h5>
                  <button class="close" data-dismiss="modal">
                    <span>&times</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="p-4">
                    <div class="py-2">
                      <label for="">使用者帳號</label>
                      <input type="text" name="user" id="user" class="form-control my-2" require>
                    </div>
                    <div class="py-2">
                      <label for="">使用者姓名</label>
                      <input type="text" name="user_name" id="user_name" class="form-control my-2" require>
                    </div>
                    <div class="py-2">
                      <label for="">使用者密碼</label>
                      <input type="text" name="pw" id="pw" class="form-control" require>
                      <input type="hidden" name="id" id="id">
                    </div>
                    <div class="text-right">
                      <button type="button" class="btn btn-success savemember">儲存修改</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>';
          $html .= '<a class="btn btn-outline-danger" href="delete_member.php?id=' . $row["id"] . '" onclick="return confirm(\'確定要刪除?\')">刪除</a>';
          $html .= '<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true"></div>';
      }
      $html .= '</td>
      </tr>';
    }
    echo $html;
  }
}
?>