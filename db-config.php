// db-config.php
//Edit here
<?php
  $host = 'localhost';
  $user = 'database_user';
  $password = 'password';
  $dbname = 'database_name';

  $db = mysqli_connect($host, $user, $password, $dbname);
  if (!$db) {
    die('Error connecting to database: ' . mysqli_error($db));
  }
?>
