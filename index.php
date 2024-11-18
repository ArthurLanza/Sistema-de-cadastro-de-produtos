<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sistema de Cadastro de Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 600px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            position: relative;
        }

        h1 {
            margin-bottom: 20px;
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        .welcome {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }

        .content {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
        <h1>Bem-vindo ao Sistema de Cadastro de Produtos!</h1>
        <p class="welcome">Olá, <?= $_SESSION['username'] ?>!</p>
        <div class="content">
            <p>Gerencie seus produtos com facilidade.</p>
            <a href="tabela.php" class="btn">Ver Produtos</a>
            <a href="cadastro.php" class="btn">Cadastrar Novo Produto</a>
        </div>
    </div>
</body>
</html>
