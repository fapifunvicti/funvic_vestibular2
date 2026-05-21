<?php 
use Illuminate\Database\Eloquent\Builder;

    /**
     * @var Builder $processos;
     * @var Builder $coligadas;
     */


    $total_coligadas = $coligadas->whereNull('deletado_em')
                                  ->where('ativo', '=', 1)
                                  ->count(); 

    $coligadas_cursor = $coligadas->whereNull('deletado_em')
                                  ->where('ativo', '=', 1);
?>
<style>
    .cursos-grid-container {
	    display: grid;
	    grid-template-columns: repeat(<?=  h($total_coligadas) ?>, 1fr);
	    gap: 1rem;
	
    }
</style>
<div class="inscricoes-info">
    <div class="titulos">
        <h1 class="inscricao_title">Inscrições </h1>
        <h5 class="inscricao_subtitle text-secondary">Vestibular 2026/2</h5>
    </div>

     
    <div class="w-100 cursos-grid-container  mt-4">
        <?php  if($total_coligadas > 0 &&  $coligadas_cursor != null): ?>
        <?php foreach($coligadas_cursor->cursor() as $coligada): ?>
        <div class="cursos-grid-item">
            <p class="text-center text-small texto-negrito4 texto-maiusculo" style="margin: 0;">
                        <?= h($coligada->nome);  ?>                       
            </p>

           

            <div class="button-container">
                <?php $processos_abertos = $processos->ListarPorColigada($coligada->idcoligada); ?>
                <?php foreach($processos_abertos->cursor() as $proc): ?>
                 
                <a target="_blank" href="/informacoes/<?= h($proc->idprocesso); ?>">
                                    <button type="button" class="btn botao">
                                    
                                        <strong><?= h($proc->ensino_nome ?? "Processo Seletivo sem Nome");  ?></strong>
                                    </button>
                                </a>
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