<?php
// filepath: C:\xampp\htdocs\meusite\meusite\projeto1\admin\config.inc.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$dsn  = 'mysql:host=localhost;dbname=meusite;charset=utf8mb4';
$user = 'root';
$pass = '';

try {
    $conn = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Erro de conexão: ' . $e->getMessage());
}

    echo "<h1>Painel Administrativo</h1>";

    $login = True;
    if($login == True){
        include "principal.php";
    }else{
        include "login.php";
    }
?>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="?pg=paginas"> Gestão de Páginas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?pg=noticias"> Noticias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="?pg=clientes-admin"> Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?pg=contato"> Dados de Contato</a>
            </li>
        </ul>
    </div>
</nav>

<?php

    // área de conteúdo
    if(empty($_SERVER["QUERY_STRING"])){
        $var = "principal";
        include_once "$var.php";
    }else{
        $pg = $_GET['pg'];
        include_once "$pg.php";
    }
?>
