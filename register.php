<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<script>document.getElementById('register-error').textContent = 'As senhas não coincidem.';</script>";
        exit();
    }

    // Verificar se o usuário já existe
    $checkUser = "SELECT * FROM usuarios WHERE username = '$username'";
    $result = $connection->query($checkUser);

    if ($result->num_rows > 0) {
        echo "<script>document.getElementById('register-error').textContent = 'Usuário já existe.';</script>";
    } else {
        // Hash da senha e inserção no banco de dados
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insertUser = "INSERT INTO usuarios (username, password) VALUES ('$username', '$hashedPassword')";

        if ($connection->query($insertUser) === TRUE) {
            echo "<script>alert('Cadastro realizado com sucesso! Faça login para acessar.'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>document.getElementById('register-error').textContent = 'Erro ao cadastrar. Tente novamente.';</script>";
        }
    }

    $connection->close();
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Sistema de Gerenciamento de Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="register-container">
        <h2>Cadastro</h2>
        <form action="register.php" method="post">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirme a Senha:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <input type="submit" value="Cadastrar">
        </form>
        <div id="register-error"></div>
        <p>Já tem uma conta? <a href="login.php">Faça login aqui</a></p>
    </div>
</body>
</html>
