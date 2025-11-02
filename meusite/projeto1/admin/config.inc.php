<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$dsn  = 'mysql:host=localhost;dbname=meusite;charset=utf8mb4';
$user = 'root';
$pass = '';

try {
    $conn = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    // echo "Conexão OK!"; // Descomente para testar
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// Criação do banco de dados e tabela, se não existirem
$sql = "
CREATE DATABASE IF NOT EXISTS meusite;
USE meusite;

CREATE TABLE IF NOT EXISTS alistamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    morre_pela_patria TINYINT(1) DEFAULT 0,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";

try {
    $conn->exec($sql);
    echo "Banco de dados e tabela criados com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao criar banco de dados ou tabela: " . $e->getMessage();
}
?>