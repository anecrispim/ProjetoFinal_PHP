<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    include_once "util.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    if ($acao == 'alterar'){
        $codigo = isset($_GET['id']) ? $_GET['id'] : "";
        if ($codigo > 0)
            $dados = buscarDados($codigo, 'TIPO_USUARIO');
    }
    $pg = 'cadT';
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
                <legend>Cadastro de Tipos Usuários</legend>
                <input type="hidden" class="form-control" name="codigo" value="<?=isset($dados) ? $dados['ID'] : ''?>">
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo</label>
                    <input type="text" class="form-control" placeholder="Tipo" name="tipo" id="tipo" value="<?=isset($dados) ? $dados['TIPO'] : ''?>" required>
                </div>
                <div class="mb-3" style="margin-right: 50%; margin-left: 50%;">
                    <input type="submit" class="btn btn-primary" name="acao" id="acao" value="<?=$acao == 'alterar' ? 'Alterar Tipo' : 'Cadastrar Tipo'?>">
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>
<script>
    $('#acao').on('click', function(){
        if ($('#tipo').val().length > 2) {
            alert('O tipo de usuário deve ser abreviado em duas letras.');
            window.location('cadTipos.php');
        }
    });
</script>
