<!DOCTYPE html>
<html lang="es-419">
<head>        
    <title>Agencias</title>

    <?php  $this->load->view('plantilla/top'); ?>

    <?php  $row = $query->row(); ?>


</head>
<body class="bg-img-num1"> 

    <div class="container">  
        <?php echo $menu; ?>

        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="#">Inicio</a></li>                    
                    <li><a href="#">Agencias</a></li>
                    <li class="active">Editar</li>
                </ol>
            </div>
        </div>        
        <div class="row">
            <div class="col-md-12">

                <div class="block">
                    <div class="header">
                        <h2>Editar Agencia</h2>                                                            
                    </div>
                    <div class="content controls">   
                        <form id="makedinputs" action="<?php echo site_url('') ?>agencias/actualizar">
                            <input type="hidden" name="idAgencias" value="<?php echo $row->idAgencias?>" >

                            <div class="col-md-6">
                                <div class="form-row">
                                    <div class="col-md-3 tar">Nombre:</div>
                                    <div class="col-md-9">
                                        <input type="text" value="<?php echo $row->nombre_agencia?>"  name="nombre_agencia" required="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3 tar">Email:</div>
                                    <div class="col-md-9">
                                        <input type="text"  value="<?php echo $row->descripcion?>" name="descripcion" required="">

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-3 tar">Estado:</div>
                                    <div class="col-md-9">
                                        <select name="estado" required="">
                                            <?php
                                            if($row->estado==1){

                                                ?>
                                                <option value="1" selected="">Activo</option>
                                                 <option value="0">Incativo</option>
                                                <?php


                                            }else{
                                               ?>
                                                <option value="1" >Activo</option>
                                               <option value="0" selected="">Incativo</option>
                                               <?php


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