<?php
/***
 * @var object $curso
 * @var bool $modo_editar 
 */
?>

<?php if(isset($modo_editar) &&  $modo_editar): ?>

<form hx-post="/admin/curso"  hx-target="#coluna-<?= h($curso->idcurso); ?>">
    <input type="hidden" name="form" value="editar">
    <input type="hidden" name="ativo" value="0">
    <input type="hidden" name="id" value="<?= h($curso->idcurso); ?>">
<div class="mb-3">
    <input required type="text" value="<?= h($curso->nome);  ?>" pattern="[a-zA-Z0-9 ]+" name="nome">
</div>

<div class="mb-3">

    <input class="form-check-input"  <?= $curso->ativo ? "checked" : ""; ?> type="checkbox" name="ativo" id="ativo" >
    <label class="form-check-label"  for="ativo">Ativo</label>
</div>

<div class="d-flex align-items-center gap-3 mt-4">
    <button type="submit">Editar</button>
    <button hx-swap="innerHTML"  hx-trigger="click once" hx-target="#coluna-<?= h($curso->idcurso); ?>" hx-get="/admin/curso?editar=false&id=<?= h($curso->idcurso); ?>&_=<?= time();  ?>" type="button">Cancelar</button>
</div>
</form>

<?php else: ?>
    <div    hx-target="#coluna-<?= h($curso->idcurso); ?>"
            hx-headers='{"Cache-Control": "no-cache"}'
            hx-push-url="false" 
            hx-target="this" 
            hx-swap="innerHTML" 
            hx-get="/admin/curso?editar=true&id=<?= h($curso->idcurso); ?>&_=<?= time();  ?>" 
            hx-trigger="click once" 
            >
            <a href="javascript:void(0)">
                <?= h($curso->nome) ?>
            </a>
    </div>

<?php endif; ?>