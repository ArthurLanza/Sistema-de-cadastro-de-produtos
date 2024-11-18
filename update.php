<?php
include "db.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];

$sql = "UPDATE produtos SET nome='$nome', quantidade='$quantidade', valor='$valor' WHERE id='$id'";
if ($connection->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
}

$connection->close();
?>
