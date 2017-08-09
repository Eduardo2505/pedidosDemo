<!DOCTYPE html>
<html lang="es-419">
<head>        
    <title>Entradas</title>

    <?php  $this->load->view('plantilla/top'); ?>


</head>
<body class="bg-img-num1"> 

    <div class="container">  
        <?php echo $menu; ?>

        <?php  $row = $query->row(); ?>

        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="#">Inicio</a></li>                    
                    <li><a href="#">Usuarios</a></li>
                    <li class="active">Editar</li>
                </ol>
            </div>
        </div>        
        <div class="row">
            <div class="col-md-12">

                <div class="block">
                    <div class="header">
                        <h2>Editar</h2>                                                            
                    </div>
                    <div class="content controls">   
                        <form id="makedinputs" action="<?php echo site_url('') ?>usuario/actualizar">
                        <input type="hidden" name="idusuario" value="<?php echo $row->idUsuario?>" >

                            <div class="col-md-6">
                                <div class="form-row">
                                    <div class="col-md-3 tar">Nombre:</div>
                                    <div class="col-md-9">
                                        <input type="text" value="<?php echo $row->nombre?>" name="nombre" required="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3 tar">Apellidos:</div>
                                    <div class="col-md-9">
                                        <input type="text"  value="<?php echo $row->primer_apellido?>"  name="apellido" required="">

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3 tar">Email:</div>
                                    <div class="col-md-9">
                                        <input type="email" value="<?php echo $row->email?>" name="email" required="">

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3 tar">Password:</div>
                                    <div class="col-md-9">
                                        <input type="password" value="<?php echo $row->contrasena?>"  name="contrasena" required="">

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3 tar">Agencia:</div>
                                    <div class="col-md-9">
                                        <select name="idagencia" required="">
                                            <option value="">Seleccione</option>
                                            <?php
                                            if (isset($agencias)) {
                                                foreach ($agencias->result() as $rowx) {


                                                    if($row->idAgencias==$rowx->idAgencias){
                                                        ?>

                                                        <option value="<?php echo $rowx->idAgencias; ?>" selected ><?php echo $rowx->nombre_agencia; ?></option>



                                                        <?php


                                                    }else{
                                                        ?>

                                                        <option value="<?php echo $rowx->idAgencias; ?>"><?php echo $rowx->nombre_agencia; ?></option>



                                                        <?php


                                                    }


                                                }
                                            }
                                            ?>  

                                        </select>

                                    </div>
                                </div>
                                <br>
                                <input type="submit" value="Editar">
                            </div>

                        </form>
                    </div>                                    
                </div>                

            </div>
        </div>



    </body>
    </html>