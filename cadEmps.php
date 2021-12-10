<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    include_once "util.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    if ($acao == 'alterar'){
        $codigo = isset($_GET['id']) ? $_GET['id'] : "";
        $sJoin = 'JOIN USUARIO_EMPRESTIMO ON ID = EMP_ID';
        if ($codigo > 0)
            $dados = buscarDados($codigo, 'EMPRESTIMO', $sJoin);
    }
    $sSql = 'SELECT E.ID, L.TITULO FROM EXEMPLAR E JOIN LIVRO L ON L.ID = E.LIV_ID';

    $oPdo = Conexao::getInstance(); 
    $rQry = $oPdo->query($sSql);

    $sSelect = '<select name="exemplar" class="form-control">%s</select>';
    $sOption = '<option value="%s" %s>%s</option>';

    $iId = isset($dados) ? $dados['EXE_ID'] : '';

    $aOptionF = [];
    while ($aTipo = $rQry->fetch(PDO::FETCH_BOTH)) {
        $aOptionF[] = sprintf(
            $sOption
            , $aTipo['ID']
            , $iId == $aTipo['ID'] ? 'selected' : ''
            , $aTipo['TITULO'] 
        );
    }

    $sSelect = sprintf(
        $sSelect
        , implode(' ', $aOptionF)
    );

    $sSql = 'SELECT U.ID, U.NOME FROM USUARIO U';

    $oPdo = Conexao::getInstance(); 
    $rQry = $oPdo->query($sSql);

    $sSelect1 = '<select name="usuario" class="form-control">%s</select>';
    $sOption1 = '<option value="%s" %s>%s</option>';

    $iId = isset($dados) ? $dados['USU_ID'] : '';

    $aOptionF = [];
    while ($aTipo = $rQry->fetch(PDO::FETCH_BOTH)) {
        $aOptionF[] = sprintf(
            $sOption1
            , $aTipo['ID']
            , $iId == $aTipo['ID'] ? 'selected' : ''
            , $aTipo['NOME'] 
        );
    }

    $sSelect1 = sprintf(
        $sSelect1
        , implode(' ', $aOptionF)
    );
    $pg = 'cadE';
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sistema Empréstimo Livros</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
<?php include "menu.php"; ?>
    <div class="container">
        <?php
            if (isset($_GET['erro'])) {
                print('<div class="alert alert-danger" role="alert">Exemplar Indisponível!</div>');
            }
        ?>
        <form method="post" action="funcoes.php">
            <fieldset>
                <legend>Cadastro de Empréstimo</legend>
                <input type="hidden" class="form-control" name="codigo" value="<?=isset($dados) ? $dados['ID'] : ''?>">
                <input type="hidden" class="form-control" name="exemplarAnt" value="<?=isset($dados) ? $dados['EXE_ID'] : ''?>">
                
                <div class="mb-3">
                    <label for="tipo" class="form-label">Exemplares</label>
                    <?= $sSelect ?>
                </div>

                <div class="mb-3">
                    <label for="tipo" class="form-label">Usuário</label>
                    <?= $sSelect1 ?>
                </div>
                
                <div class="mb-3" style="margin-right: 50%; margin-left: 50%;">
                    <input type="submit" class="btn btn-primary" name="acao" id="acao" value="<?=$acao == 'alterar' ? 'Alterar Empréstimo' : 'Cadastrar Empréstimo'?>">
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>
