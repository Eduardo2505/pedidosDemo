<!DOCTYPE html>
<html lang="es-419">
<head>        
    <title>Etiquetas</title>

    <?php  $this->load->view('plantilla/top'); ?>


</head>
<body class="bg-img-num1"> 

    <div class="container">  

      <?php echo $menu; ?>
      <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Herramientas</a></li>
                <li class="active">Etiquetas Fijas</li>
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
                 <form  action="<?php echo site_url('') ?>etiquetas/mostrar">

                  <div class="col-md-12">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="col-md-3 tar">Código:</div>
                            <div class="col-md-9">
                                <input type="text" value="" name="codigo">
                            </div>
                        </div>
                        <div class="col-md-4">
                          <div class="col-md-3 tar">Formato:</div>
                          <div class="col-md-9">
                            <input type="text" value="" name="formato">
                        </div>
                    </div>

                    <div class="col-md-3">
                      
                        <div class="col-md-9">
                            <input type="submit" class="btn btn-primary btn-clean" value="Buscar">

                        </div>
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
                <h2>Etiquetas</h2>
            </div>
            <div class="content">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Formato</th>
                            <th>Tipo</th>
                            <th>IMPRIMIR</th>


                            
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (isset($codigos)) {
                            foreach ($codigos->result() as $rowx) {
                                ?>


                                <tr>

                                    <td><?php echo $rowx->codigo; ?></td>

                                    <td><?php echo $rowx->formato; ?></td>
                                    <td><?php echo $rowx->tipo; ?></td>
                                    

                                    <td>

                                      <a  href="<?php echo site_url('') ?>etiquetas/imprimir?idEtiqueta=<?php echo $rowx->idEtiqueta; ?>" class="btn btn-primary"> IMPRIMIR</a> 


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
              HelpmMEx.com.mx
          </div>
      </div>


  </div>

</div>

</div>



</body>
</html>