<?php
require_once '../DAO/osDAO.php';
require_once '../CONEXAO/conexao.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $pdo = conectar();
    $idos = getLastId($pdo);

    $response['idos'] = $idos;


} else {
    $response['error'] = true;
    $response['message'] = "Requisição Invalida.";
}

echo json_encode($response);