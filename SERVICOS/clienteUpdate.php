<?php
require_once '../DAO/clienteDAO.php';
require_once '../CONEXAO/conexao.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdo = conectar();
    if (isset($_POST['idcliente'])) {

        $pdo = conectar();
        $result = updateCliente($pdo, $_POST['nome_cliente'], $_POST['email_cliente'], $_POST['cpf_cliente'], $_POST['contato_cliente'], $_POST['contato2_cliente'], $_POST['rua_cliente'], $_POST['numero_cliente'], $_POST['complemento_cliente'], $_POST['bairro_cliente'], $_POST['cidade_cliente'], $_POST['cep_cliente'], $_POST['estado_cliente'], $_POST['idcliente']);
        if ($result == 0) {
            $response['error'] = false;
            $response['message'] = "Cadastro atualizado!";
        } else if ($result == 1) {
            $response['error'] = true;
            $response['message'] = "Um erro ocorreu tente novamente";
        }

    } else {
        $response['error'] = true;
        $response['message'] = "Preencha todos os campos";
    }

} else {
    $response['error'] = true;
    $response['message'] = "Requisição Invalida";

}
echo json_encode($response);