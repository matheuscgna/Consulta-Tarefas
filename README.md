# 📝 Gerenciador de Tarefas - PHP & MySQLi Seguro

Projeto desenvolvido como protótipo funcional de um sistema web de cadastro e consulta dinâmica de tarefas, utilizando **PHP** orientado a objetos e **MySQLi**. O sistema foi construído focando na implementação de boas práticas de segurança e na **imunidade total contra ataques de SQL Injection**.

---

## 🚀 Funcionalidades

- **Cadastro de Tarefas:** Interface semântica para envio de dados textuais via método `POST`.
- **Listagem Dinâmica:** Tabela HTML dinamicamente populada com registros persistidos no MySQL.
- **Filtro de Busca Parcial:** Pesquisa em tempo real por termos parciais utilizando o operador `LIKE`.
- **Navegação Modular:** Telas separadas para cadastro e consulta de registros.

---

## 🛡️ Camada de Segurança (Blindagem contra SQL Injection)

Para garantir a proteção total do banco de dados contra inserção de comandos maliciosos, o projeto aplica as seguintes rotinas de segurança:

1. **Sanitização de Parâmetros:** Nenhuma variável informada pelo usuário (via `$_POST` ou `$_GET`) é concatenada diretamente nas instruções SQL.
2. **Higienização Nativa com MySQLi:** Utilização do método `$mysqli->real_escape_string()` em todos os parâmetros recebidos para escapar e neutralizar caracteres especiais de controle de string (aspas simples `'`, aspas duplas `"`, apóstrofos, etc.).
3. **Escapamento na Exibição:** Uso de `htmlspecialchars()` na renderização do HTML para mitigar vulnerabilidades de Cross-Site Scripting (XSS).

---

## 🛠️ Tecnologias Utilizadas

- **Front-end:** HTML5 semântico e CSS3 puro.
- **Back-end:** PHP 8.x (Orientado a Objetos com a biblioteca nativa `mysqli`).
- **Banco de Dados:** MySQL / PostgreSQL

---

## 📂 Estrutura do Projeto

```text
├── banco.sql        (Criação da base de dados)
├── conexao.php      (Conexão mysqli POO)
├── index.php        (Tudo-em-um: Formulário, Filtro, Sanitização e Tabela)
└── style.css        (Estilização)
