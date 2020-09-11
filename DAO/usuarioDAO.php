<?php
include_once "../CONEXAO/conexao.php";

function criarUsuario($pdo, $nome, $email, $contato, $contato2, $usuario, $senha, $adm)
{
    $senha = md5($senha);
    $insere = $pdo->prepare("INSERT INTO `funcionario`(`idfuncionario`, `nome`,`email`,`contato`,`contato2`,`usuario`,`senha`,`adm`) VALUES (null,:nome,:email,:contato,:contato2,:usuario,:senha,:adm)");
    $insere->bindValue(":nome", $nome);
    $insere->bindValue(":email", $email);
    $insere->bindValue(":contato", $contato);
    $insere->bindValue(":contato2", $contato2);
    $insere->bindValue(":usuario", $usuario);
    $insere->bindValue(":senha", $senha);
    $insere->bindValue(":adm", $adm);

    $consulta = $pdo->prepare("SELECT usuario, email FROM funcionario where usuario = :usuario or email = :email");
    $consulta->bindValue(":usuario", $usuario);
    $consulta->bindValue(":email", $email);
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

function usuarioLogin($pdo, $usuario, $senha)
{
    $senha = md5($senha);
    $stmt = $pdo->prepare("SELECT `idfuncionario` FROM `funcionario` WHERE `usuario` = :usuario AND `senha` = :senha");
    $stmt->bindValue(":usuario", $usuario);
    $stmt->bindValue(":senha", $senha);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}

function usuarioLoginAdm($pdo, $usuario, $senha, $adm)
{
    $senha = md5($senha);
    $stmt = $pdo->prepare("SELECT `idfuncionario` FROM `funcionario` WHERE `usuario` = :usuario AND `senha` = :senha AND `adm` = :adm");
    $stmt->bindValue(":usuario", $usuario);
    $stmt->bindValue(":senha", $senha);
    $stmt->bindValue(":adm", $adm);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}

function getUsuarioByNome($pdo, $usuario)
{
    $stmt = $pdo->prepare("SELECT usuario, senha FROM funcionario WHERE usuario=:usuario");
    $stmt->bindValue(":usuario", $usuario);
    $stmt->execute();
    if ($stmt->rowCount()) {
        $row_all = $stmt->fetchall(PDO::FETCH_ASSOC);
        return $row_all;
    }
}

function getUsuarioById($pdo, $id)
{
    $stmt = $pdo->prepare("SELECT * FROM funcionario WHERE idfuncionario=:id");
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    if ($stmt->rowCount()) {
        $linha = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $linha;
    }
}

function getUsuarioByUsuario($pdo, $usuario)
{
    $stmt = $pdo->prepare("SELECT * FROM funcionario WHERE usuario=:usuario");
    $stmt->bindValue(":usuario", $usuario);
    $stmt->execute();
    if ($stmt->rowCount()) {
        $linha = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $linha;
    }
}