<?php
/***
 * @var object $curso
 * @var bool $modo_editar 
 */
?>

<?php if(isset($modo_editar) &&  $modo_editar): ?>

<form hx-post="/admin/curso">
    <input type="hidden" name="form" value="editar">
    <input type="hidden" name="id" value="<?= h($curso->idcurso); ?>">
<div class="d-flex gap-3 mb-3">
    <input required type="text" value="<?= h($curso->nome);  ?>" pattern="[a-zA-Z0-9 ]+" name="nome">
</div>
<div class="mb-3">
    <button type="submit">Editar</button>
</div>
</form>

<?php else: ?>
    <div hx-headers='{"Cache-Control": "no-cache"}'
            hx-push-url="false" 
            hx-target="this" 
            hx-swap="innerHTML" 
            hx-get="/admin/curso?editar=true&id=<?= h($curso->idcurso); ?>&_=<?= time();  ?>" 
            hx-trigger="click once" 
            >
        <?= h($curso->nome) ?>
    </div>

<?php endif; ?>