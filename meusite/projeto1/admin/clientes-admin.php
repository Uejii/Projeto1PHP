<?php
require_once 'config.inc.php';

try {
    $stmt = $conn->query("SELECT * FROM clientes ORDER BY nome");
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<h2>Gestão de Clientes</h2>
<a href="?pg=clientes-form" class="btn btn-primary">Novo Cliente</a>
<br><br>

<table class="table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($clientes as $cliente): ?>
        <tr>
            <td><?php echo $cliente['nome']; ?></td>
            <td><?php echo $cliente['email']; ?></td>
            <td><?php echo $cliente['telefone']; ?></td>
            <td>
                <a href="?pg=clientes-form-alterar&id=<?php echo $cliente['id']; ?>" class="btn btn-warning">Editar</a>
                <a href="?pg=clientes-excluir&id=<?php echo $cliente['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


