<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    include_once "util.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    if ($acao == 'alterar'){
        $codigo = isset($_GET['id']) ? $_GET['id'] : "";
        if ($codigo > 0)
            $dados = buscarDados($codigo, 'USUARIO');
    }
    $sSql = 'SELECT * FROM TIPO_USUARIO';

    $oPdo = Conexao::getInstance(); 
    $rQry = $oPdo->query($sSql);

    $sSelect = '<select name="tipo" class="form-control">%s</select>';
    $sOption = '<option value="%s" %s>%s</option>';

    $iId = isset($dados) ? $dados['TIP_USU_ID'] : '';

    $aOptionF = [];
    while ($aTipo = $rQry->fetch(PDO::FETCH_BOTH)) {
        $aOptionF[] = sprintf(
            $sOption
            , $aTipo['ID']
            , $iId == $aTipo['ID'] ? 'selected' : ''
            , $aTipo['TIPO'] 
        );
    }

    $sSelect = sprintf(
        $sSelect
        , implode(' ', $aOptionF)
    );
    $pg = 'cadU';
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
        <form method="post" action="funcoes.php">
            <fieldset>
                <legend><?=$acao == 'alterar' ? 'Alteração' : 'Cadastro'?> de Usuários</legend>
                <input type="hidden" class="form-control" name="codigo" value="<?=isset($dados) ? $dados['ID'] : ''?>">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" placeholder="Nome" name="nome" value="<?=isset($dados) ? $dados['NOME'] : ''?>" required>
                </div>
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuário</label>
                    <input type="text" class="form-control" placeholder="Usuário" name="usuario" value="<?=isset($dados) ? $dados['USUARIO'] : ''?>" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" placeholder="Senha" name="senha" value="<?=isset($dados) ? $dados['SENHA'] : ''?>" required>
                </div>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo Usuário</label>
                    <?= $sSelect ?>
                </div>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo Usuário</label>
                    <select name="ativado" class="form-control">
                        <option value="1" <?=isset($dados) ? ($dados['ATIVADO'] ? 'selected' : '') : ''?>>Sim</option>
                        <option value="0" <?=isset($dados) ? (!$dados['ATIVADO'] ? 'selected' : '') : ''?>>Não</option>
                    </select>
                </div>
                <div class="mb-3" style="margin-right: 50%; margin-left: 50%;">
                    <input type="submit" class="btn btn-primary" name="acao" id="acao" value="<?=$acao == 'alterar' ? 'Alterar Usuario' : 'Cadastrar Usuario'?>">
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>
