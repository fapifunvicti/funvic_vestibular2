<?php
    /***
     * @var mixed $processos
     */


    $processos = $processos->where('habilitar_resultado', '=', 1);
                             //->whereNull('deletado_em')

?>
<main class="mb-3" role="main">
    <div class="container">
        <h2 class="mb-3">Resultados</h2>

            <?php if($processos->count() > 0): ?>
            <form action="/resultado" method="post">
                <div class="mb-3">
                    <label class="form-label" for="processo">Processo Seletivo:</label>
                
                    <select 
                        hx-get="/resultado?checa_processo=1"
                        hx-trigger="changed"
                        hx-target="#usuario_cpf"
                       
                        class="select_processo_seletivo form-select-control" name="processo" id="processo">
                        <option selected value="0">Nenhum Selecionado</option>
                        <?php foreach($processos->cursor() as $processo): ?>
                        <?php
                            if($processo->data_prova_fmt !== "" || !$processo->data_prova_fmt):
                               
                        ?>
                            <option value="<?= h($processo->idprocesso);  ?>"><?= h(mb_strtoupper($processo->coligada_nome));  ?> <?= h(mb_strtoupper($processo->ensino_nome));  ?> - <?= h(mb_strtoupper($processo->nome ?? "Processo Seletivo")); ?>  <?= $processo->data_prova_fmt ?? "SEM DATA";  ?> <?= $processo->fk_ensino === 2 ? "(MEDICINA)" : "" ?></option>
                        <?php else: ?>
                            <option value="<?= h($processo->idprocesso);  ?>"><?= h(mb_strtoupper($processo->coligada_nome));  ?> <?= h(mb_strtoupper($processo->ensino_nome));  ?> - <?= h($processo->nome ?? "Processo Seletivo"); ?></option>
                        <?php  endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div id="usuario_cpf" class="input-group mb-3">
                    <span class="input-group-text">CPF</span>
                    <div class="form-floating">
                        <input 
                        hx-trigger="keyup changed delay:300ms"
                        oninput="document.getElementById('contador').innerText = (14 - this.value.length) + ' caracteres restantes'"
                        class="form-control" minlength="11" maxlength="14" required type="text"  value="" pattern="/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/" 
                        type="text" class="form-control" id="floatingInputGroup1" placeholder="CPF" id="cpf" name="cpf">
                        <label for="floatingInputGroup1">Digite o seu CPF</label>
                    </div>
                </div>

                <dib class="mb-3">
                    <span id="contador">14 caracteres restantes</span>
                </dib>
                <!--
                <div class="mb-3">
                    <label class="form-label" for="cpf">CPF:</label>
                    <input 
                     hx-trigger="keyup changed delay:300ms"
                    oninput="document.getElementById('contador').innerText = (11 - this.value.length) + ' caracteres restantes'"
                    class="form-control" minlength="11" maxlength="11" required type="text"  value="" pattern="[0-9]{11}" placeholder="Digite seu CPF (Somente Numeros) Ex: 34509022318"  id="cpf" name="cpf">
                    <span id="contador">11 caracteres restantes</span>
                </div>
                -->



                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Ir para Resultado</button>
                </div>

            </form>
            <?php else: ?>
                        <p>Desculpe Nenhum Resultado Disponivel no Momento!</p>
                    <?php endif; ?>
    </div>
</main>
<script>
  $(function () {
    $("#processo").selectize({
        plugins: ["restore_on_backspace", "clear_button"],
        delimiter: " - ",
        searchable: true,
        persist: false,
        maxItems: 1,
        valueField: "id",
        labelField: "name",
      searchField: ["name", "id"],
    });

    

  });
</script>