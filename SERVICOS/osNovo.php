<?php
require_once '../DAO/osDAO.php';
require_once '../CONEXAO/conexao.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['descricao']) and isset($_POST['equipamento']) and isset($_POST['idcliente']) and isset($_POST['idfuncionario'])) {
        $pdo = conectar();
        $result = criarOS($pdo, $_POST['descricao'], $_POST['equipamento'], $_POST['idcliente'], $_POST['idfuncionario']);
        if ($result == 1) {
            $response['error'] = false;
            $response['message'] = "O.S. cadastrado com sucesso!";
        } else if ($result == 2) {
            $response['error'] = true;
            $response['message'] = "Erro, tente novamente!";
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