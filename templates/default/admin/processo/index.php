<?php
    /***
     * @var array $ensino
     */

    $processoView = new \App\Model\ProcessoView();
?>
<div class="main-content" id="mainContent">

<?php foreach($ensino as $e): ?>
<h3>Tipo de Ensino: <?=  h($e->nome);  ?></h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome:</th>
            <th>Data da Prova</th>
            <th>ID TOTVS / ID Categoria:</th>
            <th>Resultado:</th>
        </tr>
    </thead>

    <tbody>
        <?php
            $coligada = $processoView->ListarPorEnsino($e->idensino)->cursor();
        ?>

        <?php  foreach($coligada as $c): ?>
        <tr>
            <td><?= h($c->nome ?? "Sem Nome");  ?></td>
            <td>
                <div class="mb-3">
                    <?= h($c->data_prova_fmt) ?>
                </div>
            </td>
            <td>ID: <?= h($c->id_totvs)  ?> / Categoria:  <?= h($c->categoria) ?></td>
            <td>
                <?= $c->habilitar_resultado == 0 
                 ? '<span class="badge badge-danger">Desabilitado</span>'
                 : '<span class="badge badge-primary">Habilitado</span>' ?>
                <p>
                <?= $c->tipo_resultado == 0 ? "Tipo: Local" : "Tipo: Via TOTVS"  ?>
                </p>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>

</table>
<?php endforeach; ?>

</div>