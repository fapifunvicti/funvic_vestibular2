<div class="topo">

    <div class="topo-header">

        <span>Setor: <?= $titulo ?? "Sem titulo"; ?></span> 


    </div>
    <div class="area-login">
        
        <?php if(!isset($_SESSION['admin'])): ?>
        
            <span>
                <a href="/login">Login</a>
            </span>
        <?php else: ?>
            <span class="badge text-bg-secondary"><a href="/" target="_blank" rel="noopener noreferrer">Ver Site</a> </span>
            <span class="login-usuario">
                  <?=  h($_SESSION['admin']['email'] ?? "E-Mail");  ?>
            </span>
            <span>
                <a href="/admin/logoff">Deslogar</a>
            </span>
        <?php endif; ?>
    </div>
</div>