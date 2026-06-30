<?php
    /***
     * @var array $ensino
     */

    $processoView = new \App\Model\ProcessoView();
    $processoView->whereNull('deletado_em')
                 ->orderBy('ordem', 'desc');
?>
<div class="main-content" id="mainContent">


 <div class="row justify-content-md-center mb-3">
        <div class="col col-lg">
            <a class="btn btn-primary" href="/admin/processo/cadastrar">Cadastrar um Novo Processo</a>
        </div>
 </div>

<?php foreach($ensino as $e): ?>
<h3>Tipo de Ensino: <?=  h($e->nome);  ?></h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome:</th>
            <th>Ordem</th>
            <th>Data da Prova</th>
            <th>Coligada:</th>
            <th>ID TOTVS / ID Categoria:</th>
            <th>Resultado:</th>
            <th>Status:</th>
        </tr>
    </thead>

    <tbody>
        <?php
            $coligada = $processoView->ListarPorEnsino($e->idensino)->cursor();
        ?>

        <?php  foreach($coligada as $c): ?>
        
        <?php
            $css = 'p-3 mb-2 bg_tabela_sucesso text-info'; //'p-3 mb-2 bg-primary bg-gradient text-white';
            $link_css = 'p-3 link-danger';
            if($c->deletado_em != null){
                $css = 'p-3 mb-2 bg_tabela_erro  text-danger';
                $link_css = 'p-3 link-info';
            }
        ?>

        <tr class="<?= $css ?>">
            <td><a class="<?= $link_css  ?>" href="/admin/processo/editar/<?= h($c->idprocesso) ?>"><?= h($c->nome ?? "Sem Nome");  ?></a></td>
            <td><span class="badge rounded-pill text-bg-info"><?=  h($c->processo_ordem); ?></span></td>
            <td>
                <div class="mb-3">
                    <?= h($c->data_prova_fmt) ?>
                </div>
            </td>
            <td>
                <?= h($c->coligada_nome)  ?>
            </td>
            <td>ID: <?= h($c->id_totvs)  ?> / Categoria:  <?= h($c->categoria) ?></td>
            <td>
                <?= $c->habilitar_resultado == 0 
                 ? '<span class="badge text-bg-danger">Desabilitado</span>'
                 : '<span class="badge text-bg-primary">Habilitado</span>' ?>
                <p>
                <span class="badge text-bg-info">
                <?= $c->tipo_resultado == 0 ? "Tipo: Local" : "Tipo: Via TOTVS"  ?>
                </span>
                </p>
            </td>
            <td>
                <span class="badge text-bg-primary">
                <?= $c->deletado_em === null ? "Ativo" : "Desativado"  ?>
                </span>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>

</table>
<?php endforeach; ?>

</div>