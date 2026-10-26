<?php
use App\Core\Template as Tpl;
require (__DIR__ . DIRECTORY_SEPARATOR . '../../../../config.php');

\App\Core\DB::get();
    $menu_raiz = \App\Model\MenuItem::where('ativo', '=', 1)
            ->whereNull('pai_id' )
            ->orderBy('ordem', 'asc')
            ->cursor();
    


    $tpl = new Tpl(request(), $config);
?>

<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top" style="border-bottom: 5px solid red; justify-content: space-between;">
    <a class="navbar-brand" href="/">
        <img src="/images/logo.png" alt="Vestibular FUNVIC" style="padding-top: 10px;">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar" style="flex-grow: 0;">
        <ul class="navbar-nav ml-auto">

            <?php
                foreach($menu_raiz as $menu):
                   echo $tpl->renderTemplateFile('partes/menu/_item.inc.php', ['menu' => $menu]); 
                endforeach; 
            ?>
        </ul>
    </div>
</nav>

