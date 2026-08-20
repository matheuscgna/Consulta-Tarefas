<?php
require_once "conexao.php";

// Captura e sanitização do parâmetro de busca
$busca = "";
if (isset($_GET['busca'])) {
    $busca = $mysqli->real_escape_string($_GET['busca']);
}

// Consulta SELECT com filtro parcial usando o operador LIKE
$sql_select = "SELECT * FROM tarefas WHERE nome LIKE '%$busca%' OR descricao LIKE '%$busca%'";
$result = $mysqli->query($sql_select);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navegação entre as telas -->
    <nav class="nav">
        <a href="index.php">Cadastrar Tarefa</a> | 
        <a href="consulta.php"><strong>Consultar Tarefas</strong></a>
    </nav>

    <h1>Consulta de Tarefas</h1>

    <!-- Formulário de Filtro via GET -->
    <div class="box">
        <form action="consulta.php" method="GET">
            <label for="busca">Filtrar por termo:</label><br>
            <input type="text" name="busca" id="busca" placeholder="Digite para buscar..." value="<?php echo htmlspecialchars($busca); ?>">
            <button type="submit">Buscar</button>
            <a href="consulta.php"><button type="button">Limpar Filtro</button></a>
        </form>
    </div>

    <!-- Tabela Dinâmica com Percurso Iterativo -->
    <h2>Tarefas Cadastradas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Laço iterativo while percorrendo linha a linha usando fetch_assoc
            if ($result && $result->num_rows > 0): 
                while ($row = $result->fetch_assoc()): 
            ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['nome']); ?></td>
                    <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                </tr>
            <?php 
                endwhile; 
            else: 
            ?>
                <tr>
                    <td colspan="3">Nenhuma tarefa encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>