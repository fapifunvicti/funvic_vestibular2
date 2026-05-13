<?php
    /***
     * @var array $cursos
     */

?>

<div class="main-content" id="mainContent">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>CURSO</th>
                <th>AÇÕES</th>
            </tr>
        </thead>
        <tbody>
         <?php foreach($cursos as $curso): ?>
                <tr>
                    <td>
                        <div hx-headers='{"Cache-Control": "no-cache"}'
                             hx-push-url="false" 
                             hx-target="this" 
                             hx-swap="innerHTML" 
                             hx-get="/admin/curso?editar=true&id=<?= h($curso->idcurso); ?>&_=<?= time();  ?>" 
                             hx-trigger="click once" 
                             >
                            <?= h($curso->nome) ?>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex gap-3">
                            <button class="btn btn-primary">aaa</button>
                        </div>
                       
                    </td>
                </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>CURSO</th>
                <th>AÇÕES</th>
            </tr>
        </tfoot>
    </table>
</div>