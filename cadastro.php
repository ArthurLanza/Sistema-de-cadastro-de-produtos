<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verifica se o usuário já existe
    $checkUser = "SELECT * FROM usuarios WHERE username = '$username'";
    $result = $connection->query($checkUser);

    if ($result->num_rows > 0) {
        $error = "Usuário já existe!";
    } else {
        // Inserir novo usuário
        $sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";
        if ($connection->query($sql) === TRUE) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Erro ao cadastrar usuário: " . $connection->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro</title>
</head>
<body>
    <h2>Cadastro</h2>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Usuário" required>
        <input type="password" name="password" placeholder="Senha" required>
        <button type="submit">Cadastrar</button>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
    </form>
</body>
</html>
