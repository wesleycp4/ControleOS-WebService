<?php
include_once "../CONEXAO/conexao.php";

//cria nova os
function criarOS($pdo, $descricao, $equipamento, $idcliente, $idfuncionario)
{
    $insere = $pdo->prepare("INSERT INTO os(idos, descricao, equipamento, imagem, dataabertura, status, cliente_idcliente, funcionario_idfuncionario) VALUES (null, :descricao, :equipamento, null, now(), 0, :idcliente, :idfuncionario)");
    $insere->bindValue(":descricao", $descricao);
    $insere->bindValue(":equipamento", $equipamento);
    $insere->bindValue(":idcliente", $idcliente);
    $insere->bindValue(":idfuncionario", $idfuncionario);

    if ($insere->execute()) {
        //$idosCriada = mysql
        return 1;
    } else {
        echo mysqli_connect_errno();
        return 2;
    }
}

//carrega dados pagina inicial e os filtros
function getOsByStatus($pdo, $status)
{
    if ($status == 0 || $status == 1 || $status == 2 || $status == 3 || $status == 4 || $status == 5 || $status == 6) {
        $stmt = $pdo->prepare("SELECT os.idos, os.descricao, os.dataabertura, os.equipamento, os.status, funcionario.nome, cliente.nome_cliente, cliente.email_cliente, cliente.contato_cliente, cliente.contato2_cliente, cliente.rua_cliente, cliente.numero_cliente, cliente.complemento_cliente, cliente.bairro_cliente, cliente.cidade_cliente, cliente.estado_cliente, cliente.cep_cliente from os, funcionario, cliente WHERE os.status=:status and funcionario.idfuncionario = os.funcionario_idfuncionario and cliente.idcliente=os.cliente_idcliente ORDER BY os.dataabertura, os.idos");
        $stmt->bindValue(":status", $status);
        $stmt->execute();
        if ($stmt->rowCount()) {
            $row_all = $stmt->fetchall(PDO::FETCH_ASSOC);
            return $row_all;
        }
    } else {
        $stmt = $pdo->prepare("SELECT os.idos, os.descricao, os.dataabertura, os.equipamento, os.status, funcionario.nome, cliente.nome_cliente, cliente.email_cliente, cliente.contato_cliente, cliente.contato2_cliente, cliente.rua_cliente, cliente.numero_cliente, cliente.complemento_cliente, cliente.bairro_cliente, cliente.cidade_cliente, cliente.estado_cliente, cliente.cep_cliente from os, funcionario, cliente WHERE os.status!=6 and funcionario.idfuncionario = os.funcionario_idfuncionario and cliente.idcliente=os.cliente_idcliente ORDER BY os.dataabertura, os.idos");
        $stmt->bindValue(":status", $status);
        $stmt->execute();
        if ($stmt->rowCount()) {
            $row_all = $stmt->fetchall(PDO::FETCH_ASSOC);
            return $row_all;
        }
    }

}

//mostra todos os dados da os
function getOsById($pdo, $id)
{
    $stmt = $pdo->prepare("SELECT * FROM os WHERE idos = :id");
    $stmt = $pdo->prepare("SELECT os.idos, os.descricao, os.equipamento, os.imagem, os.dataabertura, os.status, os.datafechamento, funcionario.nome, cliente.nome_cliente, cliente.email_cliente, cliente.cpf_cliente, cliente.contato_cliente, cliente.contato2_cliente, cliente.rua_cliente, cliente.numero_cliente, cliente.complemento_cliente, cliente.bairro_cliente, cliente.cidade_cliente, cliente.cep_cliente, cliente.estado_cliente from os, funcionario, cliente WHERE os.idos=:id and funcionario.idfuncionario = os.funcionario_idfuncionario and cliente.idcliente=os.cliente_idcliente");
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    if ($stmt->rowCount()) {
        $linha = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $linha;
    }
}

//retorna o ultimo id adicionado
function getLastId($pdo)
{
    $stmt = $pdo->prepare("SELECT MAX(idos) from os");
    $stmt->execute();

    //$ultimo_id= $this->conexao->lastInsertId();
    if ($stmt->rowCount()) {
        $linha = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $linha;
    }
}