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
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Sistema de Cadastro de Produtos</title>
</head>
<body>
    <h1>Sistema de Cadastro de Produtos</h1>
    
    <!-- Mensagem de feedback -->
    <?php if (isset($msg)) { echo "<p class='feedback'>$msg</p>"; } ?>

    <form action="cadastro.php" method="post" onsubmit="return validarFormulario()">
        <label for="nome">Nome do produto:</label>
        <input type="text" name="nome" id="nome" required>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" id="quantidade" min="1" required>

        <label for="valor">Valor por unidade:</label>
        <input type="number" name="valor" id="valor" min="0.01" step="0.01" required>

        <input type="submit" value="Cadastrar Produto">
    </form>

    <p>Produtos cadastrados:</p>

    <?php
    include "tabela.php";
    exibirProdutos();
    ?>

<script>
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
