<!DOCTYPE html>
<html lang="es-419">
<head>        
    <title>Producto</title>

    <?php  $this->load->view('plantilla/top'); ?>


</head>
<body class="bg-img-num1"> 

    <div class="container">  
        <?php echo $menu; ?>

        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="#">Inicio</a></li>                    
                    <li><a href="#">Producto</a></li>
                    <li class="active">Registro</li>
                </ol>
            </div>
        </div>        
        <div class="row">
            <div class="col-md-12">

                <div class="block">
                    <div class="header">
                        <h2>Producto</h2>                                                            
                    </div>
                    <div class="content controls">  

                       <?php 


                       echo form_open_multipart('productos/registrarProducto');  ?>


                       <div class="col-md-1">
                       </div>

                       <div class="col-md-8">



                           <div class="form-row">
                            <div class="col-md-3 tar">Nombre:</div>
                            <div class="col-md-9">
                                <input type="text" value="" name="nombre" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 tar">Talla:</div>
                            <div class="col-md-9">
                                <input type="text"  value="" name="talla" required="">

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 tar">Categoria:</div>
                            <div class="col-md-9">
                                <select name="idCategorias" required="">
                                    <option value="">Selecione</option>
                                    <?php
                                    if (isset($categorias)) {
                                        foreach ($categorias->result() as $rowx) {
                                            ?>


                                            <option value="<?php echo $rowx->idCategorias; ?>"><?php echo $rowx->Nombre; ?></option>


                                            <?php
                                        }
                                    }
                                    ?>  
                                </select>
                            </div>
                        </div>
                       
                        <div class="form-row">
                            <div class="col-md-3 tar">Estado:</div>
                            <div class="col-md-9">
                                <select name="estado" required="">

                                    <option value="1">Activo</option>
                                    <option value="0">Incativo</option>


                                </select>

                            </div>
                        </div>




                        <div class="form-row">
                          <div class="col-md-4 tar">Imagen: *</div>
                          <div class="col-md-4">
                            <?php echo form_upload('userfile') ?>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-4 tar"></div>
                        <div class="col-md-4">
                            <?php echo form_submit('submit', 'Actulizar',array('class' => 'btn btn-primary btn-clean')) ?>

                        </div>
                        <br>
                        <br>
                        <div style="text-align: center;">




                            <?php 
                            if($msn==1){
                                echo '<div class="panel panel-danger">
                                <div class="panel-heading">
                                <H2>ERROR FORMATO NO VALIDO SOLO IMAGEN</H2>
                                </div>
                                
                            </div>';
                        }
                       

                ?>
            </div>
        </div>  

    </div>
    <div class="col-md-2">
    </div>

    <?php form_close() ?>

</div>                                    
</div>                

</div>
</div>



</body>
</html>