<?php
header("Access-Control-Allow-Origin: *");

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = ''; // one of your db here, it doesn't matter since all of them will be displayed

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8'));
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        

} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
  exit;
}

if (isset($_GET['database']) && isset($_GET['table']) && isset($_GET['structure'])) {
  $database = $_GET['database'];
  $table = $_GET['table'];
  $query = "DESCRIBE $database.$table";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $structure = $stmt->fetchAll(PDO::FETCH_ASSOC);

  header('Content-Type: application/json');
  echo json_encode($structure);


} else if (isset($_GET['database']) && isset($_GET['table'])) {
  $database = $_GET['database'];
  $table = $_GET['table'];
  $query = "SELECT * FROM $database.$table";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

  header('Content-Type: application/json');
  echo json_encode($data);


} else if (isset($_GET['database'])) {
  $database = $_GET['database'];
  $query = "SHOW TABLES IN $database";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $tables = $stmt->fetchAll(PDO::FETCH_NUM);

  header('Content-Type: application/json');
  echo json_encode($tables);


} else {
  $query = 'SHOW DATABASES';
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $databases = $stmt->fetchAll(PDO::FETCH_ASSOC);

  header('Content-Type: application/json');
  echo json_encode($databases);
}