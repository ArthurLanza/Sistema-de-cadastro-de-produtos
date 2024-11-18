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

<!-- Botão para ver produtos -->
<button id="ver-produtos-btn" class="btn ver-btn">Ver Produtos</button>

<!-- Tabela de produtos exibida via PHP -->
<?php exibirProdutos(); ?>

<script>
// Script para exibir a tabela ao clicar no botão "Ver Produtos"
document.getElementById("ver-produtos-btn").addEventListener("click", function () {
    const tabelaContainer = document.getElementById("tabela-container");
    tabelaContainer.classList.toggle("hidden");
});

// Função para atualizar os dados com confirmação do usuário
function atualizarDados(id) {
    if (confirm("Tem certeza de que deseja salvar as alterações?")) {
        let classValor = document.getElementsByClassName(id);
        let nome = classValor[0].value;
        let quantidade = classValor[1].value;
        let valor = classValor[2].value;

        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "update.php");
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send("id=" + id + "&nome=" + nome + "&quantidade=" + quantidade + "&valor=" + valor);

        xhttp.onload = function () {
            if (xhttp.status == 200) {
                mostrarNotificacao("Alterações salvas com sucesso!", "success");
                location.reload();
            } else {
                mostrarNotificacao("Erro ao salvar alterações!", "error");
            }
        };
    }
}

// Função para apagar os dados com confirmação do usuário
function apagarDados(id) {
    if (confirm("Tem certeza de que deseja excluir este produto?")) {
        const xh = new XMLHttpRequest();
        xh.open("POST", "delete.php");
        xh.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xh.send("id=" + id);

        xh.onload = function () {
            if (xh.status == 200) {
                mostrarNotificacao("Produto excluído com sucesso!", "success");
                location.reload();
            } else {
                mostrarNotificacao("Erro ao excluir o produto!", "error");
            }
        };
    }
}

// Função para exibir notificações
function mostrarNotificacao(mensagem, tipo) {
    const notificacao = document.createElement("div");
    notificacao.classList.add("notificacao", tipo);
    notificacao.innerText = mensagem;
    document.body.appendChild(notificacao);

    // Remover a notificação após 3 segundos
    setTimeout(() => {
        notificacao.remove();
    }, 3000);
}

document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault();

    const nome = document.querySelector("input[name='nome']").value;
    const quantidade = document.querySelector("input[name='quantidade']").value;
    const valor = document.querySelector("input[name='valor']").value;

    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "cadastro.php");
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("nome=" + nome + "&quantidade=" + quantidade + "&valor=" + valor);

    xhttp.onload = function () {
        if (xhttp.responseText === "success") {
            mostrarNotificacao("Produto cadastrado com sucesso!", "success");
            location.reload();
        } else if (xhttp.responseText === "duplicate") {
            mostrarNotificacao("Produto já cadastrado!", "warning");
        } else {
            mostrarNotificacao("Erro ao cadastrar o produto!", "error");
        }
    };
});
</script>

</body>
</html>
