<?php
// Configurações do Banco de Dados
$host    = 'localhost';
$usuario = 'root';
$senha   = '';
$banco   = 'gerenciador_tarefas';

// Conexão Orientada a Objetos (POO) usando mysqli
$mysqli = new mysqli($host, $usuario, $senha, $banco);

// Requisito 1: Tratamento obrigatório de falha de conexão via $mysqli->connect_errno
if ($mysqli->connect_errno) {
    die("Falha ao conectar ao MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

// Configura o charset para evitar problemas com acentuação
$mysqli->set_charset("utf8mb4");
?>