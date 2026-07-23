<?php
    /***
     * @var array $ensino
     */

    //$processoView = new \App\Model\ProcessoView();
    //$processoView->whereNull('deletado_em')
    //             ->orderBy('ordem', 'desc');
?>


<div class="main-content" id="mainContent">
    <div class="row justify-content-md-center mb-3">
        <div class="col col-lg">
            <a class="btn btn-primary" href="/admin/processo/cadastrar">Cadastrar um Novo Processo</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>NOME:</th>
                <th>Ordem:</th>
                <th>ID TOTVS:</th>
                <th>Coligada</th>
                <th>Data da Prova</th>
                <th>Resultados:</th>
                <th>Ativo:</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($processos->cursor() as $p): ?>

            <?php
                $css = 'p-3 mb-2 bg_tabela_sucesso text-info';
                $link_css = 'p-3 link-danger';
                if($p->deletado_em != null){
                    $css = 'p-3 mb-2 bg_tabela_erro  text-danger';
                    $link_css = 'p-3 link-info';
                }
            ?>      

            <tr>
                <td><a class="text-uppercase <?= $link_css  ?>" href="/admin/processo/editar/<?= h($p->idprocesso) ?>"><?= h($p->nome . ' - ' . $p->coligada_nome ?? "Sem Nome");  ?></a></td>    
                <td><span class="badge rounded-pill text-bg-secondary"><?= h($p->processo_ordem);  ?></span></td>
                <td><span class="fw-bold"><?= h($p->id_totvs); ?></span></td>
                <td><span class="text-uppercase"><?= h($p->coligada_nome); ?></span></td>
                <td><?= h($p->data_prova_fmt); ?></td>
                <td>
                    <?= $p->habilitar_resultado == 0 
                    ? '<span class="badge text-bg-danger">Desabilitado</span>'
                    : '<span class="badge text-bg-primary">Habilitado</span>' ?>
                    <p>
                    <span class="badge text-bg-info">
                    <?= $p->tipo_resultado == 0 ? "Tipo: Local" : "Tipo: Via TOTVS"  ?>
                    </span>
                    </p>
                </td>
                <td>
                    <span class="badge text-bg-primary">
                    <?= $p->deletado_em === null ? "Ativo" : "Desativado"  ?>
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

</div>
