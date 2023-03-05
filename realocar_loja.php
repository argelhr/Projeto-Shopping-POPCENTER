<?php

    require_once('./controllers/funcoes_db.php');

    $sql = 'select nr_loja from nr_lojas where ocupado is false';
    $numeros = ConsultaSelectAll($sql);

    if(isset($_GET['pesquisa']))
        $texto = $_GET['pesquisa'];
    else
        $texto = '';
    $array = array('%'.$texto.'%');
    $sql = 'select * from lojas where nome like ? and ativo is true';

    $retorno = ConsultaSelectAll($sql,$array);

    if($retorno){
        ?>
        <div class="container-user">
        <?php
        foreach($retorno as $loja){
            ?>
            <div class="card-user">
                <img src="./image/lojas/<?php echo $loja['foto']?>" alt="">
                <div>Nome: <?php echo $loja['nome'];?></div>
                <div>Número: <?php echo $loja['nr_loja']?></div>
                <form action="./controllers/controller_lojas.php" method="post">
                    <input type="hidden" name="codloja" value="<?php echo $loja['codloja'];?>">
                    <input type="hidden" name="nr_loja"  value="<?php echo $loja['nr_loja'];?>">
                    <select class="select" name="nv_numero">
                        <?php
                        foreach($numeros as $numero){
                            ?>
                            <option
                                value="<?php echo $numero['nr_loja'];?>"
                                <?php if($numero['nr_loja'] == $loja['nr_loja'])
                                    echo 'selected';?>>
                                    <?php echo $numero['nr_loja'];?>
                            </option>
                            <?php
                        }
                    ?>
                    </select>
                    
                        <input type="submit" name='botao' value="Atualizar Local">
                    
                </form>
            </div>
            <?php
        }
        ?></div>
        <?php
    }
    else{
        ?>
        <div class="center">
            <div id="mensagem">
                Não possui lojas ativas :(
            </div>
        </div>
        <?php
    }
?>