<body id="usuarios">
    <?php
        require_once('./includes/header.php');
        require_once('./includes/menu-admin.php');
        require_once('./controllers/funcoes_db.php');
        $conexao=fazconexao();

        $sql = "select * from pessoas where codpessoa != 1";
        $linhas = ConsultaSelectAll($sql);
        
    ?>

        
        <h2 class="titulo">Gerenciar Usuários</h2>
        
        <?php
            require_once('./includes/mensagem_sessao.php');
        ?>

        <form name="formulario" id="formulario" action="listar_pessoas.php" method="post" onsubmit="return false">
            <input type="search" id="pesquisa" name="pesquisa" placeholder="Digite aqui o nome procurado..">
        </form>
        <div id="carrega">
        <?php
            require_once('./listar_pessoas.php');
        ?>
    </div>
</body>




<script>
    window.onload = function(){
        let input = document.getElementById('pesquisa')
        input.addEventListener('keyup',iniciaAjax)

        let btn = document.getElementById('btn')
        btn.addEventListener('click',menuShow)
    }

    function iniciaAjax(event){
        let input = document.getElementById('pesquisa')
        const ajax = new XMLHttpRequest
        var carrega = document.getElementById("carrega")
        carrega.innerHTML=""

        ajax.open('GET','listar_pessoas.php?pesquisa='+input.value)
        ajax.send()
        ajax.addEventListener('load', BuscaConteudo)

    }

    function BuscaConteudo() {
        if(this.status == 200 && this.readyState==4) {
            var pagina = this.responseText;
            var carrega = document.getElementById("carrega")
            if (pagina) {
                carrega.innerHTML=pagina
            }

        }
        else {
            if(this.status == 404)
                alert("Arquivo Não encontrado")
                    console.log('Somthing wrong happen:',this.status)
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