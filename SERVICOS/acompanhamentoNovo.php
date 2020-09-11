<?php
require_once '../DAO/acompanhamentoDAO.php';
require_once '../CONEXAO/conexao.php';
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['descricao']) and isset($_POST['idos']) and isset($_POST['idfuncionario'])) {
        $pdo =conectar();
        $result = adicionaAcompanhamento($pdo,$_POST['descricao'], $_POST['idos'], $_POST['idfuncionario']);
        if ($result == 1) {
            $response['error'] = false;
            $response['message'] = "Acompanhamento cadastrado com sucesso!";
        } else if ($result == 2){
            $response['error'] = true;
            $response['message'] = "Erro, tente novamente!";
        }
    } else{
        $response['error'] =true;
        $response['message'] = "Preencha todos os campos!";
    }

} else{
    $response['error']= true;
    $response['message'] = "Requisição Invalida.";
}

echo json_encode($response);