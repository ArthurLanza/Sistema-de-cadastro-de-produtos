# 📦 Sistema de Gerenciamento de Produtos

Um sistema web simples para gerenciamento de produtos, que permite cadastro, visualização, edição e exclusão de itens. Este projeto foi desenvolvido como parte de uma disciplina de Desenvolvimento Web e inclui autenticação de usuários.

## 📋 Funcionalidades

### ✅ Funcionalidades Implementadas

- **Cadastro de Produtos**
  - Permite cadastrar novos produtos, incluindo nome, quantidade e valor por unidade
- **Listagem de Produtos**
  - Exibe todos os produtos cadastrados em uma tabela com informações detalhadas
- **Atualização de Produtos**
  - Possibilita a edição dos produtos diretamente na tabela, com confirmação de alteração
- **Exclusão de Produtos**
  - Permite excluir produtos da lista, com confirmação antes de remover
- **Prevenção de Duplicidade**
  - O sistema verifica se o produto já existe antes de cadastrá-lo
- **Autenticação de Usuários**
  - Tela de login para acesso ao sistema, protegendo o gerenciamento de produtos
- **Notificações ao Usuário**
  - Exibe notificações visuais para informar o sucesso ou falha de ações como cadastro, edição e exclusão

### 🔜 Funcionalidades Futuras

- **Busca e Filtro de Produtos**
  - Facilitar a pesquisa de produtos na lista
- **Exportação de Dados**
  - Permitir exportar a lista de produtos em formatos como CSV ou Excel
- **Histórico de Alterações**
  - Exibir log com informações sobre alterações feitas nos produtos
- **Relatório de Estoque**
  - Gerar um relatório em PDF com todos os produtos cadastrados

## 🛠️ Tecnologias Utilizadas

### Front-end
- **HTML5**: Estrutura da aplicação
- **CSS3**: Estilização e design responsivo
- **JavaScript**: Funcionalidades de interação e notificações
- **Ajax (XMLHttpRequest)**: Comunicação assíncrona para atualização de dados sem recarregar a página

### Back-end
- **PHP**: Back-end e manipulação de dados
- **MySQL**: Banco de dados para armazenamento dos produtos

## 📂 Estrutura do Projeto

```
sistema-produtos/
├── assets/
│   ├── css/
│   ├── js/
│   └── img/
├── includes/
│   ├── conexao.php
│   └── autenticacao.php
├── produtos/
│   ├── cadastrar.php
│   ├── listar.php
│   ├── editar.php
│   └── excluir.php
├── index.php (login)
└── README.md
```

## 🚀 Como Executar

1. Clone o repositório
2. Configure o ambiente com servidor web (Apache), PHP e MySQL
3. Importe o banco de dados (arquivo .sql incluso)
4. Acesse o sistema através do arquivo index.php

## 📄 Licença

Este projeto está sob licença MIT. Consulte o arquivo LICENSE para mais detalhes.