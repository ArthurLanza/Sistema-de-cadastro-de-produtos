<?php
include "db.php";

// Consulta para exibir os produtos
$selectProdutos = "SELECT * FROM produtos";
$queryProdutos = $connection->query($selectProdutos);

function exibirProdutos() {
    global $queryProdutos;

    if ($queryProdutos->num_rows > 0) {
        echo "
            <div id='tabela-container' class='hidden'>
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
            </div>
        ";
    } else {
        echo "<p class='no-products'>Nenhum produto cadastrado.</p>";
    }
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro de Produtos</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Botão de Voltar -->
<a href="index.php" id="btn-voltar" class="btn voltar-btn">← Voltar</a>

<!-- Botão para ver produtos -->
<button id="ver-produtos-btn" class="btn ver-btn">Ver Produtos</button>

<!-- Tabela de produtos exibida via PHP -->
<?php exibirProdutos(); ?>

<script>
// Exibir a tabela ao clicar no botão "Ver Produtos"
document.getElementById("ver-produtos-btn").addEventListener("click", function () {
    const tabelaContainer = document.getElementById("tabela-container");
    tabelaContainer.classList.toggle("hidden");
});

// Função para voltar à página anterior
function voltarPagina() {
    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = "index.php";
    }
}
</script>

</body>
</html>
