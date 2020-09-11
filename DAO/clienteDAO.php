<?php
include_once "../CONEXAO/conexao.php";

//adiciona novo cliente, verifica se cpf ja esta cadastrado
function criarCliente($pdo, $nome_cliente, $email_cliente, $cpf_cliente, $contato_cliente, $contato2_cliente, $rua_cliente, $numero_cliente, $complemento_cliente, $bairro_cliente, $cidade_cliente, $cep_cliente, $estado_cliente)
{
    $insere = $pdo->prepare("INSERT INTO `cliente`(`idcliente`,`nome_cliente`,`email_cliente`,`cpf_cliente`,`contato_cliente`,`contato2_cliente`,`rua_cliente`,`numero_cliente`,`complemento_cliente`,`bairro_cliente`,`cidade_cliente`,`cep_cliente`,`estado_cliente`) VALUES (null,:nome_cliente,:email_cliente,:cpf_cliente,:contato_cliente,:contato2_cliente,:rua_cliente,:numero_cliente,:complemento_cliente,:bairro_cliente,:cidade_cliente,:cep_cliente,:estado_cliente)");
    $insere->bindValue(":nome_cliente", $nome_cliente);
    $insere->bindValue(":email_cliente", $email_cliente);
    $insere->bindValue(":cpf_cliente", $cpf_cliente);
    $insere->bindValue(":contato_cliente", $contato_cliente);
    $insere->bindValue(":contato2_cliente", $contato2_cliente);
    $insere->bindValue(":rua_cliente", $rua_cliente);
    $insere->bindValue(":numero_cliente", $numero_cliente);
    $insere->bindValue(":complemento_cliente", $complemento_cliente);
    $insere->bindValue(":bairro_cliente", $bairro_cliente);
    $insere->bindValue(":cidade_cliente", $cidade_cliente);
    $insere->bindValue(":cep_cliente", $cep_cliente);
    $insere->bindValue(":estado_cliente", $estado_cliente);

    $consulta = $pdo->prepare("SELECT nome_cliente, cpf_cliente FROM cliente where nome_cliente = :nome_cliente or cpf_cliente = :cpf_cliente");
    $consulta->bindValue(":nome_cliente", $nome_cliente);
    $consulta->bindValue(":cpf_cliente", $cpf_cliente);
    $consulta->execute();

    if ($consulta->rowCount() <= 0) {
        if ($insere->execute()) {
            return 1;
        } else {
            echo mysqli_connect_errno();
            return 2;
        }
    } else {
        return 0;
    }
}

//lista todas as O.S. em nome do cliente
function getOsByCliente($pdo, $idcliente)
{
    $stmt = $pdo->prepare("SELECT idcliente, cliente.nome_cliente, cliente.email_cliente, cliente.cpf_cliente, cliente.contato_cliente, cliente.contato2_cliente, cliente.rua_cliente, cliente.numero_cliente, cliente.complemento_cliente, cliente.bairro_cliente, cliente.cidade_cliente, cliente.cep_cliente, cliente.estado_cliente, os.idos, os.descricao, os.equipamento, os.imagem, os.dataabertura, os.status, os.datafechamento from cliente, os WHERE idcliente=:idcliente and cliente.idcliente=os.cliente_idcliente ORDER BY os.dataabertura");
    $stmt->bindValue(":idcliente", $idcliente);
    $stmt->execute();

    if ($stmt->rowCount()) {
        $row_all = $stmt->fetchall(PDO::FETCH_ASSOC);
        return $row_all;
    }
}

//mostra todos os dados do cliente
function getClienteById($pdo, $id)
{
    $stmt = $pdo->prepare("SELECT * FROM cliente WHERE idcliente = :id");
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    if ($stmt->rowCount()) {
        $linha = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $linha;
    }
}

//****************************************************autocompletelist com todos os clientes
function getClienteNomeId($pdo)
{
    $stmt = $pdo->prepare("SELECT idcliente, nome_cliente FROM cliente");
    $stmt->execute();
    if ($stmt->rowCount()) {
        $linha = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $linha;
    }
}

//atualiza  dados do cliente
function updateCliente($pdo, $nome_cliente, $email_cliente, $cpf_cliente, $contato_cliente, $contato2_cliente, $rua_cliente, $numero_cliente, $complemento_cliente, $bairro_cliente, $cidade_cliente, $cep_cliente, $estado_cliente, $id)
{
    $stmt = $pdo->prepare("UPDATE cliente SET nome_cliente =:nome_cliente, email_cliente =:email_cliente,contato_cliente =:contato_cliente,contato2_cliente =:contato2_cliente,rua_cliente =:rua_cliente,numero_cliente=:numero_cliente,complemento_cliente=:complemento_cliente,bairro_cliente =:bairro_cliente,cidade_cliente =:cidade_cliente,cep_cliente =:cep_cliente WHERE idcliente =:id;");
    /*$stmt = $pdo->prepare("UPDATE cliente SET nome_cliente =:nome_cliente, email_cliente =:email_cliente,cpf_cliente =:cpf_cliente,contato_cliente =:contato_cliente,contato2_cliente =:contato2_cliente,rua_cliente =:rua_cliente,numero_cliente=:numero_cliente,complemento_cliente=:complemento_cliente,bairro_cliente =:bairro_cliente,cidade_cliente =:cidade_cliente,cep_cliente =:cep_cliente,estado_cliente =:estado_cliente WHERE idcliente =:id;");*/

    $stmt->bindValue(":nome_cliente", $nome_cliente);
    $stmt->bindValue(":email_cliente", $email_cliente);
    //$stmt->bindValue(":cpf_cliente", $cpf_cliente);
    $stmt->bindValue(":contato_cliente", $contato_cliente);
    $stmt->bindValue(":contato2_cliente", $contato2_cliente);
    $stmt->bindValue(":rua_cliente", $rua_cliente);
    $stmt->bindValue(":numero_cliente", $numero_cliente);
    $stmt->bindValue(":complemento_cliente", $complemento_cliente);
    $stmt->bindValue(":bairro_cliente", $bairro_cliente);
    $stmt->bindValue(":cidade_cliente", $cidade_cliente);
    $stmt->bindValue(":cep_cliente", $cep_cliente);
    //$stmt->bindValue(":estado_cliente", $estado_cliente);
    $stmt->bindValue(":id", $id);
    if ($stmt->execute()) {
        return 0;
    } else {
        echo mysqli_connect_errno();
        return 1;
    }
}