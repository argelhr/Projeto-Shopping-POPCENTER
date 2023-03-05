<?php 
    require_once('../controllers/funcoes_db.php');

    if(isset($_GET['pesquisa'])){
        $texto = $_GET['pesquisa'];
        $texto = "%".$texto."%";
    }
    else
        $texto = '%%';
?>

    <?php
    
    $sql = 'select produtos.*,lojas.nome as v,lojas.nr_loja as nr_loja,codloja from produtos left join lojas using(codloja) where produtos.nome like ? and lojas.ativo is true order by produtos.nome';
    $array = array($texto);

    $produtos = ConsultaSelectAll($sql,$array);
    ?>
    <div class="container">
        <?php
            foreach($produtos as $produto){
                ?>
                <div class="card-loja">
                    
                    <img src="../image/produtos/<?php echo $produto['foto']?>" alt="<?php echo $produto['nome'];?>">
                    <div>
                        <p class="card-title"><?php echo $produto['v']?></p>
                        <p class="card-title"><?php echo $produto['nome']?></p>
                        <p class="card-text">Preço: R$ <?php echo $produto['valor']?></p>
                        <p class="card-text">Loja: <?php echo $produto['nr_loja']?></p>
                        <form action="./pagina_prod.php" method="post">
                            <input type="hidden" name="codproduto" value="<?php echo $produto['codproduto'];?>">
                            <input type="submit" name='botao' value="Ver mais">
                        </form>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>