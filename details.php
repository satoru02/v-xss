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
  <div class="red">（注）タスク名と詳細を表示する箇所で、XSS対策を行なっていないため、タスク登録時に名前と詳細の項目に悪意的なスクリプトが埋め込まれた場合このページでXSSが発生。</div>
  <?php
  require_once 'db_config.php';
  try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
     }
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM todos WHERE id = $id";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        echo "<br><h4>タスク</h4>" . $row['title'] . "<br><h4>詳細</h4>" . $row['detail'] . "<br>";
      }
    } else {
      echo "0 results";
    }
    echo "<div><a href='index.php'>トップページへ戻る</a></div>";
  } catch (Exception $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
  }
?>
</body>

</html>

<style>
  a {
    text-decoration: none !important;
    color: #f72585;
    padding: 20;
  }
</style>