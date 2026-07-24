<?php 
use Illuminate\Database\Eloquent\Builder;

/**
 * @var Builder $processos;
 * @var Builder $coligadas;
 * @var Builder $vestibulares;
 * @var array   $processos_permitidos
 */


$colunas = 0;
const MAX_COLUNAS  = 2;
?>

<?php if($vestibulares->get()->count() > 0 ): ?>
<div class="inscricoes-info">



        <div class="titulos_fixo">
            <h1 class="inscricao_title">Inscrições </h1>
        </div>
        

        <?php foreach($vestibulares->cursor() as $vest): ?>
        <div class="titulos">
            <h5 class="inscricao_subtitle text-secondary"><?= h($vest->nome); ?></h5>
        </div>

         <div class="w-100 cursos-grid-container  mt-4">
                <?php foreach($coligadas->cursor() as $c): ?>
                <div class="cursos-grid-item">
                    <p class="text-center text-small texto-negrito4 texto-maiusculo" style="margin: 0;">
                        <?= h($c->coligada_nome);  ?>                       
                    </p>
                    
                    <div class="button-container">
                        <?php foreach($processos->whereNull('deletado_em')
                                            ->where('vestibular_id', '=', $vest->idvestibular)
                                            ->where('fk_coligada','=', $c->idcoligada)->cursor() as $p):
                                            
                            ?>
                            <?php
                                $id = $p->id_totvs ?? "1";
                                $categoria = $p->categoria ?? "1";
                                $link_inscricao = "https://fundacaouniversitaria151485.rm.cloudtotvs.com.br/FrameHTML/web/app/Edu/PortalProcessoSeletivo/?c=1&f=1&ct={$categoria}&ps={$id}#/es/inscricoeswizard/dados-basicos";
                            ?>
                            <a target="_blank" href="<?=  $link_inscricao; ?>">
                                <button type="button" class="btn botao">        
                                    <strong class="text-uppercase"><?= h($p->nome ?? "Processo Seletivo sem Nome");  ?></strong>
                                </button>
                            </a>
                            <?php 
                                $colunas++;
                                if($colunas >= MAX_COLUNAS) $colunas = MAX_COLUNAS;
                                else $colunas = 1;
                            ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
         </div>

        <?php endforeach; ?>

</div>

<?php else: ?>
<div class="d-flex justify-content-center align-items-center min-vh-50 p-4">
    <div class="card border-0 shadow-sm text-center" style="max-width: 420px;">
        <div class="card-body py-5 px-4">
            <div class="mb-3">
                <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;"></i>
            </div>
            <h4 class="fw-bold text-uppercase mb-2">Ops!</h4>
            <p class="text-secondary mb-0">
                Desculpe, não há nenhum processo seletivo aberto no momento!
            </p>
        </div>
    </div>
</div>

<?php endif; ?>


<style>
 .cursos-grid-container {
		 display: grid;
		 grid-template-columns: repeat(<?= $colunas <= 1 ? 1 : 2 ?>, 1fr) !important;
		 gap: 1rem;
		 
 }
 
</style>
