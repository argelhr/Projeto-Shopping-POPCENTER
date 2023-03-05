<body id="lojas">
    <?php
        require_once('./includes/header.php');
        require_once('./includes/menu-admin.php');
        require_once('./controllers/funcoes_db.php');

    ?>

    <h2 class="titulo">Escolha a loja a ser editada</h2>

        <div>
            <?php
                require_once('./includes/mensagem_sessao.php');
            ?>
        </div>
        
        <form id="formulario" action="listar_pessoas.php" method="get" onsubmit="return false">
            <input type="search" name="pesquisa" id="pesquisa" placeholder="Informe o nome da loja procurada">
        </form>
        
        
        <div id="carrega">
            <?php
                require_once('./listar_lojas.php');
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

        ajax.open('GET','listar_lojas.php?pesquisa='+input.value)
        ajax.send(formulario)
        ajax.addEventListener('load', BuscaConteudo)
    }

    function BuscaConteudo() {
        if(this.status == 200 && this.readyState==4) {
            var pagina = this.responseText;
            var carrega = document.getElementById("carrega")
            if (pagina) {
                carrega.innerHTML=pagina
            }

            } else {
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
