<?php
define('DATABASE', 'ssk98');
define('USERNAME', 'ssk98');
define('PASSWORD', 'shaffer58');
define('CONNECTION', 'sql2.njit.edu');
class dbConnection
{
protected static $connection;
private function __construct()
{
try 
{
self::$connection = new PDO('mysql:host=' . CONNECTION . ';dbname=' . DATABASE, USERNAME, PASSWORD);
self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo 'Connected successfully <br>';
} 
catch (PDOException $e) 
{
echo 'Connection failed ' . $e->getMessage() . '<br>';
}
}
public static function getConnection()
{
if (!self::$connection)
{
new dbConnection();
}
return self::$connection;
}
}
class accounts
{
private static $sql;
private static $count;
private static $recordSet;
public static function fetchRecords()
{
$connection = dbConnection::getConnection();
$tableName = get_called_class();
$stmt = $connection->prepare('SELECT * FROM ' . $tableName . ' WHERE id < 6');
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
self::$recordSet = $stmt->fetchAll();
}
public static function countRecords()
{
self::$count = count(self::$recordSet);
}
public static function createTable()
{
if (self::$count > 0) {
self::$sql .= '<table>';
self::$sql .= '<tr>';
$firstRow = self::$recordSet[0];
foreach ($firstRow as $key => $value) {
self::$sql .= "<th>$key</th>";
}
self::$sql .= '</tr>';
foreach (self::$recordSet as $record) {
self::$sql .= '<tr>';
foreach ($record as $key => $value) {
self::$sql .= "<td>$value</td>";
}
self::$sql .= '</tr>';
}
self::$sql .= '</table>';
} 
else 
{
self::$sql .= "No records";
}
}
public static function printResults()
{
echo " Number of records returned: " . self::$count . " </br> ";
echo self::$sql;
}
}
accounts::fetchRecords();
accounts::countRecords();
accounts::createTable();
accounts::printResults();
?>
