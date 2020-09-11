<?php
require_once '../DAO/usuarioDAO.php';
require_once '../CONEXAO/conexao.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['usuario']) and isset($_POST['senha'])) {
        $pdo = conectar();
        if (usuarioLogin($pdo, $_POST['usuario'], $_POST['senha'])) {
            $usuario = getUsuarioByNome($pdo, $_POST['usuario']);
            $response['error'] = false;
            $response['usuario'] = $_POST['usuario'];
        } else {
            $response['error'] = true;
            $response['message'] = "Usuario ou senha invalido";
        }
    } else {
        $response['error'] = true;
        $response['message'] = "Preencha todos os campos";
    }
}

echo json_encode($response);