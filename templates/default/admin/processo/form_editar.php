<?php

/***
 * @var bool $editar
 * @var string $timezone
 * @var mixed $processo
 * @var mixed $curso
 * @var mixed $coligada
 * @var mixed $ensino
 */
    
global $timezone; // existe em bootstrap.php
$now = new DateTime('now', new DateTimeZone($timezone));


?>


<?php if(isset($editar) && $editar): ?>


<div class="main-content" id="mainContent">
    <form action="/admin/processo/editar/<?= h($processo->idprocesso); ?>" method="post">
            <input type="hidden" name="form" value="editar">
            <input type="hidden" name="dropdown" value="0">
            <input type="hidden" name="ativo" value="0">
            <input type="hidden" name="tiporesultado" value="0">
            <input type="hidden" name="resultado" value="0">

            <div class="mb-3">
                <label class="form-label" for="nome">Nome:</label>
                <input placeholder="Digite nome do processo seletivo" class="form-control" required type="text" value="<?= h($processo->nome ?? "Sem Nome");  ?>" pattern="[\p{L}\p{N}\- ]+" id="nome" name="nome">
            </div>

            <div class="mb-3">
                <label class="form-label" for="dataprova">Data Prova:</label>
                <input  placeholder="Digite data de prova" class="form-control" required type="datetime-local" value="<?= h($processo->data_prova ?? "1970-01-01 00:00:00");  ?>"  id="dataprova" name="dataprova">
            </div>


            <div class="mb-3">
                <label class="form-label" for="datainicio">Data Início do Resultado:</label>
                <input  placeholder="Digite data inicio" class="form-control" required type="datetime-local" value="<?= h($processo->data_resultado_inicio ?? "0000-00-00" );  ?>"  id="datainicio" name="datainicio">
            </div>

            <div class="mb-3">
                <label class="form-label" for="datafim">Data de Fim do Resultado:</label>
                <input  placeholder="Digite data fim" class="form-control" type="datetime-local" value="<?= h($processo->data_resultado_fim ?? "0000-00-00 00:00:00" );  ?>"  id="datafim" name="datafim">
            </div>

            <div class="mb-3">
                <label class="form-select-label" for="curso">Tipo de Curso</label>
                <select class="form-select" name="curso" id="curso">
                    <?php foreach($curso as $c): ?>
                    <option <?=  (int)$c->idcurso === (int)$processo->curso_fk ? 'selected' : '' ?> value="<?= h($c->idcurso);  ?>"><?= h($c->nome); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-select-label" for="coligada">Coligada</label>
                <select class="form-select" name="coligada" id="coligada">
                    <?php foreach($coligada as $c): ?>
                    <option <?= (int)$c->idcoligada === (int)$processo->coligada_fk ? 'selected' : '' ?> value="<?= h($c->idcoligada);  ?>"><?= h($c->nome); ?></option>
                    <?php endforeach; ?>
                </select>

            </div>

            <div class="mb-3">
                <label class="form-select-label" for="ensino">Tipo de Ensino</label>
                <select class="form-select" name="ensino" id="ensino">
                    <?php foreach($ensino as $e): ?>
                    <option <?= (int)$e->idensino === (int)$processo->ensino_fk ? 'selected' : '' ?> value="<?= h($e->idensino);  ?>"><?= h($e->nome); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div class="mb-3">
                <div class="mb-3 g-3">
                    <label class="form-label" for="nome">ID TOTVS</label>
                    <input   class="form-control" required type="number" min="0" max="9999999" minlength="0" maxlength="9999999" value="<?= h($processo->id_totvs); ?>" pattern="[\d+]" id="idtotvs" name="idtotvs">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nome">Categoria ID</label>
                    <input   class="form-control" required type="number" min="0" max="9999999" minlength="0" maxlength="9999999" value="<?= h($processo->categoria); ?>" pattern="[\d+]" id="categoriaid" name="categoriaid">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="ordem">Ordem</label>
                    <input   class="form-control" required type="number" min="0" max="9999999" minlength="0" maxlength="9999999" value="<?= h($processo->processo_ordem); ?>" pattern="[\d+]" id="ordem" name="ordem">
                </div>
            </div>

        <div class="mb-3">
            <input <?= (int)$processo->habilitar_resultado > 0 ? 'checked' : '' ?>  value="1" class="form-check-control" type="checkbox" name="resultado" id="resultado">
            <label class="form-check-label" for="resultado">Habilitar Resultado</label>
            <small id="dropdownHelp" class="form-text text-muted">Habilita o resultado no menu principal</small>
        </div>

        <div class="mb-3">
            <label class="form-select-label" for="tiporesultado">Tipo de Resultado</label>
            <select class="form-select" name="tiporesultado" id="tiporesultado">
                <option  <?= (int)$processo->tipo_resultado === 0 ? 'selected' : '' ?> value="0">Local</option>
                <option <?= (int)$processo->tipo_resultado  === 1 ? 'selected' : '' ?>  value="1">TOTVS</option>
            </select>
            <small id="dropdownHelp" class="form-text text-muted">Qual tipo de resultado para gerar link corretamente</small>
        </div>

        <div class="mb-3">
            <input <?= $processo->deletado_em  === NULL   ? 'checked' : '' ?>  value="1" class="form-check-control" type="checkbox" name="ativo" id="ativo">
            <label class="form-check-label" for="ativo">Ativo</label>
            <small id="dropdownHelp" class="form-text text-muted">Se Desabilitado nao aparece mais no site principal</small>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Editar</button>
        </div>

    </form>
</div>



<?php else: ?>
<div class="main-content" id="mainContent">
    <form action="/admin/processo/cadastrar" method="post">
            <input type="hidden" name="form" value="cadastrar">
            <input type="hidden" name="dropdown" value="0">
            <input type="hidden" name="ativo" value="0">
            <input type="hidden" name="tiporesultado" value="0">
            <input type="hidden" name="resultado" value="0">

            <div class="mb-3">
                <label class="form-label" for="nome">Nome:</label>
                <input placeholder="Digite nome do processo seletivo" class="form-control" required type="text" value="" pattern="[\p{L}\p{N}\- ]+" id="nome" name="nome">
            </div>

            <div class="mb-3">
                <label class="form-label" for="dataprova">Data Prova:</label>
                <input  placeholder="Digite data de prova" class="form-control" required type="datetime-local" value=""  id="dataprova" name="dataprova">
            </div>

            <div class="mb-3">
                <label class="form-label" for="datainicio">Data de Início</label>
                <input  placeholder="Digite data inicio" class="form-control" required type="datetime-local" value=""  id="datainicio" name="datainicio">
            </div>

            <div class="mb-3">
                <label class="form-label" for="datafim">Data de Fim</label>
                <input  placeholder="Digite data fim" class="form-control" required type="datetime-local" value=""  id="datafim" name="datafim">
            </div>

            <div class="mb-3">
                <label class="form-select-label" for="curso">Tipo de Curso</label>
                <select class="form-select" name="curso" id="curso">
                    <?php foreach($curso as $c): ?>
                    <option value="<?= h($c->idcurso);  ?>"><?= h($c->nome); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-select-label" for="coligada">Coligada</label>
                <select class="form-select" name="coligada" id="coligada">
                    <?php foreach($coligada as $c): ?>
                    <option  value="<?= h($c->idcoligada);  ?>"><?= h($c->nome); ?></option>
                    <?php endforeach; ?>
                </select>

            </div>

            <div class="mb-3">
                <label class="form-select-label" for="ensino">Tipo de Ensino</label>
                <select class="form-select" name="ensino" id="ensino">
                    <?php foreach($ensino as $e): ?>
                    <option  value="<?= h($e->idensino);  ?>"><?= h($e->nome); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <div class="mb-3 g-3">
                    <label class="form-label" for="nome">ID TOTVS</label>
                    <input   class="form-control" required type="number" min="0" max="9999999" minlength="0" maxlength="9999999" value="0" pattern="[\d+]" id="idtotvs" name="idtotvs">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="categoriaid">Categoria ID</label>
                    <input   class="form-control" required type="number" min="0" max="9999999" minlength="0" maxlength="9999999" value="1" pattern="[\d+]" id="categoriaid" name="categoriaid">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="ordem">Ordem</label>
                    <input   class="form-control" required type="number" min="0" max="9999999" minlength="0" maxlength="9999999" value="0" pattern="[\d+]" id="ordem" name="ordem">
                </div>
            </div>

        <div class="mb-3">
            <input  value="1" class="form-check-control" type="checkbox" name="resultado" id="resultado">
            <label class="form-check-label" for="resultado">Habilitar Resultado</label>
            <small id="dropdownHelp" class="form-text text-muted">Habilita o resultado no menu principal</small>
        </div>

        <div class="mb-3">
            <label class="form-select-label" for="tiporesultado">Tipo de Resultado</label>
            <select class="form-select" name="tiporesultado" id="tiporesultado">
                <option value="0">Local</option>
                <option value="1">TOTVS</option>
            </select>
            <small id="dropdownHelp" class="form-text text-muted">Qual tipo de resultado para gera rlink corretamente</small>
        </div>

        <div class="mb-3">
            <input checked  value="1" class="form-check-control" type="checkbox" name="ativo" id="ativo">
            <label class="form-check-label" for="ativo">Ativo</label>
            <small id="dropdownHelp" class="form-text text-muted">Se Desabilitado nao aparece mais no site principal</small>
        </div>


        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Cadastrar novo Processo!</button>
        </div>

    </form>
</div>


<?php endif; ?>