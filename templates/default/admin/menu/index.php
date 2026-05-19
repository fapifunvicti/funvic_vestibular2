<?php
    /***
     * @var  object $menu
     */
?>
<div class="main-content" id="mainContent">
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome:</th>
            <th>Submenu:</th>
            <th>Ativo</th>
            <th>Menu Pai:</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($menu->cursor() as $m): ?>
        <tr
            hx-get="/admin/menu?editar=true&id=<?= h($m->idmenu) ?>"
            hx-target="#coluna-<?= h($m->idmenu) ?>"
            hx-trigger="click once"
            hx-swap="innerHTML"
        >
            <td>
                <div id="coluna-<?= h($m->idmenu) ?>">
                    <a href="javascript:void(0)"><?= h($m->nome); ?></a>
                </div>
            </td>
            <td>
                <?php 
                    if($m->pai_id !== null){
                        $filho = new \App\Model\ArvoreMenuView()->where('idmenu', '=', $m->pai_id)->first();
                        echo '<p class="fw-bold"><strong>'.$filho->nome.'</strong></p>';
                    }else {
                        echo '<p class="fw-normal">Nenhum</p>';

                    }
                ?>
            </td>
            <td><p><?= $m->ativo ? "Ativado" : 'Desativado'; ?></p> </td>
            <td>
                <?= $m->pai_id == NULL ? "Pai" : "Filho";   ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Nome:</th>
            <th>Submenus:</th>
            <th>Ativo</th>
            <th>Menu Pai:</th>
        </tr>
    </tfoot>
</table>
</div>