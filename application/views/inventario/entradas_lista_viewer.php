<!DOCTYPE html>
<html lang="es-419">
    <head>        
        <title>Pedidos</title>

        <?php  $this->load->view('plantilla/top'); ?>


    </head>
    <body class="bg-img-num1"> 

        <div class="container">  
            <?php echo $menu; ?>

            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Inicio</a></li>                    
                        <li><a href="#">Pedidos</a></li>
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
                            <form id="makedinputs" action="<?php echo site_url('') ?>pedidosadmin/buscar">

                                <div class="col-md-6">
                                    <div class="form-row">
                                        <div class="col-md-3 tar">Sucursal:</div>
                                        <div class="col-md-9">
                                            <input type="text" value="" name="sucursal">
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="col-md-3 tar">Descripción:</div>
                                        <div class="col-md-9">
                                            <input type="text"  value="" name="descrip">

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 tar">Folio:</div>
                                        <div class="col-md-9">
                                            <input type="text" name="folio">

                                        </div>
                                    </div>                    

                                </div>
                                <div class="col-md-6">
                                    <div class="form-row">
                                        <div class="col-md-3">Inicial:</div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
                                                <input type="text" class="datepicker form-control" name="fechi" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3">Final:</div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
                                                <input type="text" class="datepicker form-control" name="fechf" />
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
                            <h2>pedidos</h2>
                        </div>
                        <div class="content">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>FOLIO</th>
                                        <th>Descripción</th>
                                        <th>Registro</th>
                                        <th>Impresiòn</th>
                                        <th>Usuario</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (isset($tiketEntradas)) {
                                        foreach ($tiketEntradas->result() as $rowx) {
                                            ?>


                                            <tr>
                                                <td><?php echo str_pad($rowx->folio, 5, "0", STR_PAD_LEFT); ?></td>
                                                <td><?php echo $rowx->descripcion; ?></td>
                                                <td><?php echo $rowx->registro_inicial; ?></td>
                                                <td><?php echo $rowx->registro_update; ?></td>
                                                <td><?php echo $rowx->usuario . ' ' . $rowx->primer_apellido; ?></td>
                                                <td><?php echo strtoupper($rowx->estado); ?></td>
                                                <td>


                                                    <a href="#modal_default_3" data-toggle="modal" class="optenerID" alt="<?php echo strtoupper($rowx->estado); ?>" title="<?php echo $rowx->idTiket; ?>" name="<?php echo str_pad($rowx->folio, 5, "0", STR_PAD_LEFT); ?>"><span class="icon-eye-open"></span> Ver</a> 
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