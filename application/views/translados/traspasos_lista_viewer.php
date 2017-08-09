<!DOCTYPE html>
<html lang="es-419">
    <head>        
        <title>Traspasos</title>

       <?php  $this->load->view('plantilla/top'); ?>

    </head>
    <body class="bg-img-num1"> 

        <div class="container">        
            <?php include 'menu.php'; ?>

            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Inicio</a></li>                    
                        <li><a href="#">Traspasos</a></li>
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
                            <form id="makedinputs" action="#" method="post">

                                <div class="col-md-6">
                                    <div class="form-row">
                                        <div class="col-md-3 tar">Producto:</div>
                                        <div class="col-md-9">
                                            <input type="text" value="">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 tar">Descripción:</div>
                                        <div class="col-md-9">
                                            <input type="text"  value="">

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 tar">Folio:</div>
                                        <div class="col-md-9">
                                            <input type="text">

                                        </div>
                                    </div>                    

                                </div>
                                <div class="col-md-6">
                                   <div class="form-row">
                                        <div class="col-md-3">Inicial:</div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
                                                <input type="text" class="datepicker form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3">Final:</div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="icon-calendar-empty"></span></div>
                                                <input type="text" class="datepicker form-control" />
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
                            <h2>Traspasos</h2>
                        </div>
                        <div class="content">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>FOLIO</th>
                                        <th>Descripción</th>
                                        <th>Registro</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>Otto</td>
                                        <td>
                                            
                                            
                                            <a href="#modal_default_3" data-toggle="modal"><span class="icon-eye-open"></span> Ver</a> 
                                        </td>
                                    </tr>
                                   

                                </tbody>
                            </table>   


                            <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
                                <a class="first paginate_button paginate_button_disabled">Primero</a>
                                <a 
                                    class="previous paginate_button" id="DataTables_Table_1_previous">Previous</a><span>
                                    <a tabindex="0" class="paginate_active">1</a><a tabindex="0" class="paginate_button">2</a></span>
                                <a tabindex="0" class="next paginate_button" id="DataTables_Table_1_next">
                                    Next</a><a tabindex="0" class="last paginate_button" id="DataTables_Table_1_last">Last</a></div>
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

        
        
        <div class="modal" id="modal_default_3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Entrada con el tiket #</h4>
                </div>
                <div class="modal-body clearfix">
                    
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Talla</th>
                                <th>Cantidad</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>USA</td>
                                <td>Otto</td>
                                
                            </tr>
                                                         
                        </tbody>
                    </table>                     

                </div>
                <div class="modal-footer">                
                    <button type="button" class="btn btn-default btn-clean" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning btn-clean">REIMPRIMIR</button>
                </div>
            </div>
        </div>
    </div>    
    </body>
</html>