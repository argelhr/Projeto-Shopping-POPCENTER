<?php

include("funcoes_db.php");

session_start();

if(!($_SESSION['logado'])){
	$_SESSION['msg'] = "Você deve estar logado para acessar ao site";
	header('location:http://localhost/POPCENTER/login.php');
}
if(!isset($_POST['botao'])){
	$_SESSION['msg'] = 'Voce não tem acesso a essa pagina!';
	header(('location:http://localhost/POPCENTER/index.php'));
}


if($_POST['botao'] == 'Cadastrar Produto'){

    $nomeloja = $_POST['nomeloja'];

    $sql = 'select max(codproduto) from produtos';
    
    $numero = ConsultaSelect($sql);//pegar o maior valor de codigo
    $numero =  $numero['max(codproduto)'] + 1;//

    $codloja = $_POST['codloja'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['preco'];

    $valor = str_replace([','],'.', $valor);
    $valor = number_format($valor,2);
    
    $arquivo = $_FILES['foto'];
    $extensao = strtolower( substr($arquivo['name'],-4)); // pega a extensao do arquivo
    $novo_nome = $codloja.'-'.$numero.$extensao;

	if (move_uploaded_file($arquivo['tmp_name'],"../image/produtos/".$novo_nome)){
        $aux = 'com foto';
    }
    else{
	    $novo_nome = "produto.png";
        $aux = 'sem foto';
    }

    $sql = 'insert into produtos (nome,descricao,valor,codloja,foto) values (?,?,?,?,?)';
    $array = array($nome,$descricao,$valor,$codloja,$novo_nome);
    $retorno = fazAlteracao($sql,$array);
    
    if($retorno)
        $_SESSION['msg'] = "Produto: $nome, cadastrado com sucesso $aux";
    else
        $_SESSION['msg'] = 'Houve algum erro no cadastro';

    $_SESSION['codloja'] = $codloja;
    $_SESSION['nome'] = $nomeloja;
    header('location:../users/adicionar_produto.php');

}

if($_POST['botao'] == 'Editar Produto'){
    $_SESSION['msg'] = '';
    $_SESSION['codloja'] = '';

    $codproduto = $_POST['codproduto'];
    $codloja = $_POST['codloja'];

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['preco'];

    $valor = str_replace([','],'.', $valor);
    $valor = number_format($valor,2);

    if ($_FILES['foto']['error'] != 4){
        echo 'a';
		$arquivo = $_FILES['foto'];
		$extensao = strtolower( substr($arquivo['name'],-4)); // pega a extensao do arquivo
		$novo_nome = $codloja.'-'.$codproduto.$extensao;

		if (move_uploaded_file($arquivo['tmp_name'],"../image/produtos/".$novo_nome)){
			$_SESSION['msg'] = 'Foto alterada';
		}
		else{
			$novo_nome = 'produto.png';
		}

		$sql = 'UPDATE produtos set nome = ?, descricao = ?, valor = ?, foto = ?  where codproduto = ?';
		$array = array($nome, $descricao, $valor, $novo_nome, $codproduto);
        $aux = ',com foto';
	}
	else{
        $aux = ',sem foto';
		$sql = 'UPDATE produtos set nome = ?, descricao = ?, valor = ?  where codproduto = ?';
		$array = array($nome, $descricao, $valor, $codproduto);
	}
    
    $retorno = fazAlteracao($sql,$array);

    $_SESSION['codloja'] = $codloja;

    if($retorno){
        $_SESSION['msg'] = 'Produto atualizado com sucesso'.$aux;
    }
    else{

        $_SESSION['msg'] = 'Não foi possivel atualziar o produto...';
    }

    header('location:../users/editar_produtos.php');
}
