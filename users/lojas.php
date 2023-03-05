<?php 
    require_once('../controllers/funcoes_db.php');

    if(isset($_GET['pesquisa'])){
        $texto = $_GET['pesquisa'];
        $texto = "%".$texto."%";
    }
    else
        $texto = '%%';

    $sql = 'select * from lojas natural join departamentos where nome like ? and ativo is true order by lojas.nome';
    $array = array($texto);

    $lojas = ConsultaSelectAll($sql,$array);
?>
<div class="container">
    <?php
        foreach($lojas as $loja){
            ?>
            <div class="card-loja">
                <img src="../image/lojas/<?php echo $loja['foto']?>" alt="<?php echo $loja['nome'];?>">
                <div>
                    <div class="cLOJA-title"><?php echo $loja['nome']?></div>
                    <div class="cLOJA-text">Departamento: <?php echo $loja['descricao']?></div>
                    <div class="cLOJA-text">CNPJ: <?php echo $loja['cnpj']?></div>
                    <div class="cLOJA-text">Loja Nº: <?php echo $loja['nr_loja']?></div>
                    <form action="./pagina_loja.php" method="post">
                        <input type="hidden" name="codloja" value="<?php echo $loja['codloja'];?>">
                        <input type="submit" name="botao" value="Ver Produtos">
                    </form>
                </div>
            </div>
            <?php
        }
        ?>
</div>

