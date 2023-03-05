


<?php
    require_once('../includes/header.php');
    require_once('../controllers/funcoes_db.php');

    $codigo = $_GET['produto'];
    $sacola = $_GET['sacola'];

    $sql = 'DELETE from sacola_itens where codproduto = ? and codsacola = ?';
    $array = array($codigo,$sacola);

    $retorno = fazAlteracao($sql,$array);

    if($retorno)
        $_SESSION['msg'] = 'Item excluido com sucesso';
    else   
        $_SESSION['msg'] = 'aconteceu algum problema para excluir';

    header('location:./gerenciar_sacola.php');
    