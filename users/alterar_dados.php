<body id="pagperfil">
<?php
    require_once('../includes/header.php');
    require_once('../includes/menu-user.php');
    require_once('../controllers/funcoes_db.php');

    if($_SESSION['nivel'] != 'LOJISTA')
        header('location:../index.php');

    $sql = 'select * from lojas left join departamentos using(coddepartamento)  where codloja = ?';
    $array = array($_POST['codigo']);

    $loja = ConsultaSelect($sql,$array);

    $sql = 'select * from departamentos where ativo is true';
    $departamentos = ConsultaSelectAll($sql);
    
?>

    <h2 class="titulo">Informações da Loja</h2>

    <div class="center">
        <form id="cadastro" class="form-cadastro col-06" action="../controllers/controller_lojas.php" method="post">
            <input type="hidden" name="codloja" value="<?php echo $loja['codloja']?>">

            <label for="nome">Nome</label>
            <input type="text" name="nome" value="<?php echo $loja['nome']?>" placeholder="Digite aqui o nome fantasia">

            <label for="cnpj">CNPJ</label>
            <input type="text" name="cnpj" id="cnpj"  value="<?php echo $loja['cnpj']?>" placeholder="Digite aqui o cnpj da loja">

            <label for="departamento">Departamento</label>
            <select name="departamento">
                <?php
                    foreach($departamentos as $dep){
                        ?>
                            <option value="<?php echo $dep['coddepartamento']?>" <?php if($dep['coddepartamento'] == $loja['coddepartamento']) echo 'selected';?>><?php echo $dep['descricao']?></option>
                        <?php
                    }
                ?>
            </select>
            <input type="submit" name="botao" value="Alterar Dados">
        </form>
    </div>
</body>

<?php
    require_once('../includes/footer.php');
?>

<script>
    window.onload = function(){
        let formulario = document.getElementById('cadastro')
        // formulario.addEventListener('submit',verificaForm);
        formulario.cnpj.addEventListener('keypress',aplicaMaskaraCNPJ);

        let btn = document.getElementById('btn')
        btn.addEventListener('click',menuShow)
    }

    function aplicaMaskaraCNPJ(event){
        let cnpj = document.getElementById('cnpj')
        let tecla = event.keyCode

        if(tecla<48 || tecla>57 || cnpj.value.length >18)
            event.preventDefault()

        if(cnpj.value.length==2 || cnpj.value.length==6)
            cnpj.value += '.'

        if(cnpj.value.length == 11)
            cnpj.value += '/'

        if(cnpj.value.length == 16)
            cnpj.value += '-'
    }

    window.onresize = start;//evento de mudança de tamanho de tela



    function menuShow() {
        let menuMobile = document.getElementById('menuzin');
        if(menuMobile.classList.contains('close')){
            menuMobile.classList.remove('close')
            menuMobile.classList.add('open')
        }
        else{
            menuMobile.classList.remove('open')
            menuMobile.classList.add('close')
        }
    }

    function start(){
        let tela = document.documentElement.clientWidth;
        let menuMobile = document.getElementById('menuzin');
        if(tela>820){
            menuMobile.classList.remove('close')
            menuMobile.classList.remove('open')
            menuMobile.classList.add('close')
        }
    }
</script>

        
        
