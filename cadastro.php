<?php
include "db.php";

$nome = $_POST['nome'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];

// Verifica se o produto já existe no banco de dados
$checkProduto = "SELECT * FROM produtos WHERE nome='$nome'";
$result = $connection->query($checkProduto);

if ($result->num_rows > 0) {
    // Produto duplicado
    echo "duplicate";
} else {
    // Insere o produto se não houver duplicação
    $sql = "INSERT INTO produtos (nome, quantidade, valor) VALUES ('$nome', '$quantidade', '$valor')";
    if ($connection->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
}

$connection->close();
?>
