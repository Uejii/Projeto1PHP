<?php
// Incluir arquivos
require_once('topo.php');
require_once('menu.php');

// Verificar qual página exibir
$pg = isset($_GET['pg']) ? $_GET['pg'] : 'conteudo';

switch($pg) {
    case 'quemsomos':
        include('quemsomos.php');
        break;
    case 'faleconosco':
        include('faleconosco.php');
        break;
    case 'lista-alistamentos':
        include('lista-alistamentos.php');
        break;
    case 'conteudo':
    default:
        include('conteudo.php');
        break;
}

// Incluir rodapé
require_once('rodape.php');
?>