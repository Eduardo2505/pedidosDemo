<div class="row">                   
    <div class="col-md-12">

        <nav class="navbar brb" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-reorder"></span>                            
                </button>                                                
                <a class="navbar-brand" href="<?php echo site_url('') ?>"><img src="<?php echo site_url('') ?>img/logo.png"/></a>                                                                                     
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">                                     
                <ul class="nav navbar-nav">
                    <?php if ($acceso == 2 ||$acceso == 3 ) { ?>
                    <li class="dropdown active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-pencil"></span> Pedidos</a>
                        <ul class="dropdown-menu">                                    
                            <li><a href="<?php echo site_url('') ?>pedidos/iniciar">Nuevo Pedido</a></li>
                            <li><a href="<?php echo site_url('') ?>pedidos/mostrar">Consultar</a></li>
                            <?php if ($acceso == 3) { ?>

                            <li><a href="<?php echo site_url('') ?>pedidosadmin">Administrador</a></li>

                            <?php } ?>

                        </ul>                                
                    </li>
                    <?php } ?>
                    

                    <?php if ($acceso ==1) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-tags"></span> Entradas</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('') ?>entradas/iniciar">Nueva Entrada</a></li>
                            <li><a href="<?php echo site_url('') ?>entradas/mostrar">Consultar</a></li>
                        </ul>
                    </li> 
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-truck"></span> Pedidos</a>
                        <ul class="dropdown-menu">

                            <li><a href="<?php echo site_url('') ?>pedidosadmin">Consultar</a></li>
                        </ul>
                    </li> 
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-user"></span> Usuarios</a>
                        <ul class="dropdown-menu">
                           <li><a href="<?php echo site_url('') ?>usuario/mostrar">Mostrar</a></li>

                           <li><a href="<?php echo site_url('') ?>usuario">Registro</a></li>
                       </ul>
                   </li>
                   <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-group"></span> Agencias</a>
                    <ul class="dropdown-menu">
                       <li><a href="<?php echo site_url('') ?>agencias/mostrar">Mostrar</a></li>

                       <li><a href="<?php echo site_url('') ?>agencias">Registro</a></li>
                   </ul>
               </li>
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-archive"></span> Productos</a>
                <ul class="dropdown-menu">
                   <li><a href="<?php echo site_url('') ?>productos/mostrar">Mostrar</a></li>

                   <li><a href="<?php echo site_url('') ?>productos/captura">Registro</a></li>
               </ul>
           </li>
           <!-- Menu dos -->
           <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-cogs"></span> Herramientas</a>
               <ul class="dropdown-menu">
                   <li><a href="<?php echo site_url('') ?>walmart/mostrar">Etiquetas</a></li>

                   <li><a href="<?php echo site_url('') ?>barcode"> <i class="icon-barcode"></i> Codigo de Barra</a></li>

                   <li><a href="<?php echo site_url('') ?>etiquetas/mostrar">Etiquetas Fijas</a></li>
               </ul>
           </li>

           <?php } ?>

           <li><a href="<?php echo site_url('') ?>inventario"><span class="icon-shopping-cart"></span> Inventario</a></li>
           <?php if ($acceso != 1) { ?>
           <li><a href="<?php echo site_url('') ?>inventarioagencia"><span class="icon-globe"></span> Inventario Sucursal</a></li>
           <?php } ?>
       </ul>
       <div class="navbar-form navbar-right" role="search">
        <div class="form-group">
            <a href="<?php echo site_url('') ?>salir/close">
                <span class="icon-home"></span> SALIR
            </a>
        </div> 
        <div class="form-group"></div>
    </div> 
</div>
</nav>               

</div>            
</div>