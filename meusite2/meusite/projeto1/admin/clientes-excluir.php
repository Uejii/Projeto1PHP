<?php
require_once 'config.inc.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
        
        echo "<div class='alert alert-success'>Cliente excluído com sucesso!</div>";
        echo "<meta http-equiv='refresh' content='2;url=?pg=clientes-admin'>";
    } catch(PDOException $e) {
        echo "<div class='alert alert-danger'>Erro ao excluir: " . $e->getMessage() . "</div>";
    }
}
?>



