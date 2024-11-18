<?php

// Informações de login
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastroprodutos";


// Conexão com o banco de dados
$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection->connect_error){
    die($connection->connect_error);
}

?>

<?php
include "db.php";

$username = "admin";
$password = password_hash("12345", PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";
$connection->query($sql);
$connection->close();

echo "Usuário cadastrado!";
?>
