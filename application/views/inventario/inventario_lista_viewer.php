<!DOCTYPE html>
<html lang="es-419">
    <head>        
        <title>Existencias</title>

       <?php  $this->load->view('plantilla/top'); ?>


    </head>
    <body class="bg-img-num1"> 

        <div class="container">  
            <?php echo $menu; ?>

            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Inicio</a></li>                    
                        <li><a href="#">Inventario</a></li>
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
                            <form id="makedinputs" action="<?php echo site_url('') ?>inventario/buscar">

                                <div class="col-md-6">
                                    <div class="form-row">
                                        <div class="col-md-3 tar">Producto:</div>
                                        <div class="col-md-9">
                                            <input type="text" value="" name="producto">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 tar">Talla:</div>
                                        <div class="col-md-9">
                                            <input type="text"  value="" name="talla">

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 tar">Categoria:</div>
                                        <div class="col-md-9">
                                            <input type="text" name="cate">

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
                            <h2>Existencias</h2>
                        </div>
                        <div class="content">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Talla</th>
                                        <th>Categoria</th>
                                        <th>Entradas</th>
                                        <th>Salidas</th>
                                        <th>Existencias</th>
                                        <th>Registro</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (isset($tiketEntradas)) {
                                        foreach ($tiketEntradas->result() as $rowx) {
                                            ?>


                                            <tr>
                                                <td><?php echo $rowx->nombre; ?></td>
                                                <td><?php echo $rowx->talla; ?></td>
                                                <td><?php echo $rowx->Nombre; ?></td>
                                                <td><?php echo $rowx->cantidad_entradas; ?></td>
                                                <td><?php echo $rowx->cantidada_salidas; ?></td>
                                                <td><?php echo $rowx->existencia; ?></td>
                                                <td><?php echo $rowx->registro; ?></td>

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
                    var estado = $(this).attr("alt");
                    $('#estadoinput').val(estado);
                    if (estado == 'ENVIADO') {
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