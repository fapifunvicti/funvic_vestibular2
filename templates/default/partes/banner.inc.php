<?php
    $request = request();
    /*
        foi pedido que seja criado um botao "resultado" e so aparece na tela de resultados
        nas demais pode ser "inscreva-se
    */
?>
<div class="banner__container">
    <div class="banner__titulo">
        <!-- <img class="banner__subtitulo" src="./images/2025_antecipado/aberta.png" alt="Subtítulo"> -->
        <img class="banner__logo" src="/images/2026_2semestre/logo.png" alt="Logo Vestibular">
        <div class="banner__botoes">
            <?php
                if($request->get_server('REQUEST_URI') === '/resultado'):
            ?>
            <a href="#resultados" class="botao__inscricao"><img src="/images/2026_2semestre/resultadosbt.png"></a>
            <?php
                else:
            ?>
            <a href="#inscricoes" class="botao__inscricao"><img src="/images/2026_2semestre/inscrevase.png"></a>
            <?php 
                endif;
            ?>
            <!-- <a href="./cursos.php" class="botao__cursos">Ver cursos</a> -->
        </div>
    </div>
    <img class="banner__alunos" src="/images/2026_2semestre/aluna.png" alt="Aluna">
</div>