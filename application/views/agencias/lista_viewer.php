<!DOCTYPE html>
<html lang="es-419">
<head>        
    <title>Agencias</title>

    <?php  $this->load->view('plantilla/top'); ?>


</head>
<body class="bg-img-num1"> 

    <div class="container">  
        <?php echo $menu; ?>

        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="#">Inicio</a></li>                    
                    <li><a href="#">Agencias</a></li>
                    <li class="active">Consulta</li>
                </ol>
            </div>
        </div>        
        <div class="row">
            <div class="col-md-12">

                <div class="block">
                    <div class="header">
                        <h2>Busqueda Avanzada</h2>                                                            
                    </div>
                    <div class="content controls">   
                     <form  action="<?php echo site_url('') ?>agencias/mostrar">

                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="col-md-3 tar">Agencia:</div>
                                <div class="col-md-9">
                                    <input type="text" value="" name="nombre_agencia">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 tar">Email:</div>
                                <div class="col-md-9">
                                    <input type="text"  value="" name="descripcion">

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 tar"></div>
                                <div class="col-md-9">
                                    <input type="submit" class="btn btn-primary btn-clean" value="Buscar">

                                </div>
                            </div>       

                        </div>

                    </form>
                </div>                                    
            </div>                

        </div>
    </div>
    <div class="row">

        <div class="col-md-12">

            <div class="block">
                <div class="header">
                    <h2>Agencias</h2>
                </div>
                <div class="content">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Estado</th>


                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (isset($agencias)) {
                                foreach ($agencias->result() as $rowx) {
                                    ?>


                                    <tr>

                                        <td><?php echo $rowx->nombre_agencia; ?></td>

                                        <td><?php echo $rowx->descripcion; ?></td>
                                        <td><?php 
                                         if($rowx->estado==1){
                                            ?>
                                            Activo                                            <?php

                                        }else{
                                            ?>

                                            Inactivo

                                            <?php


                                        }

                                        ?></td>


                                        <td>

                                          <a  href="<?php echo site_url('') ?>agencias/buscar?idAgencias=<?php echo $rowx->idAgencias; ?>" class="btn btn-primary"> Editar</a> 
                                          <a href="<?php echo site_url('') ?>agencias/eliminar?idAgencias=<?php echo $rowx->idAgencias; ?>" class="btn btn-default"> Eliminar</a> 

                                      </td>
                                  </tr>



                                  <?php
                              }
                          }
                          ?>  





                      </tbody>
                  </table>  



                  <div class="dataTables_paginate paging_full_numbers" >
                    <?php echo $pagination; ?>

                </div>

            </div>
        </div>                

    </div>




</div>        
<div class="row">

    <div class="col-md-12">
        <div class="block">

            <div class="content" style="text-align: center">
                <a href="#" class="widget-icon widget-icon-large widget-icon-circle"><span class="icon-laptop"></span></a> EXCEL
            </div>
        </div>


    </div>

</div>

</div>



</body>
</html>