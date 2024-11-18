<?php
include "db.php";

// Consulta para exibir os produtos
$selectProdutos = "SELECT * FROM produtos";
$queryProdutos = $connection->query($selectProdutos);

function exibirProdutos() {
    global $queryProdutos;

    if ($queryProdutos->num_rows > 0) {
        echo "
            <div class='table-container'>
                <table class='product-table'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome do Produto</th>
                            <th>Quantidade</th>
                            <th>Valor por Unidade (R$)</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
        ";

        while ($row = $queryProdutos->fetch_assoc()) {
            $id = htmlspecialchars($row['id']);
            $nome = htmlspecialchars($row['nome']);
            $quantidade = htmlspecialchars($row['quantidade']);
            $valor = htmlspecialchars($row['valor']);

            echo "
                <tr>
                    <td>$id</td>
                    <td>$nome</td>
                    <td>$quantidade</td>
                    <td>R$ " . number_format($valor, 2, ',', '.') . "</td>
                    <td>
                        <button class='btn save-btn' onclick='atualizarDados($id)'>Alterar</button>
                        <button class='btn delete-btn' onclick='apagarDados($id)'>Apagar</button>
                    </td>
                </tr>
            ";
        }

        echo "
                    </tbody>
                </table>
            </div>
        ";
    } else {
        echo "<p class='no-products'>Nenhum produto cadastrado.</p>";
    }
}

$connection->close();
?>
