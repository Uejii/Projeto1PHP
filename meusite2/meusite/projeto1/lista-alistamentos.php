<?php
require_once('admin/config.inc.php');

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
?>

<h2>📋 LISTA COMPLETA DE ALISTADOS</h2>

<div class="card">
    <p style="text-align: center;">
        <a href="?pg=faleconosco" class="btn">➕ NOVO ALISTAMENTO</a>
    </p>
</div>

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
            $total = $stmt->rowCount();
            
            if($total > 0) {
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
                    echo "<a href='?pg=lista-alistamentos&excluir=" . $row['id'] . "' class='btn btn-danger' style='padding: 8px 15px; font-size: 0.85em; margin: 2px;' onclick='return confirm(\"Confirma exclusão deste alistamento?\")'>🗑️ EXCLUIR</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' style='text-align: center; padding: 30px;'>Nenhum alistamento cadastrado ainda. <a href='?pg=faleconosco' class='btn' style='margin-left: 10px;'>Cadastrar Primeiro</a></td></tr>";
            }
        } catch(PDOException $e) {
            echo "<tr><td colspan='7' class='alert alert-error'>Erro ao listar alistamentos: " . $e->getMessage() . "</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php if($total > 0): ?>
<div class="card" style="margin-top: 20px;">
    <p style="text-align: center; font-size: 1.2em;">
        <strong>📊 Total de Alistados: <?php echo $total; ?></strong>
    </p>
</div>
<?php endif; ?>
