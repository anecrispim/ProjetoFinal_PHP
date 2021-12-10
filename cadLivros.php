<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    include_once "util.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    if ($acao == 'alterar'){
        $codigo = isset($_GET['id']) ? $_GET['id'] : "";
        if ($codigo > 0)
            $dados = buscarDados($codigo, 'LIVRO');
    }
    $pg = 'cadL';
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
                <legend><?=$acao == 'alterar' ? 'Alteração' : 'Cadastro'?> de Livros</legend>
                <input type="hidden" class="form-control" name="codigo" value="<?=isset($dados) ? $dados['ID'] : ''?>">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" placeholder="Título" name="titulo" value="<?=isset($dados) ? $dados['TITULO'] : ''?>" required>
                </div>
                <div class="mb-3">
                    <label for="autor" class="form-label">Autor</label>
                    <input type="text" class="form-control" placeholder="autor" name="autor" value="<?=isset($dados) ? $dados['AUTOR'] : ''?>" required>
                </div>
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" placeholder="ISBN" name="isbn" value="<?=isset($dados) ? $dados['ISBN'] : ''?>" required>
                </div>
                <div class="mb-3" style="margin-right: 50%; margin-left: 50%;">
                    <input type="submit" class="btn btn-primary" name="acao" value="<?=$acao == 'alterar' ? 'Alterar Livro' : 'Cadastrar Livro'?>">
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>
