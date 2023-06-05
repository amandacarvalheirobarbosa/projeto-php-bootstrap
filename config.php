<?php
$servername = "localhost";
$username = "root";
$password = "0000";
$dbname = "nome_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>
