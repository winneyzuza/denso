<div id='cssmenu'>
<ul>
   <!-- ADD class has-sub when adding more uls -->
   <?php if (!isset($controller)) {
      $controller = "";
   } ?>
   <li <?php echo $controller==="home"?'class="active"':''; ?>><a href='<?php echo base_url(); ?>'><span><?php echo lang('menu_home'); ?></span></a></li>
   <li <?php echo $controller==="create"?'class="active"':''; ?>><a href='<?php echo base_url(); ?>index.php/create'><span><?php echo lang('menu_create'); ?></span></a></li>
   <li><a href='#'><span>About</span></a></li>
   <li class='last'><a href='#'><span>Contact</span></a></li>
</ul>
</div>