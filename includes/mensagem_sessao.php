
    <?php
        if(isset($_SESSION['msg'])){
            ?>
            <div class="center">
                <div id="mensagem">
                    <?php
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    ?>
                </div>        
            </div>
            <?php
        }
    ?> 