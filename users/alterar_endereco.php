<body id="pagperfil">
    <?php
        require_once('../includes/header.php');
        require_once('../includes/menu-user.php');
        require_once('../controllers/funcoes_db.php');

        $sql = "SELECT enderecos.*,nome from enderecos right join pessoas using (codpessoa) where codpessoa = ?";
        $array = array($_SESSION['codpessoa']);

        $endereco = ConsultaSelect($sql,$array);

    ?>
        <h2 class="titulo">Endereço</h2>
        <div class="center">
            <form class="form-cadastro col-05" action="../controllers/controller_usuario.php" method="post">

                <input type="hidden" name="codigo" value="<?php echo $_SESSION['codpessoa'];?>">

                <label class="label" for="cep">CEP:</label>
                <input type="text" name="cep" id="cep" required value="<?php if($endereco['cep']) echo $endereco['cep'] ?>">

                <label for="uf">UF:</label>
                <input type="text" name='uf' id='uf'  required value="<?php if($endereco['uf']) echo $endereco['uf'] ?>">

                <label for="cidade">Cidade:</label>
                <input type="text" name='cidade' id='cidade' required value="<?php if($endereco['cidade']) echo $endereco['cidade']?>">

                <label for="bairro">Bairro:</label> 
                <input type="text" name='bairro' id='bairro' required value="<?php if($endereco['bairro']) echo $endereco['bairro']?>">

                <label for="rua">Rua:</label>
                <input type="text" name='rua' id='logradouro' required value="<?php if($endereco['rua']) echo $endereco['rua']?>">

                <label for="numero">Número:</label>
                <input type="text" name='numero' id='numero' value="<?php if($endereco['numero']) echo $endereco['numero']?>">

                <label for="complemento">Complemento:</label>
                <input type="text" name='complemento' id='complemento' value="<?php if($endereco['complemento']) echo $endereco['complemento']?>">

                <input type="submit" name="botao" value="Cadastrar Endereço">

            </form>
        </div>

        <div id='msg'></div>
</body>


<?php
    require_once('../includes/footer.php');
?>

<script>
    window.onload = function(){
        let cep = document.getElementById("cep");
        cep.addEventListener("blur",loadAjax)
        
        let btn = document.getElementById('btn')
        btn.addEventListener('click',menuShow)
    }

    function loadAjax(event){
        if(this.value.length === 8){
            const ajax = new XMLHttpRequest();
            ajax.addEventListener('load', buscaValores);
            ajax.open("GET",'https://viacep.com.br/ws/'+this.value+'/json');
            document.getElementById('msg').value = this.value;
            ajax.send();
        }
        else{
            if(document.getElementById('cep').value !== ''){
                document.getElementById('logradouro').value = ''
                document.getElementById('bairro').value = '';
                document.getElementById('uf').value = '';
                document.getElementById('cidade').value = '';

                document.getElementById('logradouro').disabled = false;
                document.getElementById('bairro').disabled = false;
                document.getElementById('uf').disabled = false;
                document.getElementById('cidade').disabled = false;
                alert('Informe um cep válido');
            }

        }
    }

    function buscaValores(event){
        if(this.status == 200 && this.readyState == 4){
            var dados = JSON.parse(this.responseText);
                if(dados){
                    document.getElementById('logradouro').value = dados.logradouro;
                    document.getElementById('bairro').value = dados.bairro;
                    document.getElementById('uf').value = dados.uf;
                    document.getElementById('cidade').value = dados.localidade;
                
                    setTimeout('', 1000)

                    $aux = confirm('Seu endereço é na rua: '+document.getElementById('logradouro').value+'?')
                    if($aux){
                        document.getElementById('logradouro').setAttribute('readonly',true)
                        document.getElementById('bairro').setAttribute('readonly',true)
                        document.getElementById('uf').setAttribute('readonly',true)
                        document.getElementById('cidade').setAttribute('readonly',true)
                    }
                    else{
                        document.getElementById('logradouro').removeAttribute('readonly')
                        document.getElementById('bairro').removeAttribute('readonly')
                        document.getElementById('uf').removeAttribute('readonly')
                        document.getElementById('cidade').removeAttribute('readonly')
                        document.getElementById('logradouro').value = '';
                        document.getElementById('bairro').value = '';
                        document.getElementById('uf').value = '';
                        document.getElementById('cidade').value = '';
                    }
                }
                else
                document.getElementById('msg').value = 'deu erro';
        }
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

