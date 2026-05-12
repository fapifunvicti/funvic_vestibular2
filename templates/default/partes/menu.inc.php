<?php
    \App\Core\DB::get();
    $menu_raiz = \App\Model\ArvoreMenuView::Raiz()->where('ativo', '=', 1)
            ->cursor();
?>

<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top" style="border-bottom: 5px solid red; justify-content: space-between;">
    <a class="navbar-brand" href="/">
        <img src="images/logo.png" alt="Vestibular FUNVIC" style="padding-top: 10px;">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar" style="flex-grow: 0;">
        <ul class="navbar-nav ml-auto">

            <?php foreach($menu_raiz as $menu): ?>

                <?php if(!$menu->dropdown): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo $menu->estilo; ?>" href="<?php echo $menu->url ?>">
                        <b><?php echo h($menu->nome); ?></b>
                    </a>
                </li>
                <?php else: ?>
                      <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="<?=  "dropDown-". $menu->idmenu; ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <b><?php echo h($menu->nome); ?></b>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="<?=  "dropDown-". $menu->idmenu; ?>">
                                    <?php $submenu_itens = \App\Model\ArvoreMenuView::filhosDe($menu->idmenu)->cursor(); ?>
                                     <?php foreach ($submenu_itens as $submenu): ?>
                                       
                                        <a class="dropdown-item" href="<?=  $submenu->url ?>"> <?=   h($submenu->nome) ?></a>
                                    <?php endforeach; ?>                              
                                  
                            </div>
                        </li>
             
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>

