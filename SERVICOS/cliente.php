<?php
require_once '../DAO/clienteDAO.php';
require_once '../CONEXAO/conexao.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cliente'])) {
        $pdo = conectar();
        if (getClienteNomeId($pdo)) {

            $cliente = getClienteNomeId($pdo);
            $response['error'] = false;
            $response['cliente'] = $cliente;

        } else {
            $response['error'] = true;
            $response['message'] = "cliente invalido";
        }
    } else {
        $response['error'] = true;
        $response['message'] = "Preencha todos os campos";
    }

}
echo json_encode($response);