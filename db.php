<?php
$type     = 'mysql';                    // type of database software
$server   = 'localhost';                // host name
$database = 'tiger-web-2';              // database name
$port     = '';                         // the port the host is spun on
$charset  = 'utf8mb4';                  // UTF-8 encoding using 4 bytes of data

/* USER CREDENTIALS */
$username = 'root';                     // enter your username
$password = '';                         // enter your password


$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
];

$dsn = "$type:host=$server;dbname=$database;port=$port;charset=$charset;";
try {
  $pdo = new PDO($dsn, $username, $password, $options);
  echo "Connected successfully";
} catch (PDOException $e) {
  throw new PDOException($e->getMessage(), $e->getCode());
}
?>
