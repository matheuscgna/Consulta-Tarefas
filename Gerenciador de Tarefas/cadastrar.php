<?php
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Sanitização ativamente aplicada usando real_escape_string contra SQL Injection
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $descricao = $mysqli->real_escape_string($_POST['descricao']);

    if (!empty($nome) && !empty($descricao)) {
        $sql_insert = "INSERT INTO tarefas (nome, descricao) VALUES ('$nome', '$descricao')";
        $mysqli->query($sql_insert);
    }
}

// Redireciona para a página de consulta após o cadastro
header("Location: consulta.php");
exit();
?>