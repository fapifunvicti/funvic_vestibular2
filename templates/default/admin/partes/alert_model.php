<?php
    /***
     * @var string $titulo
     * @var string $conteudo
     */
?>
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titulo"><?= h($titulo ?? "Sem Título")  ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="conteudo">
        <div class="alert alert-danger" role="alert">
            <?= h($conteudo ?? "Sem Mensagem")  ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>