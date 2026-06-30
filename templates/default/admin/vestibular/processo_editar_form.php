<?php
    /***
     * @var string $modo
     * @var int $id
     */

if($modo === "adicionar"): ?>
<div class="main-content" id="mainContent">
    <form action="/admin/vestibular/<?= h($id);  ?>" method="post" enctype="application/x-www-form-urlencoded" accept-charset="utf-8">
        <input type="hidden" name="form" value="adicionar">


        <div class="mb-3">
            <label class="form-select-label" for="processo">Tipo de Curso</label>
            <select class="form-select" name="processo" id="processo">
                <?php foreach($processos as $proc): ?>
                <?php 
                    $nome = $proc->data_prova_fmt . ': ' . $proc->coligada_nome . ' '. $proc->vestibular_nome;
                ?>

                <option value="<?= h($proc->idprocesso);  ?>"><?= h($nome); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <button class="btn btn-success btn-large">Adicionar Processo</button>
        </div>

    </form>
</div>
<?php endif; ?>