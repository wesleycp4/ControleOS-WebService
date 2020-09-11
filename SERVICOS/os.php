<?php

require_once '../DAO/osDAO.php';
require_once '../CONEXAO/conexao.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['idos'])) {
        $pdo = conectar();
        if (getOsById($pdo, $_POST['idos'])) {
            $os = getOsById($pdo, $_POST['idos']);
            $response['os'] = $os;

        } else {
            $response['error'] = true;
            $response['message'] = "ordem serviço não encontrado";
        }
    } else {
        $response['error'] = true;
        $response['message'] = "informe um id";
    }

} else {
    $response['error'] = true;
    $response['message'] = "Requisição Invalida";
}

echo json_encode($response);
echo json_last_error();
