<?php

use App\Model\MenuItem;
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
            <th>Ordem</th>
            <th>Dropdown Ativo</th>
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
                    if($m->nivel > 0){
                        $filho = new MenuItem();
                        $filho = $filho->where('idmenu', '=', $m->pai_id)->get()->first();

                        if($filho){
                             echo '<p class="fw-bold"><strong>'.$filho->nome.'</strong></p>';
                        }
                    }else {
                        echo '<p class="fw-regular">Nenhum</p>';
                    }
                ?>
            </td>
            <td>
                <div class="mb-3">
                    <?=  h($m->ordem); ?>
                </div>
            </td>
            <td><?= $m->dropdown ? 'Sim' : 'Não' ?></td>
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
            <th>Dropdown</th>
            <th>Ativo</th>
            <th>Menu Pai:</th>
        </tr>
    </tfoot>
</table>
</div>