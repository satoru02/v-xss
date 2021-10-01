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
  <?php
  require_once 'db_config.php';
  $todo_name = $_POST['title'];
  $detail = $_POST['detail'];
  try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
     die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("INSERT INTO todos(title, detail) VALUES (?,?)");
    $stmt->bind_param("ss", $todo_name, $detail);
    $stmt->execute();
    echo "<p>タスクに追加しました。</p><br>";
    echo "<a href='index.php'>トップページへ戻る</a>";
  } catch(Exception $e) {
    echo "エラー発生:" . htmlspecialchars($e->getMessage(),ENT_QUOTES,'UTF-8') . "<br>";
    die();
  }
?>
</body>
</html>