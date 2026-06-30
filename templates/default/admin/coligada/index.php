<?php
    /***
     * @var mixed $coligadas
     */
?>
<div class="main-content" id="mainContent">

    <table class="table stable-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Ativo</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($coligadas as $col): ?>
            <tr>
                <td>
                    <a href="/admin/coligada/<?= h($col->idcoligada);  ?>"><?= h($col->nome);  ?></a>
                </td>
                <td>
                    
                    <input hx-trigger="change" hx-get="/admin/coligada?status=true&id=<?= h($col->idcoligada);  ?>&ativo=<?= h($col->ativo) ?>"  <?= (int)$col->ativo > 0 ? 'checked' : '';   ?> type="checkbox" name="ativo" id="ativo-<?= h($col->idcoligada); ?>">
                    <label for="ativo-<?= h($col->idcoligada); ?>"><?= (int)$col->ativo > 0 ? 'Ativado' : 'Desativado';   ?></label>
                </td>
            </tr>

            <?php endforeach; ?>
        </tbody>

    </table>

</div>