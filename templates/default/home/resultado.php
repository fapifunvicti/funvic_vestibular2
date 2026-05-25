<?php
    /***
     * @var mixed $processos
     */
?>
<main class="mb-3" role="main">
    <div class="container">
        <h2 class="mb-3">Resultados</h2>

            <?php if($processos->count() > 0): ?>
            <form action="/resultado" method="post">
                <div class="mb-3 mt-3">
                    <label class="form-label" for="processo">Processo Seletivo:</label>
                
                    <select class="form-control" name="processo" id="processo">
                        <?php foreach($processos->cursor() as $processo): ?>
                        <?php
                            if($processo->data_prova):
                                $data_prova = DateTime::createFromFormat('Y-m-d H:i:s', $processo->data_prova);
                        ?>
                            <option value="<?= h($processo->idprocesso);  ?>"><?= h($processo->nome ?? "Processo Seletivo"); ?> - <?= h($data_prova->format("d/m/Y"));  ?></option>
                        <?php else: ?>
                            <option value="<?= h($processo->idprocesso);  ?>"><?= h($processo->nome ?? "Processo Seletivo"); ?></option>
                        <?php  endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="cpf">CPF:</label>
                    <input class="form-control" required type="text"  value="" pattern="[\p{L}\p{N}\- ]+" id="cpf" name="cpf">
                </div>


                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Ir para Resultado</button>
                </div>

            </form>
            <?php else: ?>
                        <p>Desculpe Nenhum Resultado Disponivel no Momento!</p>
                    <?php endif; ?>
    </div>
</main>