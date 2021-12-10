<?php
function datatimeFormat($data){
    return date("d/m/Y H:i:s",strtotime($data));
}

function dataFormat($data){
    return date("d/m/Y",strtotime($data));
}

function dataFormatSave($data){
    return date("Y-m-d",strtotime($data));
}
function buscarDados($codigo, $table, $join = '') {
    $sSql = '
        SELECT * FROM %s %s WHERE ID = %s
    ';

    $sSql = sprintf($sSql, $table, $join, $codigo);

    $oPdo = Conexao::getInstance(); 
    $rQry = $oPdo->query($sSql);

    return $rQry->fetch(PDO::FETCH_BOTH);
}

function isDisponivelExemplar($idEx) {
    $sSql = '
        SELECT DISPONIVEL FROM EXEMPLAR WHERE ID = %s;
    ';

    $sSql = sprintf($sSql, $idEx);
    $oPdo = Conexao::getInstance(); 
    $rQry = $oPdo->query($sSql);

    return $rQry->fetch(PDO::FETCH_BOTH)['DISPONIVEL'];
}

?>