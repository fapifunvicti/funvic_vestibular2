<div class="topo">
    <div class="topo-header">
          
        Setor: <?= $titulo ?? "Sem titulo"; ?>

    </div>
    <div class="area-login">
        
        <?php if(isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado']): ?>
        
            <span>
                <a href="/login">Login</a>
            </span>
        <?php else: ?>
            <span class="login-usuario">
                  <?=  h($email ?? "E-Mail");  ?>
            </span>
            <span>
                <a href="/admin/logoff">Deslogar</a>
            </span>
        <?php endif; ?>
    </div>
</div>