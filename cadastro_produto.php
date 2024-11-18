<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];

    // Verificar duplicatas
    $verificar = "SELECT * FROM produtos WHERE nome='$nome'";
    $resultado = $connection->query($verificar);

    if ($resultado->num_rows > 0) {
        echo "<script>alert('Produto já cadastrado!'); window.location.href='cadastro_produto.php';</script>";
    } else {
        $sql = "INSERT INTO produtos (nome, quantidade, valor) VALUES ('$nome', '$quantidade', '$valor')";
        if ($connection->query($sql) === TRUE) {
            echo "<script>alert('Produto cadastrado com sucesso!'); window.location.href='index.php';</script>";
        } else {
            echo "Erro ao cadastrar produto: " . $connection->error;
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
    <link rel="stylesheet" href="style.css">
    <title>Cadastrar Produto</title>
</head>
<body>

<!-- Botão de Voltar -->
<a href="index.php" id="btn-voltar" class="btn voltar-btn">← Voltar</a>

<div class="container">
    <h1>Cadastrar Novo Produto</h1>
    <form action="cadastro_produto.php" method="post">
        <label>Nome do produto:</label>
        <input type="text" name="nome" required>

        <label>Quantidade:</label>
        <input type="number" min="0" name="quantidade" required>

        <label>Valor por unidade:</label>
        <input type="number" min="0" step="0.01" name="valor" required>

        <input type="submit" value="Cadastrar Produto">
    </form>
</div>

</body>
</html>
