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
 try {
   if(empty($_GET['id'])) throw new Exception('ID不正');
   $id=(int)$_GET['id'];
   $conn = new mysqli($servername, $username, $password, $dbname);
   if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
   }
   $stmt = $conn->prepare("DELETE FROM todos WHERE id = ?");
   $stmt->bind_param("i", $id);
   $stmt->execute();
   $dbh=null;
   echo "<p>" . "ID:" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . "の削除が完了しました。</p><br>";
   echo "<a href='index.php'>トップページへ戻る</a>";
 } catch (Exception $e) {
   echo "エラー発生:" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
   die();
 }
?>
</body>
</html>