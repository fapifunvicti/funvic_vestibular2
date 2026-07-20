<?php
    /***
     * @var mixed $processo
     */


?>

<div class="main-content" id="mainContent">
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Coligada</th>
                <th>Processo</th>
                <th>Data da Prova:</th>
                <th>Açoes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($processo->cursor() as $p): ?>
            <tr>
                <td><?= h($p->coligada_nome);  ?></td>
                <td><?= h($p->nome);  ?></td>
                <td><?= h($p->vestibular_data_prova_fmt)   ?></td>
                <td>
                    <div class="mb-3">
                        <a href="javascript: void(0)" hx-get="/admin/vestibular/deletar/<?= h($p->idprocesso)  ?>/<?= h($p->vestibular_id)  ?>"   class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>NOME</th>
                <th>Processos:</th>
            </tr>
        </tfoot>
    </table>
</div>