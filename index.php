<?php
 
 $name = 'mysql:host=sql1.njit.edu';
 $dbname = 'ssk98';
 $username = 'ssk98';
 $password = 'shaffer58';
 
 
 try {
 $connection = new PDO($name, $dbname, $username, $password);
 echo '<p>Connected Successfully </p>' .'<br>';
 }
 
 catch (PDOException $e) {
 $error_message = $e -> getMessage();
 echo "<p> An error occured while connecting to the database :
 $error_message</p>".'<br>';
 }
 ?>