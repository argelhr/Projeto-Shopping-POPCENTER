<body id="pagPesquisa">
    <?php
        require_once('../includes/header.php');
        require_once('../includes/menu-user.php');
        require_once('../controllers/funcoes_db.php');

    ?>


    <h2 class="titulo">Filtro de pesquisa</h2>

    <form class="radio" action="#" onsubmit="return false">
        <div>
            <input type="radio" name="opcao" id="opcao1" value="lojas" checked >
            Lojas
        </div>
        <div>
            <input type="radio" name="opcao" id="opcao2" value="departamentos">
            Departamentos</div>
        <div>
            <input type="radio" name="opcao" id="opcao3" value="produtos">
            Produtos
        </div>
    </form>
    
    <form style="display: flex; justify-content:center;margin: 20px" action="#" method="get" onsubmit="return false">
        <input type="search" name="pesquisa" id="pesquisa" placeholder="Digite aqui a sua pesquisa...">
    </form>

    <div>
        <?php
            require_once('../includes/mensagem_sessao.php');
        ?>
    </div>

    <div id="carrega">
        <?php
            require_once('./lojas.php');
        ?>
    </div>
</body>

<?php
    require_once('../includes/footer.php');
?>


<script>

    window.onload = function(){
        let opcao1 = document.getElementById('opcao1')
        let opcao2 = document.getElementById('opcao2')
        let opcao3 = document.getElementById('opcao3')
        
        let btn = document.getElementById('btn')
        btn.addEventListener('click',menuShow)

        opcao1.addEventListener('change',iniciaAjax)
        opcao2.addEventListener('change',iniciaAjax)
        opcao3.addEventListener('change',iniciaAjax)

        let pesquisa = document.getElementById('pesquisa');
        pesquisa.addEventListener('keyup',iniciaAjax2)
    }

    function iniciaAjax(event){

        var selectedRadio = document.querySelector('input[type="radio"]:checked');
        const ajax = new XMLHttpRequest
        var carrega = document.getElementById("carrega")
        carrega.innerHTML=""
        if(selectedRadio.value === 'lojas'){
            ajax.open('POST','lojas.php')
            ajax.send()
            ajax.addEventListener('load', BuscaConteudo)
             alert('Posso te ajudar?')
        }

        if(selectedRadio.value === 'departamentos'){
            ajax.open('POST','departamentos.php')
            ajax.send()
            ajax.addEventListener('load', BuscaConteudo)
        }

        if(selectedRadio.value === 'produtos'){
            ajax.open('POST','produtos.php')
            ajax.send()
            ajax.addEventListener('load', BuscaConteudo)
        }

}

function BuscaConteudo() {
    if(this.status == 200 && this.readyState==4) {
        var pagina = this.responseText;
        var carrega = document.getElementById("carrega")
        if (pagina){
            carrega.innerHTML=pagina
        }

    }
    else{
        if(this.status == 404)
            alert("Arquivo Não encontrado")
            console.log('Somthing wrong happen:',this.status)
    } 
}
function iniciaAjax2(event){
    let input = document.getElementById('pesquisa')
    const ajax = new XMLHttpRequest
    var carrega = document.getElementById("carrega")
    carrega.innerHTML=""

    let opcao = document.querySelector('input[name="opcao"]:checked').value

    ajax.open('GET', './' + opcao + ".php?pesquisa=" + input.value)
    ajax.send()
    ajax.addEventListener('load', BuscaConteudo2)
}

function BuscaConteudo2() {
    if(this.status == 200 && this.readyState==4) {
        var pagina = this.responseText;
        var carrega = document.getElementById("carrega")
        if (pagina){
            carrega.innerHTML=pagina
        }

    }
    else{
        if(this.status == 404)
            alert("Arquivo Não encontrado")
                console.log('Something wrong happen:',this.status)
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