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
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" value="<?= h($coligada->nome); ?>" name="nome" id="nome">
        </div>
        <div class="mb-3 ">
            <label for="nome" class="form-label">Ordem</label>
            <input value="<?= $coligada->ordem; ?>" type="number" max="999999" min="-9999999"  class="form-control"  name="ordem" id="ordem">
        </div>
        <div class="mb-3">
            <button type="submit">Alterar</button>
        </div>
    </form>
</div>
<?php endif; ?>