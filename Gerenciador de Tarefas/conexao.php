<?php
// Conexão orientada a objetos usando a classe nativa mysqli
$mysqli = new mysqli("localhost", "root", "", "todo_db");

// Verificação obrigatória de erro na conexão
if ($mysqli->connect_errno) {
    die("Falha na conexão com o banco de dados: " . $mysqli->connect_error);
}
?>