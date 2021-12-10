<?php

include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
include_once "util.php";
$pdo = Conexao::getInstance();

$acao = isset($_GET['acao']) ? $_GET['acao'] : $_POST['acao'];

// AÇÕES LIVRO
if ($acao == 'Cadastrar Livro'){
    $stmt = $pdo->prepare('INSERT INTO LIVRO (TITULO, AUTOR, ISBN) VALUES(:titulo, :autor, :isbn)');
    $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
    $stmt->bindParam(':autor', $autor, PDO::PARAM_STR);
    $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $isbn = $_POST['isbn'];
    $stmt->execute();

    header('location:index.php');
}

if ($acao == 'excluirL') {
    $stmt = $pdo->prepare('DELETE FROM LIVRO WHERE ID = :id');
    $stmt->bindParam(':id', $id);
    $id = $_GET['id'];
    $stmt->execute();

    header('location:index.php');
}

if ($acao == 'Alterar Livro') {
    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('UPDATE LIVRO SET TITULO = :titulo, AUTOR = :autor, ISBN = :isbn WHERE ID = :codigo');
    $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
    $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
    $stmt->bindParam(':autor', $autor, PDO::PARAM_STR);
    $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
    $codigo = $_POST['codigo'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $isbn = $_POST['isbn'];
    $stmt->execute();
    header("location:index.php");
}
// FIM AÇÕES LIVRO

// AÇÕES EXEMPLAR
if ($acao == 'Cadastrar Exemplar'){
    $stmt = $pdo->prepare('INSERT INTO EXEMPLAR (NUMERO, DISPONIVEL, LIV_ID) VALUES(:numero, true, :livro)');
    $stmt->bindParam(':numero', $numero, PDO::PARAM_STR);
    $stmt->bindParam(':livro', $livro, PDO::PARAM_STR);
    $numero = $_POST['numero'];
    $livro = $_POST['livro'];
    $stmt->execute();

    header('location:exemplares.php');
}

if ($acao == 'excluirEx') {
    $stmt = $pdo->prepare('DELETE FROM EXEMPLAR WHERE ID = :id');
    $stmt->bindParam(':id', $id);
    $id = $_GET['id'];
    $stmt->execute();

    header('location:exemplares.php');
}

if ($acao == 'Alterar Exemplar') {
    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('UPDATE EXEMPLAR SET NUMERO = :numero, LIV_ID = :livro WHERE ID = :codigo');
    $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
    $stmt->bindParam(':numero', $numero, PDO::PARAM_STR);
    $stmt->bindParam(':livro', $livro, PDO::PARAM_STR);
    $codigo = $_POST['codigo'];
    $numero = $_POST['numero'];
    $livro = $_POST['livro'];
    $stmt->execute();
    header("location:exemplares.php");
}
// FIM AÇÕES EXEMPLAR

// AÇÕES TIPOS
if ($acao == 'Cadastrar Tipo'){
    $stmt = $pdo->prepare('INSERT INTO TIPO_USUARIO (TIPO) VALUES(:tipo)');
    $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
    $tipo = strtoupper($_POST['tipo']);
    $stmt->execute();

    header('location:tipos.php');
}

if ($acao == 'excluirT') {
    $stmt = $pdo->prepare('DELETE FROM TIPO_USUARIO WHERE ID = :id');
    $stmt->bindParam(':id', $id);
    $id = $_GET['id'];
    $stmt->execute();

    header('location:tipos.php');
}

if ($acao == 'Alterar Tipo') {
    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('UPDATE TIPO_USUARIO SET TIPO = :tipo WHERE ID = :codigo');
    $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
    $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
    $codigo = $_POST['codigo'];
    $tipo = $_POST['tipo'];
    $stmt->execute();
    header("location:tipos.php");
}
// FIM AÇÕES TIPOS

// AÇÕES USUARIO
if ($acao == 'Cadastrar Usuario'){
    $stmt = $pdo->prepare('INSERT INTO USUARIO (NOME, USUARIO, SENHA, ATIVADO, TIP_USU_ID) VALUES(:nome, :usuario, :senha, :ativado, :tipo)');
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
    $stmt->bindParam(':ativado', $ativado, PDO::PARAM_STR);
    $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $ativado = $_POST['ativado'];
    $tipo = $_POST['tipo'];
    $stmt->execute();

    header('location:usuarios.php');
}

if ($acao == 'excluirU') {
    $stmt = $pdo->prepare('DELETE FROM USUARIO WHERE ID = :id');
    $stmt->bindParam(':id', $id);
    $id = $_GET['id'];
    $stmt->execute();

    header('location:usuarios.php');
}

if ($acao == 'Alterar Usuario') {
    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('UPDATE USUARIO SET NOME = :nome, USUARIO = :usuario, SENHA = :senha, ATIVADO = :ativado, TIP_USU_ID = :tipo WHERE ID = :codigo');
    $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
    $stmt->bindParam(':ativado', $ativado, PDO::PARAM_STR);
    $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $ativado = $_POST['ativado'];
    $tipo = $_POST['tipo'];
    $stmt->execute();
    header("location:usuarios.php");
}
// FIM AÇÕES USUARIO

// AÇÕES EMPRESTIMO
if ($acao == 'Cadastrar Empréstimo'){
    if (isDisponivelExemplar($_POST['exemplar'])) {
        print('ola');
        $stmt = $pdo->prepare('INSERT INTO EMPRESTIMO (DATAINICIO, DATAFIM, EXE_ID) VALUES(:dataI, :dataF, :exemplar)');
        $stmt->bindParam(':dataI', $dataI, PDO::PARAM_STR);
        $stmt->bindParam(':dataF', $dataF, PDO::PARAM_STR);
        $stmt->bindParam(':exemplar', $exemplar, PDO::PARAM_STR);
        $dataI = date("Y-m-d");
        $dataF = date("Y-m-d", strtotime('+ 15 days'));
        $exemplar = $_POST['exemplar'];
        $stmt->execute();

        $stmt = $pdo->prepare('INSERT INTO USUARIO_EMPRESTIMO (USU_ID, EMP_ID) VALUES(:usuario, (SELECT MAX(ID) FROM EMPRESTIMO))');
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $usuario = $_POST['usuario'];
        $stmt->execute();

        $stmt = $pdo->prepare('UPDATE EXEMPLAR SET DISPONIVEL = false WHERE ID = :exemplar');
        $stmt->bindParam(':exemplar', $exemplar, PDO::PARAM_INT);
        $exemplar = $_POST['exemplar'];
        $stmt->execute();

        header('location:emprestimos.php');
    } else {
        header('location:cadEmps.php?erro');
    }
}

if ($acao == 'excluirE') {
    $stmt = $pdo->prepare('DELETE FROM USUARIO_EMPRESTIMO WHERE EMP_ID = :id');
    $stmt->bindParam(':id', $id);
    $id = $_GET['id'];
    $stmt->execute();

    $stmt = $pdo->prepare('DELETE FROM EMPRESTIMO WHERE ID = :id');
    $stmt->bindParam(':id', $id);
    $id = $_GET['id'];
    $stmt->execute();

    $stmt = $pdo->prepare('UPDATE EXEMPLAR SET DISPONIVEL = true WHERE ID = :exemplar');
    $stmt->bindParam(':exemplar', $exemplar, PDO::PARAM_INT);
    $exemplar = $_GET['exemplar'];
    $stmt->execute();

    header('location:emprestimos.php');
}

if ($acao == 'Alterar Empréstimo') {
    if (isDisponivelExemplar($_POST['exemplar']) || $_POST['exemplar'] == $_POST['exemplarAnt']) {
        $stmt = $pdo->prepare('UPDATE EMPRESTIMO SET DATAINICIO = :dataI, DATAFIM = :dataF, EXE_ID = :exemplar WHERE ID = :codigo');
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $stmt->bindParam(':dataI', $dataI, PDO::PARAM_STR);
        $stmt->bindParam(':dataF', $dataF, PDO::PARAM_STR);
        $stmt->bindParam(':exemplar', $exemplar, PDO::PARAM_STR);
        $codigo = $_POST['codigo'];
        $dataI = date("Y-m-d");
        $dataF = date("Y-m-d", strtotime('+ 15 days'));
        $exemplar = $_POST['exemplar'];
        $stmt->execute();

        $stmt = $pdo->prepare('UPDATE USUARIO_EMPRESTIMO SET USU_ID = :usuario WHERE EMP_ID = :codigo');
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $codigo = $_POST['codigo'];
        $usuario = $_POST['usuario'];
        $stmt->execute();

        $stmt = $pdo->prepare('UPDATE EXEMPLAR SET DISPONIVEL = true WHERE ID = :exemplar');
        $stmt->bindParam(':exemplar', $exemplar, PDO::PARAM_INT);
        $exemplar = $_POST['exemplarAnt'];
        $stmt->execute();

        $stmt = $pdo->prepare('UPDATE EXEMPLAR SET DISPONIVEL = false WHERE ID = :exemplar');
        $stmt->bindParam(':exemplar', $exemplar, PDO::PARAM_INT);
        $exemplar = $_POST['exemplar'];
        $stmt->execute();

        header("location:emprestimos.php");
    } else {
        header('location:emprestimos.php?erro');
    }
}
// FIM AÇÕES EMPRESTIMO
?>