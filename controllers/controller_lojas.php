<?php
include("funcoes_db.php");
include("../email/envia_email.php");

session_start();

if($_POST['botao'] == 'Adicionar Departamento'){
    
    $nome = $_POST['nome'];
    $array = array($nome);

    $sql = 'select upper(descricao) from departamentos where descricao like upper(?)';

    $retorno = ConsultaSelect($sql,$array);
    if(empty($retorno)){
        $sql = 'insert into departamentos (descricao) values (?)';
        $retorno = fazAlteracao($sql,$array);
        if($retorno){
            $_SESSION['msg'] = 'Departamento registrado com sucesso';
        }
        else{
            $_SESSION['msg'] = 'Aconteceu algum problema na inserção';
        }
    }
    else{
        $_SESSION['msg'] = 'O nome de departamento informado já esta armazenado';
    }

    header('location:../adicionar_departamento.php');
}

if($_POST['botao'] == 'Editar Departamento'){
    
    $descricao = $_POST['nome'];
    $status = $_POST['status'];
    $coddepartamento = $_POST['codigo'];

    $sql = 'update departamentos set descricao = ?,ativo = ? where coddepartamento = ?';
    $array = array($descricao,$status,$coddepartamento);

    $retorno = fazAlteracao($sql,$array);
    
    if($retorno){
        $_SESSION['msg'] = 'Alteração realizada com sucesso';
    }
    else{
        $_SESSION['msg'] = 'Alteração não foi realizada';
    }

    header('location:../gerenciar_departamento.php');
}

if($_POST['botao'] == 'Alocar'){

    // var_dump($_POST['codigo']);
    // die();

    if(!(isset($_POST['codigo']))){
        $_SESSION['msg'] = "Selecione um responsavel para a loja";
        header('location:../alocar_loja.php');
    }
    else{
        $numero = $_POST['numero'];
        $codigo = $_POST['codigo'];


        $sql = 'insert into lojas (codpessoa,nr_loja) values (?,?)';
        $array = array($codigo,$numero);

        $retorno = fazAlteracao($sql,$array);

        if($retorno){
            $sql = 'update nr_lojas set ocupado = 1 where nr_loja = ?';
            $array = array($numero);
            $retorno = fazAlteracao($sql,$array);
            if($retorno)
                $_SESSION['msg'] = "Loja: $numero alocada";
            else
                $_SESSION['msg'] = "Aconteceu algum erro na alocação";
        }
        else
            $_SESSION['msg'] = 'Aconteceu algum erro na alocação';
        
        header('location:../alocar_loja.php');
    }
    
    
}


if($_POST['botao'] == 'Editar Status'){
    $status = $_POST['status'];
    $codigo = $_POST['codloja'];
    $numero = $_POST['nr_loja'];

    $sql = 'select status from nr_lojas where nr_loja = ?';
    $array = array($numero);
    $retorno = ConsultaSelect($sql,$array);

    if($status && $retorno['status']){
        $_SESSION['msg']= 'Loja já esta ocupada';
        header('location:../editar_loja.php');
    }

    if($status)
        $texto = 'Ativo';
    else
        $texto = 'Desativado';
    
    $array = array($status, $codigo);
    $sql = 'update lojas set ativo = ? where codloja = ?';

    $retorno = fazAlteracao($sql,$array);

    if($retorno){
        $sql = 'update nr_lojas set ocupado = ? where nr_loja = ?';
        $array = array($status,$numero);


        $retorno = fazAlteracao($sql,$array);
        
        if($retorno)
            $_SESSION['msg'] = "Status loja: $numero alterado para $texto";
        else
            $_SESSION['msg'] = "Houve algum erro naaaaa edição...";
    }
    else
        $_SESSION['msg'] = "Houve algum erro na edição...";

    header('location:../editar_loja.php');
        

}

if($_POST['botao'] == 'Desativar Loja'){

    $codloja = $_POST['codloja'];
    $nr_loja = $_POST['nr_loja'];

    $sql = 'update lojas set ativo = 0, nr_loja = null where codloja = ?';
    $array = array($codloja);
    $retorno = fazAlteracao($sql,$array);

    if($retorno){
        $sql = 'update nr_lojas set ocupado = 0 where nr_loja = ?';
        $array = array($nr_loja);
        $retorno = fazAlteracao($sql,$array);
        if($retorno){
            $_SESSION['msg'] = 'Loja '.$_POST['nome'].'desativa com sucesso';
        }
        else
            $_SESSION['msg'] = 'ERRO CRITICO NO BANCO DE DADOS DE NR_LOJAS';
    }
    else
        $_SESSION['msg'] = 'Não foi possivel alterar os dados';
    
    header('location:../editar_loja.php');
}


if($_POST['botao'] == 'Reativar Loja'){

    $codloja = $_POST['codloja'];
    $nr_loja = $_POST['nr_loja'];

    $sql = 'UPDATE lojas set nr_loja = ?, ativo = 1 where codloja = ?';
    $array = array($nr_loja,$codloja);
    $retorno = fazAlteracao($sql,$array);

    if($retorno){
        $sql = 'UPDATE  nr_lojas set ocupado = 1 where nr_loja = ?';
        $array = array($nr_loja);
        $retorno = fazAlteracao($sql,$array);
        
        

        if($retorno)
            $_SESSION['msg'] = 'Loja '.$_POST['nome'].' reativada com sucesso';
        else
            $_SESSION['msg'] = 'ERRO CRITICO, ACONTECEU ALGUM ERRO NA TABELA';
    }
    else    
        $_SESSION['msg'] = 'Não foi possivel realizar a reativação da loja '.$_POST['nome'];
        header('location:../editar_loja.php');
}




if($_POST['botao'] == 'Atualizar Local'){
    $numero = $_POST['nr_loja'];//local antigo
    $codloja = $_POST['codloja'];//codigo da loja
    $novo_numero = $_POST['nv_numero'];//local novo

    $sql = 'select * from nr_lojas where nr_loja like ?';
    $array = array($novo_numero);
    $resultado = ConsultaSelect($sql,$array);
    if($resultado['ocupado']){
        $_SESSION['msg'] = 'Local informado já se encontra ocupado';
    }
    else{
        $sql = 'update nr_lojas set ocupado = 0 where nr_loja = ?';
        $array = array($numero);
        $retorno = fazAlteracao($sql,$array);
        if($retorno){
            $sql = 'update nr_lojas set ocupado = 1 where nr_loja = ?';
            $array = array($novo_numero);
            $retorno = fazAlteracao($sql,$array);
            if($retorno){
                $sql ='update lojas set nr_loja = ? where codloja = ?';
                $array = array($novo_numero,$codloja);
                $retorno = fazAlteracao($sql,$array);
                if($retorno){
                    $_SESSION['msg'] = "Alteração feita da posição: $numero para a posição:$novo_numero";
                }
                else
                    $_SESSION['msg'] = 'Aconteceu algum erro NV3';
            }
            else{
                $_SESSION['msg'] = 'Aconteceu algum erro NV2';
            }
        }
        else{
            $_SESSION['msg'] = 'Aconteceu algum erro NV1';
        }
        
    }

    header('location:../editar_local_loja.php');
}

if($_POST['botao'] == 'Enviar Email'){
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];

    if($_POST['pessoas'] == 'CLIENTES')
        $sql = 'select nome, email from pessoas where promocoes is true and ativo is true';
    if($_POST['pessoas'] == 'LOJISTAS')
        $sql = "select nome, email from pessoas where nivel like 'LOJISTA' and ativo is true";

    $pessoas = ConsultaSelectAll($sql);
    
    if($pessoas){

        $retorno = enviaEmail($pessoas, $mensagem, $assunto);

        if($retorno){
            $_SESSION['msg'] = 'Email encaminhado a todos os usuarios ativos pra receber promoções';
        }
        else
            $_SESSION['msg'] = 'Ouve alguma falha ao enviar';
    }
    else{
        $_SESSION['msg'] = 'Não há usuarios que querem receber atualizações via email';
    }

    header('location:../email_informativo.php');
}

if($_POST['botao'] == 'Alterar Foto'){
    
    $codloja = $_POST['codloja'];

    $arquivo = $_FILES['arquivo'];
    $extensao = strtolower( substr($arquivo['name'],-4)); // pega a extensao do arquivo
    $novo_nome = $codloja.$extensao;

	if (move_uploaded_file($arquivo['tmp_name'],"../image/lojas/".$novo_nome)){
        $_SESSION['msg'] = 'Upload realizado';
    }
    else{
	    $novo_nome = "loja.png";
        $_SESSION['msg'] = 'Houve algum problema no upload da foto da loja';
    }

    $sql = 'UPDATE  lojas set foto = ? where codloja = ?';
    $array = array($novo_nome,$codloja);

    $retorno = fazAlteracao($sql,$array);

    if($retorno){
        $_SESSION['msg'] = $_SESSION['msg'].'<br>'.'Foto da loja alterada com sucesso';
    }
    else
        $_SESSION['msg'] = $_SESSION['msg'].'<br>'.'Houve algum problema na atualização';

    header('location:../users/gerenciar_lojas.php');
}

if($_POST['botao'] == 'Alterar Dados'){

    $departamento = $_POST['departamento'];
    $cnpj = $_POST['cnpj'];
    $nome = $_POST['nome'];
    $codloja = $_POST['codloja'];

    $sql = 'UPDATE lojas set nome = ?,cnpj = ?, coddepartamento = ? where codloja = ?';
    $array = array($nome,$cnpj,$departamento,$codloja);
    
    $retorno = fazAlteracao($sql,$array);

    if($retorno){
        $_SESSION['msg'] = "Dados da loja: $nome alterados";
    }
    else
        $_SESSION['msg'] = 'Houve algum erro na atualização';

    header('location:../users/gerenciar_lojas.php');
}

if($_POST['botao'] == 'Enviar pedido'){
    
    $nf = $_POST['nf'];
    $sql = 'UPDATE VENDAS set liberacao = 1 where NF = ?';
    $array = array($nf);

    $retorno = fazAlteracao($sql,$array);

    if($retorno)
        $_SESSION['msg'] = "Pedido da NF:$nf foi enviado!";
    else
        $_SESSION['msg'] = "Pedido da NF:$nf não foi enviado!";

    header("location:../users/gerenciar_pedidos.php");
}