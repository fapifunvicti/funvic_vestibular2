<?php 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;



$capsule = \App\Core\DB::get();


    /**
     * @var Builder $processos;
     * @var Builder $coligadas;
     */


 $total_coligadas = $coligadas->whereNull('deletado_em')
                                  ->where('ativo', '=', 1)
                                  ->count(); 

 $coligadas_cursor = $coligadas->whereNull('deletado_em')
                                  ->where('ativo', '=', 1)
                                  ->orderBy('ordem', 'asc');
$colunas = 0;
const MAX_COLUNAS  = 2;
?>

<div class="inscricoes-info">
    <div class="titulos">
        <h1 class="inscricao_title">Inscrições </h1>
        <h5 class="inscricao_subtitle text-secondary">Vestibular 2026/2</h5>
    </div>

     
    <div class="w-100 cursos-grid-container  mt-4">
        <?php  if($total_coligadas > 0 &&  $coligadas_cursor != null): ?>
        <?php foreach($coligadas_cursor->cursor() as $coligada): ?>
        <?php 

                $count = $processos->TotalColigadas($coligada->idcoligada)->first();

                if($count->total <= 0) {
                    continue;
                }
                
                $colunas++;
				       if($colunas >= MAX_COLUNAS) $colunas = MAX_COLUNAS;
				       else $colunas = 1;
        ?>

        <div class="cursos-grid-item">
            <p class="text-center text-small texto-negrito4 texto-maiusculo" style="margin: 0;">
                        <?= h($coligada->nome);  ?>                       
            </p>

           

            <div class="button-container">
                <?php $processos_abertos = $processos->ListarPorColigada($coligada->idcoligada); ?>
                <?php foreach($processos_abertos->cursor() as $proc): ?>
                
                <?php if(constant('LINK_INFORMACOES')): ?>
                <a target="_blank" href="/informacoes/<?= h($proc->idprocesso); ?>">
                                    <button type="button" class="btn botao">
                                    
                                        <strong class="text-uppercase"><?= h($proc->ensino_nome ?? "Processo Seletivo sem Nome");  ?></strong>
                                    </button>
                                </a>
                <?php else: ?>
                <?php 
                        $id = $proc->id_totvs ?? "0";
                        $categoria = $proc->categoria ?? "1";
                        $link_inscricao = "https://fundacaouniversitaria151485.rm.cloudtotvs.com.br/FrameHTML/web/app/Edu/PortalProcessoSeletivo/?c=1&f=1&ct={$categoria}&ps={$id}#/es/inscricoeswizard/dados-basicos";

                ?>

                            <a target="_blank" href="<?=  $link_inscricao; ?>">
                                    <button type="button" class="btn botao">        
                                        <strong class="text-uppercase"><?= h($proc->ensino_nome ?? "Processo Seletivo sem Nome");  ?></strong>
                                    </button>
                                </a>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
         </div>
         <?php endforeach; ?>
         <?php else:?>
            <p class="text-center text-small texto-negrito4 texto-maiusculo">
                Desculpe, nenhum vestibular ativo no momento.
            </p>
        <?php endif; ?>
    </div>
   

</div>

<style>
 .cursos-grid-container {
		 display: grid;
		 grid-template-columns: repeat(<?= $colunas <= 1 ? 1 : 2 ?>, 1fr) !important;
		 gap: 1rem;
		 
 }
 
</style>
