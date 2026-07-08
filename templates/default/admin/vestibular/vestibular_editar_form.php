

<div class="main-content" id="mainContent">
    <form action="/admin/vestibular" method="post" enctype="application/x-www-form-urlencoded" accept-charset="utf-8">
        <input type="hidden" name="form" value="adicionar">
        <div class="mb-3">
            <label class="form-label" for="nome">Nome:</label>
            <input placeholder="Digite nome do processo seletivo" class="form-control" required type="text" value="" pattern="[\p{L}\p{N}\- ]+" id="nome" name="nome">
        </div>

        <div class="mb-3">
            <button class="btn btn-success btn-large">Criar Vestibular</button>
        </div>

    </form>
</div>