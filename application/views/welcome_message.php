<!DOCTYPE html>
<html lang="es-419">
<head>        
    <title>Administrador</title>

    <?php  $this->load->view('plantilla/top'); ?>


</head>
<body class="bg-img-num1"> 

    <div class="container">        

        <div class="login-block">
            <div class="block block-transparent">
                <div class="head">
                    <div class="user">
                        <div class="info user-change">                                                                                
                            <img src="<?php echo site_url('') ?>img/example/user/dmitry_b.jpg" class="img-circle img-thumbnail"/>
                            <div class="user-change-button">
                                <span class="icon-off"></span>
                            </div>
                        </div>                            
                    </div>
                </div>

                <?php  

                if((strcmp($navegador , "permitido" ) == 0)){ ?>
                <form id="enviarbtn" action="<?php echo site_url('') ?>Welcome/login" method="POST">
                    <div class="content controls npt">
                        <div class="form-row ">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="icon-user"></span>
                                    </div>
                                    <input type="email" name="email" class="form-control" required="" placeholder="Email"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="icon-key"></span>
                                    </div>
                                    <input type="password" name="pass" class="form-control" required="" placeholder="Password"/>
                                </div>
                            </div>
                        </div>  
                        <?php  

                        if((strcmp($cadena , "error" ) == 0)){ ?>
                        <div class="form-row">
                            <div class="alert alert-danger" style="text-align: center">
                             Usuario no registrado

                         </div>
                     </div>

                     <?php  } ?>
                     <div class="form-row">
                        <div class="col-md-12">
                            <input type="submit" value="Entrar" class="btn btn-default btn-block btn-clean">

                        </div>

                    </div>


                </div>
            </form>

            <?php  }else{ ?>

            <h5>Por cuestiones de seguridad y funcionalidad  se recomienda que trabaje en estos dos navegadores.</h5>
           <div class="col-md-6">
            <a href="https://www.mozilla.org/es-MX/firefox/new/">Descargar Mozilla</a> 
            </div><div class="col-md-6">       <a href="https://www.google.com.mx/chrome/browser/desktop/">Descargar Google Chrom</a></div>
            <img src="img/navegadores.png">

            <?php }?>
            

        </div>
    </div>

</div>

</body>
</html>