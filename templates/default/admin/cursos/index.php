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
                    <td hx-swap="outerHTML" hx-get="" hx-trigger="click" hx-target="#link">
                        <a id="link" href="javascript:void(0)"><?= h($curso->nome) ?></a>
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