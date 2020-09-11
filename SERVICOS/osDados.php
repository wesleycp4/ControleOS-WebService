<?php
require_once '../DAO/osDAO.php';
require_once '../CONEXAO/conexao.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['status'])) {

        $pdo = conectar();
        if (getOsByStatus($pdo, $_POST['status'])) {
            $osDados = getOsByStatus($pdo, $_POST['status']);
            $response['osDados'] = $osDados;

        } else {
            $response['error'] = true;
            $response['message'] = "Status não encontrado";
        }
    } else {
        $response['error'] = true;
        $response['message'] = "Erro, falta definir um status";

    }

} else {
    $response['error'] = true;
    $response['message'] = "Requisição Invalida";
}

echo json_encode($response);
echo json_last_error();

