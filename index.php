<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>タスク管理アプリ | XSS未対策</title>
</head>

<body class="content">
  <div class="red">（注）タスク名を表示する箇所で、XSS対策を行なっていないため、タスク登録時に名前の項目に悪意的なスクリプトが埋め込まれた場合このページでXSSが発生。</div>
  <table>
    <tr>
      <td class="task_list">
        <h2>タスクリスト</h2>
      </td>
      <td><button type="button" onclick="window.location.href='/form.html'">タスクの追加</button></td>
    </tr>
  </table>
  <?php
   require 'db_config.php';
   $conn = new mysqli($servername, $username, $password, $dbname);
   if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
   }
   try {
     $sql = "SELECT * FROM todos WHERE done=false";
     $result = $conn->query($sql);
     foreach ($result as $row){
      echo "<table>\n";
      echo "<tr>\n";
      echo "</tr>\n";
      foreach ($result as $row){
        echo "<tr>\n";
        echo "<td class=title> ・" . $row['title'] . "</td>\n";
        echo "<td>\n";
        echo "<a href=details.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "><img width=17 height=17 src='/writing.png' alt='details' /></a>\n";
        echo "<a href=edit.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "><img width=17 height=17 src='/pencil.png' alt='edit' /></a>\n";
        echo "<a href=delete.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "><img width=17 height=17 src='/trash.png' alt='edit' /></a>\n";
        echo "</td>\n";
        echo "</tr>\n";
      }
      echo "</table>\n";
      $dbh = null;
   }} catch(Exception $e){
      echo "エラー発生" . htmlspecialchars($e->getMessage(),
      ENT_QUOTES, 'UTF-8') . "<br>";
      die();
     }
  ?>
</body>

</html>

<style>
  a {
    text-decoration: none !important;
    color: #222222;
    margin-left: 15px;
  }
</style>