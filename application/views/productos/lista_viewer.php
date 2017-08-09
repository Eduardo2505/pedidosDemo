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
                    <li><a href="#">Productos</a></li>
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
                       <form  action="<?php echo site_url('') ?>productos/mostrar">

                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="col-md-3 tar">Nombre:</div>
                                <div class="col-md-9">
                                    <input type="text" value="" name="producto">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 tar">Talla:</div>
                                <div class="col-md-9">
                                    <input type="text" value="" name="talla">
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-3 tar"></div>
                                <div class="col-md-9">
                                    <input type="submit" class="btn btn-primary btn-clean" value="Buscar">

                                </div>
                            </div>       

                        </div>
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="col-md-3 tar">Categoría:</div>
                                <div class="col-md-9">
                                    <input type="text" value="" name="categoria">
                                </div>
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
                           <th></th>
                           <th>Nombre</th>
                           <th>Talla</th>
                           <th>Categoría</th>


                           <th>Acciones</th>
                       </tr>
                   </thead>
                   <tbody>

                    <?php
                    if (isset($productos)) {
                        foreach ($productos->result() as $rowx) {
                            ?>


                            <tr>
                                <td>
                                    <div class="list-info" style="text-align: center;">
                                        <img src="<?php echo $this->config->item('url_clusters'); ?><?php echo $rowx->url; ?>" class="img-circle img-thumbnail" height="40px" width="40px">
                                    </div>
                                </td>

                                <td><?php echo $rowx->nombre; ?></td>

                                <td><?php echo $rowx->talla; ?></td>
                                <td><?php echo $rowx->categoaria; ?></td>


                                <td>

                                  <a  href="<?php echo site_url('') ?>productos/buscar?idProductos=<?php echo $rowx->idProductos; ?>" class="btn btn-primary"> Editar</a> 
                                  <a href="<?php echo site_url('') ?>productos/eliminar?idProductos=<?php echo $rowx->idProductos; ?>" class="btn btn-default"> Eliminar</a> 

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