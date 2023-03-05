<?php
//S: objeto de conexão se tudo der certo ou uma mensagem de erro
function fazconexao(){
    
    //conexao via PDO
    //try = tenta fazer o que há no bloco
    try{
        $conexao = new PDO("mysql:host=localhost; dbname=popcenter; charset=utf8", "root","");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return($conexao);
        } //caso de algum erro, executa o catch
    catch(PDOException $ex){
    //encerra e apresenta mensagem de erro
    die($ex->getMessage());
    }

}
// função utilizada para consulta de vários registros (select) 
//E0:  string de consulta SQL e vetor com os dados variáveis
//S: matriz de vetores associativos contendo vários registros da consulta
//    ou objeto de exceção contendo mensagem de erro e código do erro
function ConsultaSelectAll($sql,$parametros=array()){
    try {
        //conecta
        $conexaoBD = fazConexao();
        //cria o objeto de consulta
        $consulta = $conexaoBD->prepare($sql);
        //executa a consulta
        if (sizeof($parametros) > 0) { 
           $result = $consulta->execute($parametros);
        } 
        else{

            $result = $consulta->execute();
        }  

        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return($resultados);
    }
    catch (PDOException $e) {
       echo $e;
    }
}
// função utilizada para consulta de um registro (select) 
//E0: string de consulta SQL e vetor com os dados variáveis
//S:  vetor associativo contendo um registro da consulta
//    ou objeto de exceção contendo mensagem de erro e código do erro
function ConsultaSelect($sql,$parametros=array()){
    try {
        //conecta
        $conexaoBD = fazConexao();
        //cria o objeto de consulta
        $consulta = $conexaoBD->prepare($sql);
        //executa a consulta
        if (sizeof($parametros) > 0) { 
           $result = $consulta->execute($parametros);
        } 
        else{

            $result = $consulta->execute();
        }  

        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        return($resultado);
    }
    catch (PDOException $e) {
        echo $e;
    }
}

// função utilizada para insert, update ou delete
//E0:  string de consulta SQL E vetor com os dados variáveis
//S: resultado da inserção, alteração ou exclusão (false ou true)
//    ou objeto de exceção contendo mensagem de erro e código do erro
function fazAlteracao($sql,$parametros=array()){
    try {
          //conecta
        $conexaoBD = fazConexao();
        //cria o objeto de consulta
        $consulta = $conexaoBD->prepare($sql);
        //testa se foram passados parâmetros
        
        if (sizeof($parametros) > 0) { 
            $resultado=$consulta->execute($parametros);
        } 
        else{
            $resultado=$consulta->execute();
        }    
     
        return $resultado;
    }
    catch (PDOException $e) {
        echo $e;
    }
}

?>