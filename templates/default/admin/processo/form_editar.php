<?php

/***
 * @var bool $editar
 */
    
?>


<?php if(isset($editar) && $editar): ?>

<?php else: ?>
<div class="main-content" id="mainContent">
    <form action="/admin/processo" method="post">
            <input type="hidden" name="form" value="cadastrar">
            <input type="hidden" name="dropdown" value="0">
            <input type="hidden" name="ativo" value="0">

            <div class="mb-3">
                <label class="form-label" for="nome">Nome:</label>
                <input placeholder="Digite nome do processo seletivo" class="form-control" required type="text" value="" pattern="[\p{L}\p{N}\- ]+" id="nome" name="nome">
            </div>

            <div class="mb-3">
                <label class="form-label" for="datainicio">Data de Início</label>
                <input  placeholder="Digite data inicio" class="form-control" required type="datetime-local" value="<?= new DateTime('now')->format("Y-m-d H:i:s");  ?>" pattern="[\p{L}\p{N}\- ]+" id="datainicio" name="datainicio">
            </div>

            <div class="mb-3">
                <label class="form-label" for="datafim">Data de Fim</label>
                <input  placeholder="Digite data fim" class="form-control" required type="datetime-local" value="<?= new DateTime('now')->format("Y-m-d H:i:s");  ?>" pattern="[\p{L}\p{N}\- ]+" id="datafim" name="datafim">
            </div>

            <div class="mb-3">
                <label class="form-select-label" for="curso">Tipo de Curso</label>
                <select class="form-select" name="curso" id="curso">
                    <option value="0">Nenhum</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-select-label" for="coligada">Coligada</label>
                <select class="form-select" name="coligada" id="coligada">
                    <option value="0">Nenhum</option>
                </select>

            </div>

            <div class="mb-3">
                <label class="form-select-label" for="coligada">Tipo de Ensino</label>
                <select class="form-select" name="coligada" id="coligada">
                    <option value="0">Nenhum</option>
                </select>
            </div>


            <div class="mb-3">
                <div class="mb-3 g-3">
                    <label class="form-label" for="nome">ID TOTVS</label>
                    <input   class="form-control" required type="number" min="0" max="9999999" minlength="0" maxlength="9999999" value="0" pattern="[\d+]" id="nome" name="nome">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nome">Categoria ID</label>
                    <input   class="form-control" required type="number" min="0" max="9999999" minlength="0" maxlength="9999999" value="1" pattern="[\d+]" id="nome" name="nome">
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


    </form>
</div>


<?php endif; ?>