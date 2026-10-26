<?php
    /***
     * @var mixed $menu
     */
?>


<?php if(!$menu->dropdown): ?>           
<li class="nav-item">
    <a data-ordem="<?= h($menu->ordem) ?>" class="nav-link <?php echo $menu->estilo; ?>" href="<?php echo $menu->url ?>">
        <b><?php echo h($menu->nome); ?></b>
    </a>
</li>
<?php else: ?>
                      <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="<?=  "dropDown-". $menu->idmenu; ?>"  data-bs-toggle="dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <b><?php echo h($menu->nome); ?></b>
                            </a>
                            <div class="dropdown-menu">

                                    <?php 
                                        $submenu_itens = new \App\Model\MenuItem();
                                        $submenu_itens = $submenu_itens->where('pai_id','=', $menu->idmenu)
                                                         ->where('ativo', '=', 1)
                                                         ->cursor(); 
                                    ?>
                                     <?php foreach ($submenu_itens as $submenu): ?>
                                        <a class="dropdown-item" href="<?=  $submenu->url ?>"> <?=   h($submenu->nome) ?></a>
                                    <?php endforeach; ?>                    
                                  
                            </div>
                        </li>
<?php endif; ?>