<?php

    require_once('./includes/header.php');
    require_once('./controllers/funcoes_db.php');

    $array = array($_SESSION['codpessoa']);
    $sql = 'select nome, nivel from pessoas where codpessoa = ?';

    $linha = ConsultaSelect($sql,$array);

?>
<body>
    <?php
        if($_SESSION['nivel'] == 'ADMIN'){
            require_once ('./includes/menu-admin.php');
        }
        else
            require_once('./includes/menu-user.php');
        
        require_once('./includes/mensagem_sessao.php');
    ?>  


    <h1 style="margin:16px; text-align: center; color:#333">
        O Pop Center, agora no conforto da sua casa!
    </h1>
    <div class="center">
        <div style="margin-bottom: 40px; padding:15px;gap: 15px;text-align: center;display:flex;flex-direction:column" class="praca">
            <div >
            Reunindo centenas de lojas populares e de pequenos lojistas, o PopCenter traz para nossa cidade um modelo inovador de comércio.
            </div>
        </div>
    </div>
    <div class="center">
        <h2>Venha conhecer o espaço que o shopping está situado</h2>
    </div>

    <div class="center">
        <div class="praca col-11">
            <img style="object-fit: cover;" src="./image/pop/pop (1).jpg" alt="">
            <div class="texto">
                <h3>Praça Cipriano Barcelos</h3>
                <div>
                    A praça Cipriano Barcelos, seu chafariz (Chafariz dos Cupidos) e mais três edificações em seus arredores (duas residências particulares e a Escola de Belas Artes, que atualmente é propriedade da UFPel) encontram-se tombados pelo IPHAN e fazem parte do Setor 4 do Conjunto Histórico de Pelotas. A praça fica ao lado do Pop Center - shopping popular da cidade - entre as ruas Marechal Floriano, Lobo da Costa, Barão de Santa Tecla e o antigo leito do Arroio Santa Bárbara.
                </div>
            </div>
        </div>
    </div>
    <h2 class="titulo">Onde nos encontrar?</h2>
    <div></div>
    <div class="center">
        <div style="box-shadow: 0px 2px 3px #333;padding:20px;background-color:#8b0000">
            <iframe style='box-shadow:0px 2px 1px #ccc' src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13568.409807936949!2d-52.3476487!3d-31.7676915!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xbc16d427ccc356d1!2sPop%20Center%20-%20Pelotas!5e0!3m2!1spt-BR!2sbr!4v1672877795033!5m2!1spt-BR!2sbr" width="480" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <div style="height: 150px;"></div>


</body>


<script>

    window.onresize = start;//evento de mudança de tamanho de tela

    window.onload = function(){
        let btn = document.getElementById('btn')
        btn.addEventListener('click',menuShow)
    }


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