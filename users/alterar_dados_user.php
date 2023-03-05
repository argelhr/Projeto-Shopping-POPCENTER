<body id="pagperfil">
<?php
    require_once('../includes/header.php');
    require_once('../includes/menu-user.php');
    require_once('../controllers/funcoes_db.php');

    $sql = 'SELECT * from pessoas where codpessoa = ?';
    $array = array($_SESSION['codpessoa']);

    $dados = ConsultaSelect($sql,$array);

    
    ?>

        
    <?php

         ?>
        <h2 class="titulo">Alterar Perfil</h2>
        <div class="center">
            <form id="cadastro" class="form-cadastro col-06" action="../controllers/controller_usuario.php" method="post" enctype="multipart/form-data">

                <label for="Nome">Nome:</label>
                <input type="text" name="nome" required value="<?php echo $dados['nome']?>">

                <label for="cpf">CPF:</label>
                <input type="text" name="cpf" id='cpf'required value="<?php echo $dados['cpf']?>" pattern="[0-9.-]*">

                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" value="<?php echo $dados['telefone']?>" pattern="[()0-9-]*">

                <label for="dt_nasc">Data de Nascimento:</label>
                <input type="date" name="dt_nasc" required value="<?php echo $dados['dt_nasc']?>">

                <label for="foto">Foto:</label>
                <input type="file" name="foto" id="foto">
                
                <label style="margin-top: 4px;display:flex;gap: 10px;" for="promocao">
                    <input type="checkbox"
                           <?php if($dados['promocoes']) echo 'checked'?>
                           name="promocao">
                           Deseja receber atualização via email?
                </label>
                

                <input type="submit" value="Atualizar Perfil" name="botao">
            
            </form>
        </div>

        
</body>

<?php
    require_once('../includes/footer.php');
?>

<script>
    window.onload = function(){
        let formulario = document.getElementById('cadastro')
        formulario.addEventListener('submit',verificaForm);
        formulario.cpf.addEventListener('keypress',aplicaMaskaraCPF);
        formulario.telefone.addEventListener('keypress',aplicaMaskaraTelefone)

        
        let btn = document.getElementById('btn')
            btn.addEventListener('click',menuShow)
    }

function verificaForm(event){
    //VERIFICA CPF
    let cpf = document.getElementById('cpf');
    if(cpf.value.length <14){
        alert('CPF invalido')
        event.preventDefault();
        return false
    }

    let cont = 0;
    for(let i = 0; i<cpf.value.length;i++){
        if(cpf.value[i] === '.')
            cont++;
    }
    
    if(cont !== 2){
        alert('CPF invalido')
        event.preventDefault();
        return false
    }

    cont = 0;
    for(let i = 0; i<cpf.value.length;i++){
        if(cpf.value[i] === '-')
            cont++;
    }
    if(cont !== 1){
        alert('CPF invalido')
        event.preventDefault();
        return false
    }
}

function aplicaMaskaraCPF(event){
    let cpf = document.getElementById('cpf')
    let tecla = event.keyCode
    if(tecla<48 || tecla>57 || cpf.value.length >=14){
        event.preventDefault()
    }
    if(cpf.value.length==3 || cpf.value.length==7){
        cpf.value += '.'
    }
    if(cpf.value.length == 11)
        cpf.value += '-'
}

function aplicaMaskaraTelefone(event){
    
    let telefone = document.getElementById('telefone')
    let tecla = event.keyCode
    if(tecla<48 || tecla>57 || telefone.value.length >=13){
        event.preventDefault()
    }
    if(telefone.value.length === 8)
        telefone.value += '-'
    if(telefone.value.length === 2)
        telefone.value += ')'
    if(telefone.value.length === 12)
        telefone.value = '('+telefone.value
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
        