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
                <li><a href="#">Codigo de Barra</a></li>
                <li class="active">Captura</li>
            </ol>
        </div>
    </div>        
    <div class="row">
        <br><br><br>
        <div class="col-md-2"></div>
        <div class="col-md-8">

            <div class="block">
                <div class="header">
                    <h2>Captura</h2>                                                            
                </div>
                <div class="content controls">   
                   <form  action="<?php echo site_url('') ?>barcode/imprimir" method="POST">

                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="col-md-3 tar">Cedis:</div>
                            <div class="col-md-9">
                                <input type="text" value="" name="cedis" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 tar">OC:</div>
                            <div class="col-md-9">
                                <input type="text" value="" name="oc" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 tar">UPC:</div>
                            <div class="col-md-9">
                                <input type="text" value="" name="upc1" required="">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-3 tar">UPC:</div>
                            <div class="col-md-9">
                                <input type="text" value="" name="upc2" required="">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-3 tar">No. Caja:</div>
                            <div class="col-md-9">
                                <input type="text" value="" name="numcaja" required="">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-3 tar"></div>
                            <div class="col-md-9">
                                <input type="submit" class="btn btn-primary btn-clean" value="Generar">

                            </div>
                        </div>       

                    </div>
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="col-md-3 tar">*</div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-3 tar">*</div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-3 tar">Piezas:</div>
                            <div class="col-md-9">
                                <input type="text" value="" name="pzaupc1" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 tar">Piezas:</div>
                            <div class="col-md-9">
                                <input type="text" value="" name="pzaupc2" required="">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-3 tar">Cajas Totales:</div>
                            <div class="col-md-9">
                                <input type="text" value="" name="cajaTotal" required="">
                            </div>
                        </div>
                    </div>

                </form>
            </div>                                    
        </div>                

    </div>
</div>



</div>



</body>
</html>