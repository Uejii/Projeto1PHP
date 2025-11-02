<?php
require_once 'config.inc.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    try {
        $stmt = $conn->prepare("INSERT INTO clientes (nome, email, telefone) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $email, $telefone]);
        
        echo "<div class='alert alert-success'>Cliente cadastrado com sucesso!</div>";
        echo "<meta http-equiv='refresh' content='2;url=?pg=clientes-admin'>";
    } catch(PDOException $e) {
        echo "<div class='alert alert-danger'>Erro ao cadastrar: " . $e->getMessage() . "</div>";
    }
}
?>


