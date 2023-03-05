<?php
include("funcoes_db.php");
include("../email/envia_email.php");
session_start();

if(!isset($_POST['botao'])){
	$_SESSION['msg'] = 'Voce não tem acesso a essa pagina!';
	header(('location:http://localhost/POPCENTER/index.php'));
}

if($_POST['botao'] == 'Logar'){

	$email = $_POST["email"];
	$senha = $_POST["senha"];
	if (!(empty($email) OR empty($senha))){
	    $array = array($email);
		$query = "select * from pessoas where email = ? and ativo is true";
		$resultado=ConsultaSelect($query,$array);

		if($resultado && password_verify($senha,$resultado['senha'])){
				$_SESSION["logado"]=true;
				$_SESSION["codpessoa"]=$resultado['codpessoa'];
				$_SESSION['nivel'] = $resultado['nivel'];
					
				header("Location:../index.php");
	    }
		else{
			$_SESSION["msg"]="Usuário ou senha inválidos";
			header("Location:../login.php");
		}
	}
	else{
		$_SESSION["msg"]="Campos de login vazios";
			header("Location:../login.php");

	}
}




if($_POST['botao']=='Cadastrar'){
	$nome=$_POST['nome'];
	$email=$_POST['email'];
	$cpf=$_POST['cpf'];
	$telefone = $_POST['telefone'];
	$dt_nasc = $_POST['dt_nasc'];
	
    $_SESSION["msg"]=''; 

	$data = new DateTime($dt_nasc );
	$resultado = $data->diff( new DateTime( date('Y-m-d') ) );
	$idade = $resultado->format( '%Y anos' );
	$idade = intval($idade);

	if($idade <18){
		$_SESSION['msg'] = 'O usuario é menor de idade, não foi possivel continuar com o cadastro';
		header('location:../cadastro.php');
		die();
	}
	
	$senha=password_hash($_POST['senha'], PASSWORD_DEFAULT);
	if(isset($_POST['promocao'])){
		$promocao = true;
	}
	else
		$promocao = false;

	$array = array($email);
	$query ="select email from pessoas where email = ?";

	$linha=ConsultaSelect($query,$array);

	if($linha){
		$_SESSION['msg'] = 'Email '.$email.' já cadastrado';
		header('location:../cadastro.php');
	}
	else{
		$array = array($nome, $email, $cpf, $telefone, $senha, $dt_nasc,$promocao);
		$query = 'insert into pessoas (nome, email, cpf, telefone, senha, dt_nasc, promocoes) values (?, ?, ?, ?, ?, ?, ?)'; 
		$retorno = fazAlteracao($query,$array);
		if($retorno){
			$hash = md5($email);
			$link = "<a href='localhost/popcenter/valida_email.php?h=$hash'>Clique aqui para confirmar seu cadastro</a>";
			$mensagem="<tr><td style='padding: 10px 0 10px 0;' align='center' bgcolor='#669999'>";
			$mensagem.="Email de Confirmação <br>".$link."</td></tr>";
			$assunto="Confirme seu cadastro";
			$retorno = enviaEmail2($email,$nome,$mensagem,$assunto);
			if($retorno)
				$_SESSION['msg'] = 'Valide seu cadastro no seu email informado';
			else
				$_SESSION['msg'] = 'Email não foi encaminhado';
			header('location:../login.php');
		}
		else{
			$_SESSION['msg'] = 'Ocorreu algum erro...';
			header('location:../cadastro.php');
		}

	}
}

if($_POST['botao'] == 'Alterar Nivel'){
	$codigo = $_POST['codigo'];
	$nivel = $_POST['nivel'];
	$array = array($nivel,$codigo,);
	$sql = 'UPDATE pessoas set nivel = ? where codpessoa = ?';

	$retorno = fazAlteracao($sql,$array);

	if($retorno){
		$_SESSION['msg'] = 'Alteração feita com sucesso';
	}
	else
		$_SESSION['msg'] = 'Ocorreu algum problema';
	header('location:../gerenciar_usuarios.php');

}

if($_POST['botao'] == 'Atualizar Perfil'){
	$codpessoa = $_SESSION['codpessoa'];
	$nome = $_POST['nome'];
	$cpf = $_POST['cpf'];
	$telefone = $_POST['telefone'];
	$data = $_POST['dt_nasc'];

	if(isset($_POST['promocao'])){
		$promocao = true;
	}
	else
		$promocao = false;

	if ($_FILES['foto']['error'] != 4){

		$arquivo = $_FILES['foto'];
		$extensao = strtolower( substr($arquivo['name'],-4)); // pega a extensao do arquivo
		$novo_nome = $codpessoa.$extensao;

		if (move_uploaded_file($arquivo['tmp_name'],"../image/users/".$novo_nome)){
			$_SESSION['msg'] = 'Foto alterada';
		}
		else{
			$novo_nome = $codpessoa.$extensao;
		}

		$sql = 'UPDATE pessoas set nome = ?, cpf = ?, telefone = ?, dt_nasc = ?, promocoes = ?, foto = ? where codpessoa =?';
		$array = array($nome, $cpf, $telefone, $data,$promocao, $novo_nome, $codpessoa);
	}
	else{
		$sql = 'UPDATE pessoas set nome = ?, cpf = ?, telefone = ?, dt_nasc = ?, promocoes = ? where codpessoa =?';
		$array = array($nome, $cpf, $telefone, $data,$promocao, $codpessoa);
	}


	$retorno = fazAlteracao($sql,$array);

	if($retorno)
		$_SESSION['msg'] = "Os dados de $nome foram atualizados";
	else
		$_SESSION['msg'] = "Houve algum problema para alterar os dados...";

	header('location:../users/gerenciar_perfil.php');


}
if($_POST['botao'] == 'Cadastrar Endereço'){


	$codigo = $_POST['codigo'];//codigo da pessoa
	$cep = $_POST['cep'];
	$rua = $_POST['rua'];
	$bairro = $_POST['bairro'];
	$cidade = $_POST['cidade'];
	$uf = $_POST['uf'];
	$numero = $_POST['numero'];

	if(isset($_POST['complemento']))
		$complemento = $_POST['complemento'];
	else
		$complemento = null;

	$sql = 'select * from enderecos where codpessoa = ?';
	$array = array($codigo);
	$retorno = ConsultaSelect($sql,$array);//verifica se existe endereço cadastrado para selecionar o comando sql certo

	
	if($retorno)
		$sql = 'UPDATE enderecos set cep = ?,uf =?, cidade = ?, bairro = ?, rua = ?,numero = ?, complemento = ? where codpessoa = ?';
	else
		$sql = 'insert into enderecos (cep,uf, cidade,bairro,rua,numero,complemento, codpessoa) values (?,?,?,?,?,?,?,?)';
	
	$array = array($cep,$uf,$cidade,$bairro,$rua,$numero,$complemento,$codigo);//utiliza o mesmo array para as duas funções

	$retorno = fazAlteracao($sql,$array);
	
	if($retorno)
		$_SESSION['msg'] = 'Endereço cadastrado com sucesso';
	else
		$_SESSION['msg'] = 'Houve algum erro no cadastro do endereço...';
		
	header('location:../users/gerenciar_perfil.php');
}

if($_POST['botao'] == 'Enviar'){//para o ciclo de esqueceu senha e faz requisição
	
	$email = $_POST['email'];

	$sql = 'select * from requisicao  where email = ?';
	$array = array($email);
	$retorno = ConsultaSelectAll($sql,$array);

	if($retorno){
		$sql = 'update requisicao set token = ? where email = ?';
	}
	else{
		$sql = 'insert into requisicao (token,email) values (?,?)';
	}
	
	$token = bin2hex(random_bytes(16));//cria um token alfanumerico aleatorio
	$array = array($token,$email);
	$resultado = fazAlteracao($sql, $array);
	
	if($resultado){
		$hash = md5($email);
		$link = "<a href='localhost/popcenter/redefinir_senha.php?h=$hash&tk=$token'>Clique aqui para redefinir sua senha</a>";
		$mensagem="<tr><td style='padding: 10px 0 10px 0;' align='center' bgcolor='#669999'>";
		$mensagem.="Email de Confirmação <br>".$link."</td></tr>";
		$assunto="Redefinir senha";
		$resultado = enviaEmail2($email,$retorno['nome'],$mensagem,$assunto);
		if($resultado)
			$_SESSION['msg'] = 'Requisição de troca de senha realizada, verifique seu email';
		else
			$_SESSION['msg'] = 'Não foi possivel realizar o envio do email';
	}
	else
		$_SESSION['msg'] = 'Houve algum problema na sua solicitação';
		
	header('location:../login.php'); 
}

if($_POST['botao'] == 'Redefinir Senha'){
	$email = $_POST['email'];
	$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

	$sql = 'update pessoas set senha = ? where md5(email) = ?';
	$array = array($senha,$email);

	$retorno = fazAlteracao($sql,$array);

	if($retorno){
		$sql = 'delete from requisicao where md5(email) = ?';
		$array = array($email);
		$retorno = fazAlteracao($sql,$array);
		if($retorno){
			$_SESSION['msg'] = 'Alteração realizada com sucesso';
		}
		else
			$_SESSION['msg'] = 'Houve algum problema na alteração';
	}

	header('location:../login.php');
}

if($_POST['botao'] == 'Adicionar'){//pra adicionar na sacola
    $codproduto = $_POST['codproduto'];
    $qtd = $_POST['qtd'];
    $codpessoa = $_SESSION['codpessoa'];

    $sql = 'select codsacola from sacola where codpessoa = ?';
    $array = array($codpessoa);
    $codsacola = ConsultaSelect($sql,$array);

    if(!$codsacola){
        $sql = 'insert into sacola(codpessoa) values (?)';//usa o mesmo array de cima pra achar o codigo da sacola
        $retorno = fazAlteracao($sql,$array);
        if($retorno){
            $sql = 'select max(codsacola) from sacola';
			$retorno = ConsultaSelect($sql);
            $codsacola = $retorno['max(codsacola)'];
        }
	}
	else
		$codsacola = $codsacola['codsacola'];


    $sql = 'select * from sacola_itens where codproduto = ? and codsacola = ?';
    $array = array($codproduto,$codsacola);
    $retorno = ConsultaSelect($sql,$array);

    if(!$retorno){
        $sql = 'INSERT into sacola_itens (codsacola,codproduto,qtd) values (?,?,?)';
        $array = array($codsacola,$codproduto,$qtd);
		echo "<br>retorno array";
		var_dump($array);
        $retorno = fazAlteracao($sql,$array);
		echo "retorno faz alteração <br>";
		var_dump($retorno);
            if($retorno){
                $_SESSION['msg'] = 'Item foi inserido na sacola';
            }
            else
                $_SESSION['msg'] = 'Houve algum problema na inserção';
    }
    else{
        $sql = 'update sacola_itens set qtd = qtd + ? where codproduto = ?';
        $array = array($qtd,$codproduto);
        $retorno = fazAlteracao($sql,$array);
        if($retorno){
            $_SESSION['msg'] = 'Quantidade do item atualizada na sacola';
        }
        else
            $_SESSION['msg'] = 'Houve algum problema pra atualizaar a quantdiade';
    }
    header('location:../users/pesquisa.php');
}

if($_POST['botao'] == 'Finalizar pedido'){
	
	if(!(isset($_POST['pedido']))){
		$_SESSION['msg'] = 'Nenhum item foi selecionado, tente novamente após selecionar os itens desejados';
		header('location:../users/gerenciar_sacola.php');
		die();
	}

	$codsacola = $_POST['codsacola'];
	$codpessoa = $_POST['codpessoa'];

	$sql = 'insert into vendas (dt_venda,codpessoa) VALUES (CURRENT_DATE,?)';
	$array = array($codpessoa);
	$retorno = fazAlteracao($sql,$array);

	if(!$retorno){
		$_SESSION['msg'] = 'Não foi possivel realizar pedido.';
		header('../users/gerenciar_sacola.php');
	}

	foreach($_POST['pedido'] as $codproduto){//pra adicionar na tabela vendas os itens que o cliente solicitou
		

		$sql = 'SELECT * from sacola_itens join produtos using(codproduto) where codsacola = ? and codproduto = ?';
		$array = array($codsacola,$codproduto);

		$resultado = ConsultaSelect($sql,$array);

		if($resultado){
				
				$sql = 'select max(NF) from vendas';
				$NF = ConsultaSelect($sql);

				if($NF){
					$sql = 'insert into vendas_produtos
					 (NF,codproduto,quantidade,valor,valor_total)
					 values (?,?,?,?,?)';
					
					$array = array($NF['max(NF)'], $codproduto, $resultado['qtd'], $resultado['valor'],$resultado['valor']*$resultado['qtd']);

					$foo = fazAlteracao($sql,$array);

					if($foo){
						$sql = "delete from sacola_itens where codsacola = ? and codproduto = ?";
						$array = array($codsacola,$codproduto);

						$foo = fazAlteracao($sql,$array);
						if($foo){
							$_SESSION['msg'] = 'Pedido realizado!';
							header('location:../users/gerenciar_sacola.php');

						}
					}

				}
			}
		}

	die();
	}

if($_POST['botao'] == 'Alterar Senha'){
	
	$codpessoa = $_POST['codpessoa'];
	$senha = $_POST['senha'];
	$senha_antiga = $_POST['senha_antiga'];

	$sql = 'SELECT senha,email from pessoas where codpessoa = ?';
	$array = array($codpessoa);

	$retorno = ConsultaSelect($sql,$array);

	
	if($retorno){
		if (password_verify($senha_antiga,$retorno['senha'])){

			$senha_atualizada=password_hash($senha, PASSWORD_DEFAULT);
			
			$array = array($senha_atualizada,$retorno['email']);
			$sql ="update pessoas set senha = ? where email = ?";

			$retorno=fazAlteracao($sql,$array);

			if($retorno){

				$_SESSION["msg"] = "Alteração de senha executada com sucesso, efetue o login!";
				header('location:../login.php');
				die();
			}
			else{
				$_SESSION["msg"]= 'Erro ao alterar a senha';
			}
		}
		else{
			$_SESSION['msg'] = 'Senha incorreta';
		}
		header("Location:../users/alterar_senha.php");
	}
	header("location:../index.html");
}