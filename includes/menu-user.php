<header class="header">
    <a href="http://localhost/POPCENTER/index.php"><img src="http://localhost/POPCENTER/image/logo.png" width="128px" alt="eae"></a>
    <nav>
        <ul class="menu">
            
            <li class="pagPesquisa"><a href="http://localhost/POPCENTER/users/pesquisa.php">Pesquisa</a></li>
            <li class="pagperfil">Perfil
                <ul class="sub-menu">
                    <li><a href="http://localhost/POPCENTER/users/gerenciar_perfil.php">Meu Perfil</a></li>
                    <li><a href="http://localhost/POPCENTER/users/verificar_pedidos.php">Meus Pedidos</a></li>
                    <?php
                        if($_SESSION['nivel'] == 'LOJISTA'){
                            ?>
                            <li><a href="http://localhost/POPCENTER/users/gerenciar_lojas.php">Gerenciar Lojas</a></li>
                            <li><a href="http://localhost/POPCENTER/users/gerenciar_pedidos.php">Gerenciar Pedidos</a></li>
                            
                            <?php

                        }
                    ?>
                </ul>
            </li>

            
            <li class="sacola"><a href="http://localhost/POPCENTER/users/gerenciar_sacola.php">Sacola</a></li>
            <li><a href="http://localhost/POPCENTER/sair.php">Sair</a></li>
        </ul>
    </nav>
</header>



<header>
    <div class="header2">
        <a href="http://localhost/POPCENTER/index.php"><img src="http://localhost/POPCENTER/image/logo.png" width="128px" alt="eae"></a>
        <button id="btn"><img src="http://localhost/POPCENTER/image/icon.png" width="50px" alt="a"></button>
    </div>
    <div id="menuzin" class="close">
        <a href="http://localhost/POPCENTER/users/pesquisa.php">Pesquisa</a>
        <details>
            <summary>Perfil</summary>
                <div class="interno"><a href="http://localhost/POPCENTER/users/gerenciar_perfil.php">Meu Perfil</a></div>
                <div class="interno"><a href="http://localhost/POPCENTER/users/verificar_pedidos.php">Meus Pedidos</a></div>
                
                <?php
                        if($_SESSION['nivel'] == 'LOJISTA'){
                            ?>
                            <div class="interno"><a href="http://localhost/POPCENTER/users/gerenciar_lojas.php">Gerenciar Lojas</a></div>
                            <div class="interno"><a href="http://localhost/POPCENTER/users/gerenciar_pedidos.php">Gerenciar Pedidos</a></div>
                            <?php
                        }
                ?>
        </details>
        <a href="http://localhost/POPCENTER/users/gerenciar_sacola.php">Sacola</a>
        <br>
        <a href="http://localhost/POPCENTER/sair.php">Sair</a>
    </div>
</header>

   <!-- <script>

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
</script> -->

