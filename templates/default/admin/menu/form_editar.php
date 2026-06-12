<?php 

/***
 * @var object  $menu
 * @var array   $lista_menu
 * @var bool $editar
 */
?>


<?php if(isset($editar) && $editar): ?>
<form method="post" action="/admin/menu">
    <input type="hidden" name="form" value="editar">
    <input type="hidden" name="id" value="<?= h($menu->idmenu);  ?>">
    <input type="hidden" name="dropdown" value="0">
    <input type="hidden" name="ativo" value="0">

    <div class="mb-3">
        <label class="form-label" for="nome">Nome:</label>
        <input class="form-control" required type="text"  value="<?= h($menu->nome);  ?>" pattern="[\p{L}\p{N}\- ]+" id="nome" name="nome">
    </div>


    <div class="mb-3">
        <label class="form-label" for="url">URL:</label>
        <input class="form-control" required type="text"  value="<?= h($menu->url) ?? "/";  ?>"  id="url" name="url">
    </div>

    <div class="mb-3">
        <label class="form-label" for="pai">Menu Pai</label>
        <select class="form-select" name="pai" id="pai">
            <option <?= $menu->pai_id === null ? 'selected': '' ?>  value="0">Nenhum</option>
            <?php foreach($lista_menu as $lista): ?>
                <option 
                <?php if($menu->pai_id != null && $menu->pai_id === $lista->idmenu) echo "selected" ?>
                value="<?= h($lista->idmenu);  ?>"><?= h($lista->idmenu); ?> - <?= h($lista->nome) ?>: <?= h($lista->ativo ? "Ativo" : "Desativado") ?> </option>
            <?php endforeach; ?>

        </select>
    </div>

    <div class="mb-3">
        <input  <?= $menu->dropdown ? 'checked' : '';   ?> value="1" class="form-check-control" type="checkbox" name="dropdown" id="dropdown-<?= h($menu->idmenu);  ?>">
        <label class="form-check-label" for="dropdown-<?= h($menu->idmenu);  ?>">Habilitar Dropdown</label>
    </div>

    <div class="mb-3">
        <label class="form-check-label" for="ordem-<?= h($menu->idmenu);  ?>">Ordem</label>
        <input type="number" value="<?= h($menu->ordem); ?>" name="ordem" id="ordem-<?= h($menu->idmenu);  ?>" max="100" min="0" maxlength="100" minlength="100">
        <small id="ordemHelp" class="form-text text-muted">Ordem 0  é topo e 100 é prioridade minima</small>
    </div>

    <div class="mb-3">
        <input  <?= $menu->ativo ? 'checked' : '';   ?> value="1" class="form-check-control" type="checkbox" name="ativo" id="ativo-<?= h($menu->idmenu);  ?>">
        <label class="form-check-label" for="ativo-<?= h($menu->idmenu);  ?>">Ativo</label>
    </div>


    <div class="mb-3">
        <button type="submit">Editar</button>
    </div>

</form>

<?php else: ?>


<div class="main-content" id="mainContent">
    <form method="post" action="/admin/menu">
        <input type="hidden" name="form" value="cadastrar">
        <input type="hidden" name="dropdown" value="0">
        <input type="hidden" name="ativo" value="0">

        <div class="mb-3">
            <label class="form-label" for="nome">Nome:</label>
            <input placeholder="Digite nome do menu" class="form-control" required type="text" value="" pattern="[\p{L}\p{N}\- ]+" id="nome" name="nome">
        </div>

    <div class="mb-3">
        <label class="form-label" for="url">URL:</label>
        <input class="form-control" required type="text"  value="/"  id="url" name="url">
    </div>

        <div class="mb-3">
            <label class="form-label" for="pai">Menu Pai</label>
            <select class="form-select" name="pai" id="pai">
                <option value="0">Nenhum</option>
                <?php foreach($lista_menu as $lista): ?>
                    <option 
                    value="<?= h($lista->idmenu);  ?>"><?= h($lista->idmenu); ?> - <?= h($lista->nome) ?>: <?= h($lista->ativo ? "Ativo" : "Desativado") ?> </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <input  value="1" class="form-check-control" type="checkbox" name="dropdown" id="dropdown">
            <label class="form-check-label" for="dropdown">Habilitar Dropdown</label>
            <small id="dropdownHelp" class="form-text text-muted">Habilita o modo dropdown para o menu</small>
        </div>



        <div class="mb-3">
            <label class="form-check-label" for="ordem">Ordem</label>
            <input type="number" value="0" name="ordem" id="ordem" max="100" min="0" maxlength="100" minlength="100">
            <small id="ordemHelp" class="form-text text-muted">Ordem 0  é topo e 100 é prioridade minima</small>
        </div>

        <div class="mb-3">
            <input checked value="1" class="form-check-control" type="checkbox" name="ativo" id="ativo">
            <label class="form-check-label" for="ativo">Ativo</label>
            <small id="ativoHelp" class="form-text text-muted">Ativa ou Desativa Menu</small>
        </div>

        <div class="mb-3">
            <button type="submit">Salvar</button>
        </div>

    </form>
</div>

<?php endif; ?>