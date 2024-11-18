<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para buscar o usuário no banco de dados
    $sql = "SELECT * FROM usuarios WHERE username = '$username'";
    $result = $connection->query($sql);

    // Verifica se o usuário existe
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifica a senha usando password_verify
        if (password_verify($password, $user['password'])) {
            // Define a sessão e redireciona para a página do sistema
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Senha incorreta!";
        }
    } else {
        $error = "Usuário não encontrado!";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Gerenciamento de Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Entrar">
        </form>
        <div id="login-error"></div>
        <p>Não tem uma conta? <a href="register.php">Cadastre-se aqui</a></p>
    </div>
</body>
</html>

