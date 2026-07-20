<?php 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;



$capsule = \App\Core\DB::get();


    /**
     * @var Builder $processos;
     * @var Builder $coligadas;
     * @var Builder $vestibulares;
     */


$colunas = 0;
const MAX_COLUNAS  = 2;

?>


<div class="inscricoes-info">
    
    <?php if($vestibulares->count() > 0): ?>

    <?php foreach($vestibulares as $vest): ?>
        <div class="titulos">

            <h5 class="inscricao_subtitle text-secondary"><?= h($vest->nome); ?></h5>
        </div>

         <div class="w-100 cursos-grid-container  mt-4">
            <?php foreach($processos->where('vestibular_id','=', $vest->idvestibular) ->cursor() as $p): ?>
            <div class="cursos-grid-item">
                <p class="text-center text-small texto-negrito4 texto-maiusculo" style="margin: 0;">
                        <?= h($p->coligada_nome);  ?>                       
                </p>
                <div class="button-container">
                    <?php
                        $id = $p->id_totvs ?? "0";
                        $categoria = $p->categoria ?? "1";
                        $link_inscricao = "https://fundacaouniversitaria151485.rm.cloudtotvs.com.br/FrameHTML/web/app/Edu/PortalProcessoSeletivo/?c=1&f=1&ct={$categoria}&ps={$id}#/es/inscricoeswizard/dados-basicos";
                    ?>
                    <a target="_blank" href="<?=  $link_inscricao; ?>">
                        <button type="button" class="btn botao">        
                            <strong class="text-uppercase"><?= h($p->ensino_nome ?? "Processo Seletivo sem Nome");  ?></strong>
                        </button>
                    </a>
                </div>
            </div>
            
            <?php 
                $colunas++;
                if($colunas >= MAX_COLUNAS) $colunas = MAX_COLUNAS;
                else $colunas = 1;
            ?>
            <?php endforeach; ?>
         </div>

    <?php endforeach; ?>

    <?php else: ?>
            <p class="text-center text-small texto-negrito4 texto-maiusculo">
                Desculpe, nenhum vestibular ativo no momento.
            </p>
    <?php endif; ?>
</div>

<style>
 .cursos-grid-container {
		 display: grid;
		 grid-template-columns: repeat(<?= $colunas <= 1 ? 1 : 2 ?>, 1fr) !important;
		 gap: 1rem;
		 
 }
 
</style>
