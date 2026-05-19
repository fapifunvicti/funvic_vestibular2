<?php 

/***
 * @var object  $menu
 * @var array   $lista_menu
 */
?>
<form hx-post="/admin/menu" action="">
    <input type="hidden" name="form" value="editar">
    <input type="hidden" name="id" value="<?= h($menu->editar);  ?>">

    <div class="mb-3">
        <label class="form-label" for="nome">Nome:</label>
        <input class="form-control" required type="text" value="<?= h($menu->nome);  ?>" pattern="[a-zA-Z0-9\s]+" id="nome" name="nome">
    </div>

    <div class="mb-3">
        <label class="form-label" for="pai">Menu Pai</label>
        <select class="form-select" name="pai" id="pai">
            <option <?= $menu->pai_id === null ? 'selected': '' ?>  value="0">Nenhum</option>
            <?php foreach($lista_menu as $lista): ?>
                <option 
                <?php if($menu->pai_id != null && $menu->pai_id === $lista->idmenu) echo "selected" ?>
                value=""><?= h($lista->idmenu); ?> - <?= h($lista->nome) ?>: <?= h($lista->ativo ? "Ativo" : "Desativado") ?> </option>
            <?php endforeach; ?>

        </select>
    </div>

    <div class="mb-3">
        
    </div>

</form>