<?php
    /***
     * @var mixed $coligada
     * @var bool $editar
     */


?>



<?php if(isset($editar) && $editar): ?>
<div class="main-content" id="mainContent">
    <form action="/admin/coligada" method="post" accept-charset="utf-8" enctype="application/x-www-form-urlencoded" >
        <input type="hidden" name="id" value="<?= $coligada->idcoligada ?>">
        <div class="mb-3">
            <input type="text" value="<?= h($coligada->nome); ?>" name="nome" id="nome">
        </div>
        <div class="mb-3">
            <button type="submit">Alterar</button>
        </div>
    </form>
</div>
<?php endif; ?>