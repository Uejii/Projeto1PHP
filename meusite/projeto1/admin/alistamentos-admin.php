<?php
<?php
require_once 'config.inc.php';

// Exclusão
if(isset($_GET['excluir'])) {
    $id = (int)$_GET['excluir'];
    try {
        $stmt = $conn->prepare("DELETE FROM alistamentos WHERE id = ?");
        $stmt->execute([$id]);
        echo "<div class='alert alert-success'>Registro excluído com sucesso!</div>";
    } catch(PDOException $e) {
        echo "<div class='alert alert-danger'>Erro ao excluir: " . $e->getMessage() . "</div>";
    }
}

// Listagem
echo "<h2 class='mb-4'>Gerenciar Alistamentos</h2>";
echo "<div class='table-responsive'>";
echo "<table class='table table-striped'>";
echo "<thead><tr><th>Nome</th><th>Email</th><th>Morre pela Pátria</th><th>Data</th><th>Ações</th></tr></thead>";
echo "<tbody>";

try {
    $stmt = $conn->query("SELECT * FROM alistamentos ORDER BY data_cadastro DESC");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . ($row['morre_pela_patria'] ? 'Sim' : 'Não') . "</td>";
        echo "<td>" . date('d/m/Y H:i', strtotime($row['data_cadastro'])) . "</td>";
        echo "<td>";
        echo "<a href='?pg=alistamentos-admin&excluir=" . $row['id'] . "' 
              onclick='return confirm(\"Confirma exclusão?\")' 
              class='btn btn-danger btn-sm'>Excluir</a>";
        echo "</td>";
        echo "</tr>";
    }
} catch(PDOException $e) {
    echo "<tr><td colspan='5' class='text-danger'>Erro ao listar registros</td></tr>";
}

echo "</tbody></table></div>";
?>