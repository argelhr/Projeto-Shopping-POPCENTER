

<?php
    require_once('./controllers/funcoes_db.php');



    if(isset($_GET['pesquisa']))
        $texto = strtoupper($_GET['pesquisa']);
    else            
        $texto = '';

    $sql = 'SELECT codpessoa,nome,cpf,nivel,foto from pessoas where upper(nome) like ? and ativo
     is true and codpessoa !=1 ';
    $array = array('%'.$texto.'%');

    $retorno = ConsultaSelectAll($sql,$array);

    if($retorno){
        ?>
        <div class="container-user">
            <?php
            foreach($retorno as $pessoa){
                ?>
                
                <form class="card-user" action="./controllers/controller_usuario.php" method="post">
                    
                <input type="hidden" name="codigo" value="<?php echo $pessoa['codpessoa']?>">
                    
                    <img src="./image/users/<?php echo $pessoa['foto'];?>" alt="Foto">
                    <div>Nome: <?php echo $pessoa['nome'] ?></div>
                    <div>CPF: <?php echo $pessoa['cpf'] ?></div>
                    <select class="select" name="nivel" id="nivel">
                        
                        <option value="CLIENTE" <?php if($pessoa['nivel'] == 'CLIENTE') echo'selected';?>>Cliente</option>
                        <option value="LOJISTA" <?php if($pessoa['nivel'] == 'LOJISTA') echo'selected';?>>Logista</option>
                        <input type="submit" name="botao" value="Alterar Nivel">
                    </select>
                </form>






                <?php





            }
            ?>
        </div>
        <?php
    }
    else{
        ?>
        <div class="center">
            <div id="mensagem">
                Não foi encontrado nenhum perfil com o valor de busca...
                Tente novamente!
            </div> 
        </div>
        
        <?php
    }
?>