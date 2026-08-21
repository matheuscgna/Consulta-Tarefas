<?php
require_once 'conexao.php';

$mensagem = '';

// --- 1. PROCESSAMENTO DO CADASTRO (MÉTODO POST) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar'])) {
    // Captura os dados do formulário
    $nome_raw      = $_POST['nome'] ?? '';
    $descricao_raw = $_POST['descricao'] ?? '';

    // Requisito 4: Blindagem contra SQL Injection usando real_escape_string
    $nome      = $mysqli->real_escape_string($nome_raw);
    $descricao = $mysqli->real_escape_string($descricao_raw);

    if (!empty($nome)) {
        $sqlInsert = "INSERT INTO tarefas (nome, descricao) VALUES ('$nome', '$descricao')";
        
        if ($mysqli->query($sqlInsert)) {
            $mensagem = "<p style='color: green;'><strong>Sucesso:</strong> Registro cadastrado com segurança!</p>";
        } else {
            $mensagem = "<p style='color: red;'><strong>Erro no banco:</strong> " . $mysqli->error . "</p>";
        }
    } else {
        $mensagem = "<p style='color: orange;'><strong>Aviso:</strong> O campo nome é obrigatório.</p>";
    }
}

// --- 2. CONSULTA COM FILTRO (MÉTODO GET E SQL INJECTION PROTEGIDO) ---
$busca_raw = $_GET['busca'] ?? '';

// Requisito 4: Sanitização ativa no filtro de busca
$busca_sanitizada = $mysqli->real_escape_string($busca_raw);

// Requisito 3: Consulta com SELECT, WHERE e busca parcial com LIKE
if (!empty($busca_sanitizada)) {
    $sqlSelect = "SELECT id, nome, descricao FROM tarefas 
                  WHERE nome LIKE '%$busca_sanitizada%' 
                     OR descricao LIKE '%$busca_sanitizada%' 
                  ORDER BY id DESC";
} else {
    $sqlSelect = "SELECT id, nome, descricao FROM tarefas ORDER BY id DESC";
}

$resultado = $mysqli->query($sqlSelect);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Gerenciador de Tarefas</title>

</head>
<body>

    <h1>Gerenciador de Tarefas</h1>
    <?= $mensagem; ?>

    <!-- Requisito 2: Formulário Semântico com Método POST e Labels associadas -->
    <div class="secao">
        <h2>Cadastrar Nova Tarefa</h2>
        <form action="index.php" method="POST">
            <div>
                <label for="nome">Nome da Tarefa:</label>
                <input type="text" id="nome" name="nome" required placeholder="Ex: Estudar PHP">
            </div>

            <div>
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="3" placeholder="Ex: Revisar mysqli e SQL Injection"></textarea>
            </div>

            <button type="submit" name="cadastrar">Salvar Registro</button>
        </form>
    </div>

    <!-- Requisito 3: Barra de Pesquisa e Filtro de Busca -->
    <div class="secao">
        <h2>Filtrar Tarefas</h2>
        <form action="index.php" method="GET">
            <label for="busca">Pesquisar por termo parcial:</label>
            <input type="text" id="busca" name="busca" value="<?= htmlspecialchars($busca_raw); ?>" placeholder="Digite um termo para pesquisar...">
            <button type="submit" class="btn-busca">Filtrar</button>
            <a href="index.php"><button type="button">Limpar Filtro</button></a>
        </form>
    </div>

    <!-- Requisito 3: Tabela HTML exibindo os dados percorridos linha a linha -->
    <div class="secao">
        <h2>Registros Gravados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado && $resultado->num_rows > 0): ?>
                    <!-- Requisito 3: Laço de repetição iterativo (while) -->
                    <?php while ($linha = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= $linha['id']; ?></td>
                            <td><?= htmlspecialchars($linha['nome']); ?></td>
                            <td><?= htmlspecialchars($linha['descricao']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Nenhum registro encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>