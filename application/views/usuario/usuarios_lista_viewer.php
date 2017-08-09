<!DOCTYPE html>
<html lang="es-419">
<head>        
    <title>Entradas</title>

    <?php  $this->load->view('plantilla/top'); ?>


</head>
<body class="bg-img-num1"> 

    <div class="container">  
        <?php echo $menu; ?>

        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="#">Inicio</a></li>                    
                    <li><a href="#">Usuarios</a></li>
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
                     <form  action="<?php echo site_url('') ?>usuario/mostrar">

                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="col-md-3 tar">Nombre:</div>
                                <div class="col-md-9">
                                    <input type="text" value="" name="nombre">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 tar">Apellido:</div>
                                <div class="col-md-9">
                                    <input type="text"  value="" name="apellido">

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 tar">Email:</div>
                                <div class="col-md-9">
                                    <input type="text" name="email">

                                </div>
                            </div>                    

                        </div>
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="col-md-3">Agencia:</div>
                                <div class="col-md-9">
                                    <input type="text" name="agencia">

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <div class="input-group">

                                    </div>
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
                    <h2>Usuarios</h2>
                </div>
                <div class="content">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Agencia</th>                                       
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (isset($usuarios)) {
                                foreach ($usuarios->result() as $rowx) {
                                    ?>


                                    <tr>

                                        <td><?php echo $rowx->nombre; ?> <?php echo $rowx->primer_apellido; ?></td>

                                        <td><?php echo $rowx->email; ?></td>
                                        <td><?php echo $rowx->nombre_agencia; ?></td>

                                        <td>

                                          <a  href="<?php echo site_url('') ?>usuario/buscar?idusuario=<?php echo $rowx->idUsuario; ?>" class="btn btn-primary"> Editar</a> 
                                          <a href="<?php echo site_url('') ?>usuario/eliminar?idusuario=<?php echo $rowx->idUsuario; ?>" class="btn btn-default"> Eliminar</a> 

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

<script type="text/javascript">
    $(document).ready(function() {
        $('.optenerID').click(function() {
                    var user = $(this).attr("title"); // Aqui se optine el valor del idProducto 
                    var folio = $(this).attr("name"); 
                    var estado= $(this).attr("alt");
                    $('#estadoinput').val(estado);
                    if(estado=='ENVIADO'){
                      $('#botonbt').html('<a  class="btn btn-warning btn-clean" href="<?php echo site_url('') ?>pedidos/reimprimir?idTiket=' + user + '">ACEPTAR PEDIDO</a>');
                  }
                  $('#foliox').html('PEDIDO con el FOLIO ' + folio);
                  $('#boton').html('<a  class="btn btn-warning btn-clean" href="<?php echo site_url('') ?>pedidos/reimprimir?idTiket=' + user + '">REIMPRIMIR</a>');
                  var dataString = 'idtiket=' + user;

                  $.ajax({
                    type: "GET",
                    url: "<?php echo site_url('') ?>pedidos/verproductos",
                    data: dataString,
                    success: function(data) {

                        $('#resultadopro').html(data);

                        return false;
                    }

                });




              }


              );
    });


</script>
<div class="modal" id="modal_default_3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="foliox"> </h4>
            </div>

            <div class="modal-body clearfix" id="resultadopro">



            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Cancelar</button>
                <?php if ($acceso == 2) { ?>
                <span id="botonbt"></span>
                <?php } else { ?>
                <button type="button" class="btn btn-warning btn-clean">ENVIAR PEDIDO</button>
                <?php } ?>
                <span id="boton"><a  class="btn btn-warning btn-clean" href="">REIMPRIMIR</a></span>
            </div>
        </div>
    </div>
</div>    
</body>
</html>