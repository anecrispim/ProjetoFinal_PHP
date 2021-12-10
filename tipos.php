<!DOCTYPE html>
<?php 
    $sFiltro = '';
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    include_once "util.php";
    if (isset($_POST['acao-filtrar'])) {
        $aTipoString = ['TIPO'];
        if (!empty($_POST['busca'])) {
            $sFiltro = sprintf(
                "WHERE %s %s %s"
                , $_POST['filtro']
                , in_array($_POST['filtro'], $aTipoString) ? 'LIKE' : '='
                , in_array($_POST['filtro'], $aTipoString) ? sprintf("'%%%s%%'", $_POST['busca']) : $_POST['busca']
            );
        }
    }
    $pg = 'tipo';
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
        <form method="post">
            <fieldset>
                <legend>Filtro</legend>
                <div class="row">
                    <div class="col-sm-4">
                        <select name="filtro" class="form-select" id="filtro">
                            <option value="ID" <?= isset($_POST['filtro']) && $_POST['filtro'] == 'ID' ? 'selected' : '' ?> >Código</option>
                            <option value="TIPO" <?= isset($_POST['filtro']) && $_POST['filtro'] == 'TIPO' ? 'selected' : '' ?>>Tipo</option>
                        </select>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" placeholder="Buscar..." name="busca" value="<?=isset($_POST['busca']) ? $_POST['busca'] : ''?>" id="busca">
                    </div>
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-success" name="acao-filtrar">Buscar</button>
                    </div>
                </div>
            </fieldset>
            <br><br>
            <fieldset>
            <legend class="table-name">Tipos Usuários</legend>
            <br><br>
            <table class="table table-hover align">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        $sSql = '
                            SELECT *
                              FROM TIPO_USUARIO
                              %s
                        ';
                        
                        $sSql = sprintf($sSql, $sFiltro);

                        $oPdo = Conexao::getInstance(); 
                        $rQry = $oPdo->query($sSql);

                        $sTrCarros = '
                            <tr>
                                <th scope="row">%s</th>
                                <td>%s</td>
                                <td>
                                    <a type="button" class="btn btn-primary" style="width:50%%;" href="cadTipos.php?acao=alterar&id=%s">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a type="button" class="btn btn-danger" style="width:50%%;" id="excluir" href=javascript:excluirRegistro("funcoes.php?acao=excluirT&id=%s")>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        ';

                        while ($aTipo = $rQry->fetch(PDO::FETCH_BOTH)) {
                            printf(
                                $sTrCarros
                                , $aTipo['ID']
                                , $aTipo['TIPO']
                                , $aTipo['ID']
                                , $aTipo['ID']
                            );
                        }
                    ?>
                </tbody>
            </table>
        </fieldset>
        </form>
    </div>
</body>
<script>
    $('#filtro').on('change', function() {
        $('#busca').val('');
    });
    function excluirRegistro(url){
        if (confirm("Deseja realmente excluir este item?"))
            location.href = url;
    }
</script>
</html>
