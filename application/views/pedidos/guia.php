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
                    <li><a href="<?php echo site_url('') ?>pedidosadmin">Pedidos</a></li>  
                    <li class="active">Captura</li>
                </ol>
            </div>
        </div>        

        
        

        <div class="row">



            <div class="col-md-12">


             <div class="block">
                <div class="header">
                    <h2>Cargar archivos</h2>                                                            
                </div>
                <div class="content controls">   
                    <?php 


                    echo form_open_multipart('pedidosadmin/subirNota');  ?>


                    <input type="hidden" name="idTiket" value="<?php echo $idTiket?>">
                    <input type="hidden" name="folio" value="<?php echo $folio?>">

                    <div class="col-md-12">
                        <div class="form-row">
                          <div class="col-md-4 tar">Archivo PDF: *</div>
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
                                    <H2>ERROR FORMATO NO VALIDO SOLO PDF</H2>
                                </div>
                                
                            </div>';
                            }
                            if($msn==2){
                           
                                 echo '<div class="panel panel-warning">
                                <div class="panel-heading">
                                    <H2>NO SE CARGO NINGUN ARCHIVO</H2>
                                </div>
                                
                            </div>';
                            }
                            if($msn==0){
                                echo "<H2>SE CARGO CORRECTAMENTE</H2>";
                            }

                            ?>
                        </div>
                    </div>  

                </div>














                <?php form_close() ?>




            </div>                                    
        </div> 








    </div>






</div>

<!--este son los modal para editar-->






</body>
</html>