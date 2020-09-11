<?php
require_once '../DAO/usuarioDAO.php';
require_once '../CONEXAO/conexao.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['usuario'])) {
        $pdo = conectar();
        if (getUsuarioByUsuario($pdo, $_POST['usuario'])) {

            $funcionario = getUsuarioByUsuario($pdo, $_POST['usuario']);
            $response['error'] = false;
            $response['usuario'] = $funcionario;

        } else {
            $response['error'] = true;
            $response['message'] = "Usuario invalido ou nao existe";
        }
    } else {
        $response['error'] = true;
        $response['message'] = "Preencha todos os campos";
    }
}
echo json_encode($response);