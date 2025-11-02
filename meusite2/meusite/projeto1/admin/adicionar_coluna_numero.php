<?php
require_once 'config.inc.php';

try {
    // Tentar adicionar a coluna numero
    $sql = "ALTER TABLE alistamentos ADD COLUMN numero VARCHAR(20) NOT NULL DEFAULT ''";
    $conn->exec($sql);
    echo "✓ Coluna 'numero' adicionada com sucesso na tabela alistamentos!<br>";
} catch(PDOException $e) {
    // Se der erro, verificar se é porque já existe
    if(strpos($e->getMessage(), 'Duplicate column') !== false) {
        echo "ℹ️ A coluna 'numero' já existe na tabela.<br>";
    } else {
        echo "✗ Erro ao adicionar coluna: " . $e->getMessage() . "<br>";
    }
}

// Verificar estrutura da tabela
try {
    $stmt = $conn->query("DESCRIBE alistamentos");
    echo "<br><strong>Estrutura da tabela alistamentos:</strong><br>";
    echo "<pre>";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['Field'] . " - " . $row['Type'] . "\n";
    }
    echo "</pre>";
} catch(PDOException $e) {
    echo "Erro ao verificar tabela: " . $e->getMessage();
}

echo "<br><a href='../index.php?pg=faleconosco'>← Voltar para o sistema</a>";
?>
