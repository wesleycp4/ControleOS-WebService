<?php
require_once '../DAO/usuarioDAO.php';
require_once '../CONEXAO/conexao.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nome']) and isset($_POST['email']) and isset($_POST['contato']) and isset($_POST['usuario']) and isset($_POST['senha'])) {
        $pdo = conectar();
        $result = criarUsuario($pdo, $_POST['nome'], $_POST['email'], $_POST['contato'], $_POST['contato2'], $_POST['usuario'], $_POST['senha'], $_POST['adm']);
        if ($result == 1) {
            $response['error'] = false;
            $response['message'] = "Usuario cadastrado com sucesso!";
        } else if ($result == 2) {
            $response['error'] = true;
            $response['message'] = "Erro, tente novamente!";
        } else if ($result == 0) {
            $response['error'] = true;
            $response['message'] = "Usuario ja cadastrado entre com um usuario e email diferentes!";
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