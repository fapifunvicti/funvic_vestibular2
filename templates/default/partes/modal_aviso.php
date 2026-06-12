<?php 
    /**
     * @var string $mensagem
     */
?>
<div class="modal fade" id="<?= $modal_id ?? "avisoModal"  ?>" tabindex="-1" aria-labelledby="<?= $modal_id ?? "avisoModal"  ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><?= h($titulo ?? "AVISO!");  ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?= h($mensagem)  ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<script>
  $(function(){
    const myModal = new bootstrap.Modal('#<?= $modal_id ?? "avisoModal"  ?>', {
      keyboard: false
    })

    myModal.toggle();

  });
</script>