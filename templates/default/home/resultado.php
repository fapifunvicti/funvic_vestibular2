<div class="main-content" id="mainContent">
    <h2 class="g-3 mt-3">Escolha o Resultado:</h2>

    <div class="form-row">
          <?php if($processos->count() > 0): ?>
        <form action="resultado" method="post">
            <div class="form-group col-lg-12">
                <label for="processo">Processo Seletivo:</label>
              
                <select class="form-control" name="processo" id="processo">
                    <?php foreach($processos->cursor() as $processo): ?>
                    <option value=""></option>
                    <?php endforeach; ?>
                </select>
               
            </div>
        </form>
         <?php else: ?>
                    <p>Desculpe Nenhum Resultado Disponivel no Momento!</p>
                <?php endif; ?>
    </div>

</div>
