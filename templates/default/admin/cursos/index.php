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
                <th>ATIVO</th>
            </tr>
        </thead>
        <tbody>
         <?php foreach($cursos as $curso): ?>
                <tr
                    hx-headers='{"Cache-Control": "no-cache"}'
                             hx-push-url="false" 
                             hx-target="#coluna-<?= h($curso->idcurso); ?>" 
                             hx-swap="innerHTML" 
                             hx-get="/admin/curso?editar=true&id=<?= h($curso->idcurso); ?>&_=<?= time();  ?>" 
                             hx-trigger="click once" 
                >
                    <td>

                        <div id="coluna-<?= h($curso->idcurso); ?>">
                            <a href="javascript:void(0)"> 
                            <?= h($curso->nome) ?></a>
                        </div>
                    </td>
                    <td>
                        <?php if($curso->ativo === 1):  ?>
                            <span class="badge text-bg-success">Ativado</span>
                        <?php else:  ?>
                             <span class="badge text-bg-danger">Desativado</span>
                        <?PHP  endif; ?>
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