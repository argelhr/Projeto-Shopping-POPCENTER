<body id="email">
    <?php
        require_once('./includes/menu-admin.php');
        require_once('./includes/header.php');
    ?>
        <h2 class="titulo">Promoção</h2>

        <?php 
            require_once('./includes/mensagem_sessao.php');
        ?>

        <div class="center">
            <form class="form-cadastro col-06" action="./controllers/controller_lojas.php" method="post">
                
                <label for="pessoas">Escolha o público</label>
                <select name="pessoas">
                    <option value="LOJISTAS">Lojistas</option>
                    <option value="CLIENTES">Clientes</option>
                </select>
                    
                <label for="assunto">Assunto:</label>
                <input type="text" name="assunto" required>
                
                <label for="mensagem">Mensagem</label>
                <textarea minlength=20 name="mensagem" rows='10'></textarea>
                
                <input type="submit" value="Enviar Email" name="botao">
            
            </form>
        </div>
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