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
<div class="red">（注）名前もしくは詳細入力欄にスクリプトを埋め込むと、XSS攻撃が可能。</div>

<?php
  require_once 'db_config.php';
  try {
    if(empty($_GET['id'])) throw new Exception('ID不正');
    $id = (int)$_GET['id'];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM todos WHERE id = $id";
    $result = $conn->query($sql);
    $todo = $result->fetch_assoc();
  } catch (Exception $e) {
    echo "エラー発生:" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
  }
?>

  <h3>更新フォーム</h3>
  <br>
  <form method="post" action="update.php">
    <div>
      <h4>タスク</h4>
    </div>
    <input class="form" type="text" name="title" value="<?php echo $todo['title'] ?>">
    <br>
    <div>
      <h4>詳細</h4>
      <textarea class="form" name="detail" cols="40" rows="10">
        <?php echo $todo['detail']; ?>
      </textarea>
    </div>
    <br>
    終わった？
    <input type="radio" name="done" value="0" <?php if($todo['done'] === 0) echo "checked" ?>>まだ
    <input type="radio" name="done" value="1" <?php if($todo['done'] === 1) echo "checked" ?>>終わった！
    <br>
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($todo['id'], ENT_QUOTES, 'UTF-8'); ?>">
    <br>
    <input class="reg_button" type="submit" value="送信">
  </form>
</body>
</html>