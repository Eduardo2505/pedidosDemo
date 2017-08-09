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
                <li><a href="#">Agencias</a></li>
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
                 <form  action="<?php echo site_url('') ?>walmart/mostrar">

                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="col-md-3 tar">Determinante:</div>
                            <div class="col-md-9">
                                <input type="text" value="" name="determinante">
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
                <h2>Agencias</h2>
            </div>
            <div class="content">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Determinate</th>
                            <th>Referencia</th>
                            <th>Tienda</th>
                            <th>Localización</th>
                            <th>Tall CH (71-79 cm)</th>
                            <th>Tall M (80-87 cm)</th>
                            <th>Tall G (88-94 cm)</th>
                            <th>Tall EX (95-101 cm)</th>
                            <th>Tall EXX (102-109 cm)</th>
                            <th>TOTAL</th>
                            <th>IMPRIMIR</th>


                            
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (isset($agencias)) {
                            foreach ($agencias->result() as $rowx) {
                                ?>


                                <tr>

                                    <td><?php echo $rowx->determinante; ?></td>

                                    <td><?php echo $rowx->referencia; ?></td>
                                    <td><?php echo $rowx->tienda; ?></td>
                                    <td><?php echo $rowx->localizacion; ?></td>
                                    <td><?php echo $rowx->tallaCH; ?></td>
                                    <td><?php echo $rowx->tallaM; ?></td>
                                    <td><?php echo $rowx->tallaG; ?></td>
                                    <td><?php echo $rowx->tallaEX; ?></td>
                                    <td><?php echo $rowx->tallaEXX; ?></td>
                                    <td><?php echo $rowx->total; ?></td>

                                    <td>

                                      <a  href="<?php echo site_url('') ?>walmart/imprimir?idpedidos=<?php echo $rowx->idpedidos; ?>" class="btn btn-primary"> IMPRIMIR</a> 


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