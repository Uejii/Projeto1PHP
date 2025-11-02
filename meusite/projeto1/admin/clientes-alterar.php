<?php
require_once 'config.inc.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    try {
        $stmt = $conn->prepare("UPDATE clientes SET nome = ?, email = ?, telefone = ? WHERE id = ?");
        $stmt->execute([$nome, $email, $telefone, $id]);
        
        echo "<div class='alert alert-success'>Cliente atualizado com sucesso!</div>";
        echo "<meta http-equiv='refresh' content='2;url=?pg=clientes-admin'>";
    } catch(PDOException $e) {
        echo "<div class='alert alert-danger'>Erro ao atualizar: " . $e->getMessage() . "</div>";
    }
}
?>



