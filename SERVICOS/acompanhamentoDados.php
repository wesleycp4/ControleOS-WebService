<?php
require_once '../DAO/acompanhamentoDAO.php';
require_once '../CONEXAO/conexao.php';
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['idos'])){

        $pdo = conectar();
        if(getAcompanhamento($pdo,$_POST['idos'])) {
            $acompanhamentoDados = getAcompanhamento($pdo,$_POST['idos']);
            $response['acompanhamentoDados'] = $acompanhamentoDados;

        }else{
            $response['error'] =true;
            $response['message'] = "id da ordem não encontrado";
        }
    }else{
        $response['error'] =true;
        $response['message'] = "Erro, falta definir uma ordem";

    }

}else{
    $response['error']= true;
    $response['message'] = "Requisição Invalida";
}

echo json_encode($response);
echo json_last_error();

