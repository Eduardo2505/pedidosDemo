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
                    <li class="active">Captura</li>
                </ol>
            </div>
        </div>        

        <?php if (strcmp($tiempopedido, "termino") == 0) { ?>

        <div class="row">


            <div class="col-md-12">

                <div class="block block-drop-shadow">
                    <div class="header">
                        <h2>Estado del pedido: <span class="text-warning"> No inicalizado</span></h2>
                        <div class="pull-right">
                            <ul class="buttons">
                                <li><a href="#"><span class="icon-pencil"></span></a></li>
                            </ul>
                        </div>                        
                    </div>
                    <div class="content">    
                        <div style="text-align: center">
                            Debe de inicial el pedido, este tiene un tiene un límite de <?php echo $limi ?> min para realizar el pedido, después de ese tiempo se liberar el pedido y volverá a comenzar.
                            <br><br>  
                            <a class="btn btn-success" href="<?php echo site_url('') ?>pedidos/set">Comenzar</a>

                        </div>
                    </div>
                </div>                                               
                <div class="col-md-5">



                </div>
            </div>

        </div>

        <?php } else { ?>

        <div class="row">

            <div class="col-md-6">                  

                <div class="col-md-12">
                    <form action="<?php echo site_url('') ?>pedidos/iniciar">

                    <div class="block">

                        <div class="content controls">    

                            <div class="form-row">


                                <div class="col-md-6">

                                   <input type="text" class="form-control" name="producto" placeholder="Buscar..">  

                               </div>
                               <div class="col-md-3">
                                <input type="submit" value="BUSCAR" class="btn btn-success">
                            </div>
                        </div>


                    </div>

                </div>
            </form>

                </div>

                <div class="block block-transparent block-drop-shadow">
                    <div class="head bg-dot20 npb">
                        <h2>Productos</h2>
                        <div class="pull-right">
                            <ul class="buttons">
                                <li><a href="#">Existencias</a></li>
                            </ul>
                        </div>
                    </div>                    
                    <div class="content np">
                        


                        <div class="list list-contacts" id="productosmostrar">
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('.optenerID').click(function() {
                                                var user = $(this).attr("title"); // Aqui se optine el valor del idProducto 

                                                var dataString = 'idProducto=' + user;
                                                // alert(dataString);
                                                $.ajax({
                                                    type: "GET",
                                                    url: "<?php echo site_url('') ?>pedidos/agregar",
                                                    data: dataString,
                                                    success: function(data) {
                                                        // alert(data);
                                                        $('#resultado').html(data);

                                                        return false;
                                                    }

                                                });




                                            }


                                            );
                                });


                            </script>



                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Producto</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (isset($productos)) {
                                        foreach ($productos->result() as $row) {
                                            ?>
                                           <?php $summm = $row->suma; ?>

                                            <tr>
                                                <td>
                                                 <a href="#" class="list-item optenerID" title="<?php echo $row->idProductos; ?>"  >
                                    <div class="list-info">
                                        <img src="<?php echo $this->config->item('url_clusters') ?><?php echo $row->url; ?>" class="img-circle img-thumbnail" height="40px" width="40px" >
                                    </div>
                                    <div class="list-text">
                                        <span class="list-text-name"><?php echo $row->nombre; ?></span>                                    
                                        <div class="list-text-info">
                                            <i class="icon-user-md"></i>  TALLA: <?php echo $row->talla; ?>    <i class="icon-check"></i> <?= $summm ?> PZ

                                        </div>
                                    </div>

                                    <?php if ($summm == 0) { ?>
                                    <div class="list-status list-status-offline"></div> 
                                    <?php } ?>

                                    <?php if ($summm <= 5 && $summm != 0) { ?>
                                    <div class="list-status list-status-away"></div>
                                    <?php } ?>

                                    <?php if ($summm > 5) { ?>
                                    <div class="list-status list-status-online"></div>
                                    <?php } ?>




                                </a>

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

        <!-- tabla -->
        <div class="col-md-6">
            <form action="<?php echo site_url('') ?>pedidos/imprimir" method="POST">

                <div class="block">
                    <div class="header">
                        <h2>PEDIDO</h2>

                    </div>
                    <div class="content controls">    

                        <div class="form-row">


                            <div class="col-md-6">

                                <input type="text" class="form-control" name="descripcion" maxlength="480" placeholder="Descripción" required="" />

                            </div>
                            <div class="col-md-3">
                                <input type="submit" value="PEDIR" class="btn btn-success">
                            </div>
                        </div>


                    </div>

                </div>
            </form>
            <div class="block">
                <div class="header">
                    <h2>Productos</h2>
                </div>


                <div class="content" id="resultado">
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('.eliminar').click(function() {
                                var user = $(this).attr("title");
                                            var name = $(this).attr("name");// Aqui se optine el valor del idProducto 
                                            var dir = $(this).attr("dir");

                                            $('#eliminarinput').val(user);
                                            $('#productoeili').val(name);
                                            $('#catidadelimi').val(dir);
                                        });
                        });
                        $(document).ready(function() {
                            $('.editar').click(function() {
                                            var user = $(this).attr("title"); // Aqui se optine el valor del idProducto 
                                            var name = $(this).attr("name");// Aqui se optine el valor del idProducto 
                                            $('#productoeiliedu').val(name);
                                            $('#inputeditar').val(user);
                                        });
                        });

                        $(document).ready(function() {
                            $('.mas').click(function() {
                                var user = $(this).attr("title");
                                            var name = $(this).attr("name");// Aqui se optine el valor del idProducto 
                                            var dataString = 'inputeditar=' + user + '&idproducto=' + name;
                                            $.ajax({
                                                type: "GET",
                                                url: "<?php echo site_url('') ?>pedidos/mas",
                                                data: dataString,
                                                success: function(data) {
                                                    //  alert(data);
                                                    if (data == 'no_hay_existencias') {
                                                        $('#tasum').html("<h1>YA NO HAY EXISTENCIAS</h1>");

                                                    } else {
                                                        $('#tasum').html("");
                                                        $('#' + user).html(data);
                                                    }

                                                    return false;
                                                }

                                            });




                                        }


                                        );
                        });
                        $(document).ready(function() {
                            $('.menos').click(function() {
                                var user = $(this).attr("title");
                                            var name = $(this).attr("name");// Aqui se optine el valor del idProducto 

                                            var dataString = 'inputeditar=' + user + '&idproducto=' + name;
                                            //alert(dataString);


                                            $.ajax({
                                                type: "GET",
                                                url: "<?php echo site_url('') ?>pedidos/menos",
                                                data: dataString,
                                                success: function(data) {
                                                    $('#tasum').html("");

                                                    if (data == 'error') {

                                                        $('#tr' + user).remove();
                                                    } else {
                                                        $('#' + user).html(data);
                                                    }

                                                    return false;
                                                }

                                            });




                                        }


                                        );
                        });
                    </script>
                    <div style="text-align:center" id="tasum"></div>
                    <table class="table table-hover" >
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Producto</th>
                                <th>Talla</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody >





                            <?php
                            if (isset($entradas)) {
                                foreach ($entradas->result() as $rowx) {
                                    ?>
                                    <tr id="tr<?php echo $rowx->idSalida; ?>">
                                        <td ><span id="<?php echo $rowx->idSalida; ?>" ><?php echo $rowx->cantidad; ?></span></td>
                                        <td><?php echo $rowx->nombre; ?></td>
                                        <td><?php echo $rowx->talla; ?></td>
                                        <td>

                                            <button type="button"  title="<?php echo $rowx->idSalida; ?>"  name="<?php echo $rowx->idProductos; ?>"  class="btn btn-primary mas">+</button>
                                            <button type="button"   title="<?php echo $rowx->idSalida; ?>" name="<?php echo $rowx->idProductos; ?>"  class="btn btn-success menos">-</button>
                                            <a href="#modal_default_6" data-toggle="modal" dir="<?php echo $rowx->cantidad; ?>" name="<?php echo $rowx->idProductos; ?>" title="<?php echo $rowx->idSalida; ?>" class="widget-icon widget-icon-small eliminar"><span class="icon-trash"></span></a>
                                            <a href="#modal_default_3" data-toggle="modal" name="<?php echo $rowx->idProductos; ?>" title="<?php echo $rowx->idSalida; ?>" class="widget-icon widget-icon-small editar"><span class="icon-pencil"></span></a>


                                        </td>
                                    </tr>



                                    <?php
                                }
                            }
                            ?>








                        </tbody>
                    </table>   


                </div>


            </div>                 

        </div>


    </div>        

    <?php } ?>
</div>

<!--este son los modal para editar-->

<div class="modal" id="modal_default_3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cantidad</h4>
            </div>

            <div class="modal-footer" style="text-align: center">   
                <script type="text/javascript">

                    $(function() {
                        $('#formeditar').submit(function() {
                            var data = $(this).serialize();
                            var user = $('#inputeditar').val();
                            $.get('<?php echo site_url('') ?>pedidos/editar', data, function(respuesta) {

                                $('#formeditar')[0].reset();

                                $('.close').click();
                                $('#' + user).html(respuesta);



                            });
                            return false;
                        });
                    });

                </script>
                <form  id="formeditar">
                    <input type="hidden" id="inputeditar" name="inputeditar" required="">
                   

                    <div class="form-row">
                        <div class="col-md-6">

                            <input type="text" pattern="[0-9]{1,5}" class="form-control" name="cantidad" required="" placeholder="Cantidad"/>

                        </div>

                        <div class="col-md-3">
                            <input type="submit" value="GUARDAR" class="btn btn-warning btn-clean">
                        </div>
                    </div>
                    <div class="form-row" id="mostrarResux">

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


<!--De confirmacion-->
<script type="text/javascript">

    $(function() {
        $('#eliminar').submit(function() {
            var data = $(this).serialize();

            $.get('<?php echo site_url('') ?>pedidos/eliminar', data, function(respuesta) {

                $('.close').click();
                $('#tr' + respuesta).remove();


            });
            return false;
        });
    });

</script>

<div class="modal" id="modal_default_6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form  id="eliminar">
            <input type="hidden" id="eliminarinput" name="identrada" required="">
            <input type="hidden" id="productoeili" name="idproducto" required="">
            <input type="hidden" id="catidadelimi" name="cantidad" required="">
            <div class="modal-content">                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">¿Estas seguro que quieres eliminarlo ?</h4>
                </div>                
                <div class="modal-footer">
                    <div class="col-md-3">
                        <input type="submit" value="Sí" class="btn btn-success btn-clean" >
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-danger btn-clean" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>  


</body>
</html>