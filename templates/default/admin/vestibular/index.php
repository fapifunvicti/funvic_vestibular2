<?php
    /***
     * @var mixed $vestibular
     */
?>

<div class="main-content" id="mainContent">
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>NOME</th>
                <th>Processos:</th>
                <th>Ativo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($vestibular as $v): ?>
            <tr>
                <td><?=  h($v->nome); ?></td>
                <td>
                    <a href="/admin/vestibular/<?= h($v->idvestibular);  ?>">Ver Processos</a>
                </td>
                <td>
                    <div class="form-check mb-3">
                        <div class="form-check mb-3">
                            <label for="ativo-<?= h($v->idvestibular); ?>">Ativo</label>
                            <input <?= $v->deletado_em === null ? 'checked' : ''  ?>  ativo-dinamico="true" data-id="<?= h($v->idvestibular)  ?>" class="form-check-input" type="checkbox" value="<?= $v->deletado_em === null ? '0' : '1' ?>" name="ativo" id="ativo-<?= h($v->idvestibular); ?>">
                        </div>
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

<script>
    $(function(){
            $('input[ativo-dinamico="true"]').on('change', function(){
                const id = $(this).data('id');
                $.post('/admin/vestibular',{
                'ativo': this.checked ? 1 : 0,
                'id': id
                }).done(function(d){

                });
            });

    });
</script>