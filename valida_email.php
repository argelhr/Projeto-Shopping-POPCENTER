<?php
    session_start();
    require_once('./controllers/funcoes_db.php');
    
    $array = array($_GET['h']);
    $sql = 'update pessoas set ativo = true where md5(email) = ? and ativo is false';

    $retorno = fazAlteracao($sql,$array);
    if($retorno){
        $_SESSION['msg'] = 'Cadastro validado!';
    }
    else{
        $_SESSION['msg'] = 'Ocorreu algum problema...';
    }

    header('location:./login.php')
?>