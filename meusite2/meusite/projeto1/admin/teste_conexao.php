<?php
require_once 'config.inc.php';

try {
    $stmt = $conn->query("SELECT 1");
    echo "Conexão com o banco de dados OK!";
} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>