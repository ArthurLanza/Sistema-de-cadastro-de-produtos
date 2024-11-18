<?php
include "db.php";

// Defina o nome de usuário e a senha que deseja cadastrar
$username = "admin";
$password = password_hash("12345", PASSWORD_DEFAULT);

// Inserir o usuário no banco de dados
$sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";
if ($connection->query($sql) === TRUE) {
    echo "Usuário cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar usuário: " . $connection->error;
}

$connection->close();
?>
