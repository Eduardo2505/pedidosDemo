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
                        <li class="active">Captura</li>
                    </ol>
                </div>
            </div>        

            <div class="row">

                <div class="col-md-6">                  

                    <div class="col-md-12">
                        <div class="block">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="icon-search"></span></div>
                                <input type="text" class="form-control"  placeholder="Buscar..">  

                            </div>

                        </div> 
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
                            <div class="list list-contacts">
                                <a href="#" class="list-item">
                                    <div class="list-info">
                                        <img src="img/example/user/dmitry_s.jpg" class="img-circle img-thumbnail">
                                    </div>
                                    <div class="list-text">
                                        <span class="list-text-name">John Doe</span>                                    
                                        <div class="list-text-info">
                                            <i class="icon-map-marker"></i> Kyiv, Ukraine 
                                            <i class="icon-comments"></i> <b>5</b>/142 
                                        </div>
                                    </div>
                                    <div class="list-status list-status-offline"></div>
                                </a>

                                <a href="#" class="list-item">
                                    <div class="list-info">
                                        <img src="img/example/user/alexey_s.jpg" class="img-circle img-thumbnail">
                                    </div>
                                    <div class="list-text">
                                        <span class="list-text-name">Brad Pitt</span>                                    
                                        <div class="list-text-info">
                                            <i class="icon-map-marker"></i> San Francisco, SA
                                            <i class="icon-comments"></i> 81
                                        </div>
                                    </div>
                                    <div class="list-status list-status-online"></div>
                                </a>
                                <a href="#" class="list-item">
                                    <div class="list-info">
                                        <img src="img/example/user/helen_s.jpg" class="img-circle img-thumbnail">
                                    </div>
                                    <div class="list-text">
                                        <span class="list-text-name">Keira Knightley</span>                                    
                                        <div class="list-text-info">
                                            <i class="icon-map-marker"></i> London, Great Britan 
                                            <i class="icon-comments"></i> 51
                                        </div>
                                    </div>
                                    <div class="list-status list-status-away"></div>
                                </a>                            
                            </div>                        
                        </div>
                    </div>                





                </div>

                <!-- tabla -->
                <div class="col-md-6">
                    <form method="POST">
                        <div class="block">
                            <div class="header">
                                <h2>Traspaso</h2>

                            </div>
                            <div class="content controls">    

                                <div class="form-row">

                                   
                                    <div class="col-md-6">

                                        <input type="text" class="form-control" placeholder="Descripción" required=""/>

                                    </div>
                                     <div class="col-md-3">

                                         <select required="">
                                             <option>Sucursal</option>
                                         </select>

                                    </div>
                                    <div class="col-md-3">
                                        <input type="submit" value="IMPRIMIR" class="btn btn-success">
                                    </div>
                                </div>


                            </div>

                        </div>
                    </form>
                    <div class="block">
                        <div class="header">
                            <h2>Productos</h2>
                        </div>
                        <div class="content">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Producto</th>
                                        <th>Talla</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td><button type="button" class="btn btn-primary">+</button>
                                            <button type="button" class="btn btn-success">-</button>
                                            <a href="#modal_default_6" data-toggle="modal" class="widget-icon widget-icon-small "><span class="icon-trash"></span></a>
                                            <a href="#modal_default_3" data-toggle="modal" class="widget-icon widget-icon-small"><span class="icon-pencil"></span></a>


                                        </td>
                                    </tr>


                                </tbody>
                            </table>                       
                        </div>
                    </div>                 

                </div>


            </div>        


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
                        <form>
                            <div class="form-row">
                                <div class="col-md-6">

                                    <input type="text" pattern="[0-9]{1,5}" class="form-control" required="" placeholder="Cantidad"/>

                                </div>

                                <div class="col-md-3">
                                    <input type="submit" value="GUARDAR" class="btn btn-warning btn-clean">
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>


        <!--De confirmacion-->

        <div class="modal" id="modal_default_6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">                
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">¿Estas seguro que quieres eliminarlo ?</h4>
                    </div>                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-clean" data-dismiss="modal">Si</button>
                        <button type="button" class="btn btn-danger btn-clean" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>  


    </body>
</html>