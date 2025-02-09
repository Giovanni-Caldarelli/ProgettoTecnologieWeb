<?php
$host = 'localhost';
$port = '5432';
$dbname = 'gruppo17';
$user = 'www';
$password = 'tw2024';

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die('Impossibile connettersi al database.');
}
?>

