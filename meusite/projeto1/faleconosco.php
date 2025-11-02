<?php
require_once 'admin/config.inc.php';

// Processar exclusão
if(isset($_GET['excluir'])) {
    $id = (int)$_GET['excluir'];
    try {
        $stmt = $conn->prepare("DELETE FROM alistamentos WHERE id = ?");
        $stmt->execute([$id]);
        echo "<div class='alert alert-success'>✓ Registro excluído com sucesso!</div>";
    } catch(PDOException $e) {
        echo "<div class='alert alert-error'>✗ Erro ao excluir: " . $e->getMessage() . "</div>";
    }
}

// Processar edição
if(isset($_POST['editar'])) {
    $id = (int)$_POST['id'];
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $numero = trim($_POST['numero']);
    $morre = isset($_POST['morre']) ? 1 : 0;

    try {
        $stmt = $conn->prepare("UPDATE alistamentos SET nome = ?, email = ?, numero = ?, morre_pela_patria = ? WHERE id = ?");
        $stmt->execute([$nome, $email, $numero, $morre, $id]);
        echo "<div class='alert alert-success'>✓ Registro atualizado com sucesso!</div>";
    } catch(PDOException $e) {
        echo "<div class='alert alert-error'>✗ Erro ao atualizar: " . $e->getMessage() . "</div>";
    }
}

// Processar novo cadastro
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['editar'])) {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $numero = trim($_POST['numero']);
    $morre = isset($_POST['morre']) ? 1 : 0;

    try {
        $stmt = $conn->prepare("INSERT INTO alistamentos (nome, email, numero, morre_pela_patria) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $numero, $morre]);
        echo "<div class='alert alert-success'>✓ Alistamento registrado com sucesso!</div>";
    } catch(PDOException $e) {
        echo "<div class='alert alert-error'>✗ Erro ao registrar: " . $e->getMessage() . "</div>";
    }
}

// Buscar registro para edição
$registro_edicao = null;
if(isset($_GET['editar'])) {
    $id = (int)$_GET['editar'];
    try {
        $stmt = $conn->prepare("SELECT * FROM alistamentos WHERE id = ?");
        $stmt->execute([$id]);
        $registro_edicao = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "<div class='alert alert-error'>✗ Erro ao buscar registro: " . $e->getMessage() . "</div>";
    }
}
?>

<h2>🎖️ ALISTAMENTO MILITAR - CRUD COMPLETO</h2>

<div class="card">
    <?php if($registro_edicao): ?>
        <h3>✏️ EDITAR ALISTAMENTO</h3>
    <?php else: ?>
        <h3>➕ NOVO ALISTAMENTO</h3>
    <?php endif; ?>

    <form method="POST">
        <?php if($registro_edicao): ?>
            <input type="hidden" name="id" value="<?php echo $registro_edicao['id']; ?>">
            <input type="hidden" name="editar" value="1">
        <?php endif; ?>

        <label for="nome">📝 Nome Completo:</label>
        <input type="text" id="nome" name="nome" 
               value="<?php echo $registro_edicao ? htmlspecialchars($registro_edicao['nome']) : ''; ?>" 
               placeholder="Digite seu nome completo" required>

        <label for="email">📧 E-mail:</label>
        <input type="email" id="email" name="email" 
               value="<?php echo $registro_edicao ? htmlspecialchars($registro_edicao['email']) : ''; ?>" 
               placeholder="seu@email.com" required>

        <label for="numero">📱 Número/Telefone:</label>
        <input type="text" id="numero" name="numero" 
               value="<?php echo $registro_edicao ? htmlspecialchars($registro_edicao['numero']) : ''; ?>" 
               placeholder="(00) 00000-0000" required>

        <label for="morre" style="display: flex; align-items: center; cursor: pointer;">
            <input type="checkbox" name="morre" id="morre" style="width: auto; margin-right: 10px;"
                   <?php echo ($registro_edicao && $registro_edicao['morre_pela_patria']) ? 'checked' : ''; ?>>
            <span>⚔️ Comprometo-me a defender a pátria com minha vida se necessário</span>
        </label>

        <button type="submit" class="btn">
            <?php echo $registro_edicao ? '✓ ATUALIZAR CADASTRO' : '✓ CONFIRMAR ALISTAMENTO'; ?>
        </button>

        <?php if($registro_edicao): ?>
            <a href="?pg=faleconosco" class="btn btn-danger" style="margin-top: 10px; display: inline-block;">
                ✗ CANCELAR
            </a>
        <?php endif; ?>
    </form>
</div>

<h2>📋 LISTA DE ALISTADOS</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Número</th>
            <th>Compromisso</th>
            <th>Data Cadastro</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        try {
            $stmt = $conn->query("SELECT * FROM alistamentos ORDER BY data_cadastro DESC");
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['numero']) . "</td>";
                echo "<td>" . ($row['morre_pela_patria'] ? '✓ SIM' : '✗ NÃO') . "</td>";
                echo "<td>" . date('d/m/Y H:i', strtotime($row['data_cadastro'])) . "</td>";
                echo "<td style='white-space: nowrap;'>";
                echo "<a href='?pg=faleconosco&editar=" . $row['id'] . "' class='btn' style='padding: 8px 15px; font-size: 0.85em; margin: 2px;'>✏️ EDITAR</a> ";
                echo "<a href='?pg=faleconosco&excluir=" . $row['id'] . "' class='btn btn-danger' style='padding: 8px 15px; font-size: 0.85em; margin: 2px;' onclick='return confirm(\"Confirma exclusão deste alistamento?\")'>🗑️ EXCLUIR</a>";
                echo "</td>";
                echo "</tr>";
            }
        } catch(PDOException $e) {
            echo "<tr><td colspan='7' class='alert alert-error'>Erro ao listar alistamentos: " . $e->getMessage() . "</td></tr>";
        }
        ?>
    </tbody>
</table>
