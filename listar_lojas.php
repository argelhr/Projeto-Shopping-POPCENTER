<?php
    require_once('./controllers/funcoes_db.php');

    if(isset($_GET['pesquisa'])){
        $texto = $_GET['pesquisa'];
    }
    else
        $texto = '%%';

    $sql = 'select lojas.*,descricao from lojas left join departamentos using(coddepartamento) where lojas.nome like ?';//colcoar o departamento
    $array = array('%'.$texto.'%');
    $retorno = ConsultaSelectAll($sql,$array);

    $sql = 'SELECT * from nr_lojas where ocupado is false';
    $numeros_disponiveis = ConsultaSelectAll($sql,$array);
    
    
    if($retorno){
        ?>
        <div class="container-user">
            <?php
            foreach($retorno as $loja){
                ?>
                
                    <div class="card-user">
                        <img width="256px" src="./image/lojas/<?php echo $loja['foto'];?>" alt="Loja">
                        <div>Nome: <?php echo $loja['nome'];?></div>
                        <div>Departamento: <?php echo $loja['descricao'];?></div>
                        <div>Número: <?php echo $loja['nr_loja'];?></div>
                        <div>Status: <?php if($loja['ativo']) echo 'Ativo'; else echo 'Desativado'?></div>

                        <?php
                            if($loja['ativo']){
                                ?>
                                <form action="./controllers/controller_lojas.php" method="post">
                                    <input type="hidden" name="codloja" value="<?php echo $loja['codloja']?>">
                                    <input type="hidden" name="nr_loja" value="<?php echo $loja['nr_loja']?>">
                                    <input type="hidden" name="nome" value="<?php echo $loja['nome']?>">
                                    <input type="submit" value="Desativar Loja" name="botao">
                                </form>
                                <?php
                            }
                            else{
                                ?>
                                <form onsubmit="VerificaSelect()" action="./controllers/controller_lojas.php" method="post">
                                    <input type="hidden" name="codloja" value="<?php echo $loja['codloja']?>">
                                    <input type="hidden" name="nome" value="<?php echo $loja['nome']?>">
                                    <select class="select" name="nr_loja" id="nr_loja" required>
                                        <option value="">---</option>
                                        <?php
                                            foreach($numeros_disponiveis as $num){
                                                ?>
                                                
                                                <option value="<?php echo $num['nr_loja']?>">
                                                    <?php echo $num['nr_loja']?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                    </select>
                                    <input type="submit" value="Reativar Loja" name="botao">
                                </form>
                                <?php
                            }
                        ?>
                        
                    </div>
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
                <p>Informe um nome válido...</p>
            </div> 
        </div>
        <?php
    }
    ?>

    <script>
        function VerificaSelect(){
            let select = document.getElementById('nr_loja')
            let valor = select.value

            if(valor == 'ABACATE'){
                alert('Selecione algum número que a loja ocupará')
                event.preventDefault();
            }
        }
    </script>