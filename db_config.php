<?php
  require './vendor/autoload.php';
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__, './.env');
  $dotenv->load();
  $username = $_ENV['USERNAME'];
  $password = $_ENV['PASSWORD'];
  $dbname = $_ENV['DBNAME'];
  $servername = $_ENV['SERVERNAME'];
?>