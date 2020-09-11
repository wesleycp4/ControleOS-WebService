<?php
require_once '../DAO/clienteDAO.php';
require_once '../CONEXAO/conexao.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nome_cliente']) and isset($_POST['contato_cliente']) and isset($_POST['rua_cliente']) and isset($_POST['numero_cliente']) and isset($_POST['bairro_cliente']) and isset($_POST['cidade_cliente']) and isset($_POST['estado_cliente'])) {
        $pdo = conectar();
        $result = criarCliente($pdo, $_POST['nome_cliente'], $_POST['email_cliente'], $_POST['cpf_cliente'], $_POST['contato_cliente'], $_POST['contato2_cliente'], $_POST['rua_cliente'], $_POST['numero_cliente'], $_POST['complemento_cliente'], $_POST['bairro_cliente'], $_POST['cidade_cliente'], $_POST['cep_cliente'], $_POST['estado_cliente']);
        if ($result == 1) {
            $response['error'] = false;
            $response['message'] = "Cliente cadastrado com sucesso!";
        } else if ($result == 2) {
            $response['error'] = true;
            $response['message'] = "Erro, tente novamente.";
        } else if ($result == 0) {
            $response['error'] = true;
            $response['message'] = "Cliente ja esta cadastrado no sistema!";
        }
    } else {
        $response['error'] = true;
        $response['message'] = "Preencha todos os campos!";
    }

} else {
    $response['error'] = true;
    $response['message'] = "Requisição Invalida.";
}

echo json_encode($response);