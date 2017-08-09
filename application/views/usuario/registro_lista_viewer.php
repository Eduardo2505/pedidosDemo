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
                        <li class="active">Registro</li>
                    </ol>
                </div>
            </div>        
            <div class="row">
                <div class="col-md-12">

                    <div class="block">
                        <div class="header">
                            <h2>Registro</h2>                                                            
                        </div>
                        <div class="content controls">   
                            <form id="makedinputs" action="<?php echo site_url('') ?>usuario/registro">

                                <div class="col-md-6">
                                    <div class="form-row">
                                        <div class="col-md-3 tar">Nombre:</div>
                                        <div class="col-md-9">
                                            <input type="text" value="" name="nombre" required="">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 tar">Apellidos:</div>
                                        <div class="col-md-9">
                                            <input type="text"  value="" name="apellido" required="">

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 tar">Email:</div>
                                        <div class="col-md-9">
                                            <input type="email" name="email" required="">

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 tar">Password:</div>
                                        <div class="col-md-9">
                                            <input type="password" name="contrasena" required="">

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
                                                        ?>

                                                        <option value="<?php echo $rowx->idAgencias; ?>"><?php echo $rowx->nombre_agencia; ?></option>



                                                        <?php
                                                    }
                                                }
                                                ?>  

                                            </select>

                                        </div>
                                    </div>
                                    <br>
 <input type="submit" value="Guardar">
                                </div>
                               
                            </form>
                        </div>                                    
                    </div>                

                </div>
            </div>



    </body>
</html>