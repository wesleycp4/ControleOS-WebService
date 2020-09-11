<?php
include_once "../CONEXAO/conexao.php";

//cria novo acompanhamento
function adicionaAcompanhamento($pdo, $descricao, $idos, $idfuncionario)
{
    $insere = $pdo->prepare("INSERT INTO acompanhamento (idacompanhamento, descricao_acompanhamento, data_acompanhamento, os_idos, funcionario_idfuncionario) VALUES (null, :descricao, now(), :idos, :idfuncionario )");
    $insere->bindValue(":descricao", $descricao);
    $insere->bindValue(":idos", $idos);
    $insere->bindValue(":idfuncionario", $idfuncionario);

    if ($insere->execute()) {
        return 1;
    } else {
        echo mysqli_connect_errno();
        return 2;
    }
}

//cria novo acompanhamento alterando o status da os
function adicionaAcompanhamentoComStatus($pdo, $descricao, $idos, $idfuncionario)
{
    $insere = $pdo->prepare("INSERT INTO acompanhamento (idacompanhamento, descricao_acompanhamento, data_acompanhamento, os_idos, funcionario_idfuncionario) VALUES (null, :descricao, now(), :idos, :idfuncionario )");
    $insere->bindValue(":descricao", $descricao);
    $insere->bindValue(":idos", $idos);
    $insere->bindValue(":idfuncionario", $idfuncionario);

    if ($insere->execute()) {
        return 1;
    } else {
        echo mysqli_connect_errno();
        return 2;
    }
}

//altera o status da os ao adicionar acompanhamento
function alteraStatus($pdo, $status, $idos)
{
    //$insere = $pdo->prepare("UPDATE os SET status VALUES :status WHERE idos =:idos;");
    $insere = $pdo->prepare("UPDATE os SET status=:status WHERE idos =:idos");
    $insere->bindValue(":status", $status);
    $insere->bindValue(":idos", $idos);
    if ($insere->execute()) {
        return 1;
    } else {
        echo mysqli_connect_errno();
        return 2;
    }
}

//carrega acompanhamentos
function getAcompanhamento($pdo, $idos)
{
    /*$stmt = $pdo->prepare("SELECT acompanhamento.data_acompanhamento, acompanhamento.descricao_acompanhamento, acompanhamento.os_idos, acompanhamento.funcionario_idfuncionario from os, funcionario, acompanhamento WHERE os.idos=:idos and funcionario.idfuncionario = os.funcionario_idfuncionario and os.idos=acompanhamento.os_idos ORDER BY acompanhamento.data_acompanhamento, acompanhamento.idacompanhamento");*/
    $stmt = $pdo->prepare("SELECT acompanhamento.descricao_acompanhamento, acompanhamento.data_acompanhamento, funcionario.nome  from os, funcionario, acompanhamento WHERE os.idos=:idos and acompanhamento.funcionario_idfuncionario=funcionario.idfuncionario AND acompanhamento.os_idos=os.idos ORDER BY acompanhamento.data_acompanhamento DESC, acompanhamento.idacompanhamento DESC");
    $stmt->bindValue(":idos", $idos);
    $stmt->execute();
    if ($stmt->rowCount()) {
        $row_all = $stmt->fetchall(PDO::FETCH_ASSOC);
        return $row_all;
    }
}
