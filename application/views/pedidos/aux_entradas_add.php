<script type="text/javascript">
    $(document).ready(function() {
        $('.eliminar').click(function() {
            var user = $(this).attr("title"); // Aqui se optine el valor del idProducto 

            $('#eliminarinput').val(user);
        });
    });
    $(document).ready(function() {
        $('.editar').click(function() {
            var user = $(this).attr("title"); // Aqui se optine el valor del idProducto 

            $('#inputeditar').val(user);
        });
    });

    $(document).ready(function() {
        $('.mas').click(function() {
            var user = $(this).attr("title");
            var name = $(this).attr("name");// Aqui se optine el valor del idProducto 
            var dataString = 'inputeditar=' + user + '&idproducto=' + name;
            $.ajax({
                type: "GET",
                url: "<?php echo site_url('') ?>pedidos/mas",
                data: dataString,
                success: function(data) {
                    if (data == 'no_hay_existencias') {
                        $('#tasum').html("<h1>YA NO HAY EXISTENCIAS</h1>");

                    } else {
                        $('#tasum').html("");
                        $('#' + user).html(data);
                    }
                    return false;
                }

            });




        }


        );
    });
    $(document).ready(function() {
        $('.menos').click(function() {
            var user = $(this).attr("title");
            var name = $(this).attr("name");// Aqui se optine el valor del idProducto 

            var dataString = 'inputeditar=' + user + '&idproducto=' + name;
            //alert(dataString);
            $.ajax({
                type: "GET",
                url: "<?php echo site_url('') ?>pedidos/menos",
                data: dataString,
                success: function(data) {

                    $('#tasum').html("");
                    if (data == 'error') {

                        $('#tr' + user).remove();
                    } else {
                        $('#' + user).html(data);
                    }

                    return false;
                }

            });




        }


        );
    });
</script>
<?php echo $error ?>
<div style="text-align:center" id="tasum"></div>
<table class="table table-hover" >
    <thead>
        <tr>
            <th>Cantidad</th>
            <th>Producto</th>
            <th>Talla</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody >

        <?php
        if (isset($entradas)) {
            foreach ($entradas->result() as $rowx) {
                ?>
                <tr id="tr<?php echo $rowx->idSalida; ?>">
                    <td ><span id="<?php echo $rowx->idSalida; ?>" ><?php echo $rowx->cantidad; ?></span></td>
                    <td><?php echo $rowx->nombre; ?></td>
                    <td><?php echo $rowx->talla; ?></td>
                    <td>

                        <button type="button"  title="<?php echo $rowx->idSalida; ?>"  name="<?php echo $rowx->idProductos; ?>"  class="btn btn-primary mas">+</button>
                        <button type="button"   title="<?php echo $rowx->idSalida; ?>" name="<?php echo $rowx->idProductos; ?>"  class="btn btn-success menos">-</button>
                        <a href="#modal_default_6" data-toggle="modal" name="<?php echo $rowx->idProductos; ?>" title="<?php echo $rowx->idSalida; ?>" class="widget-icon widget-icon-small eliminar"><span class="icon-trash"></span></a>
                        <a href="#modal_default_3" data-toggle="modal" name="<?php echo $rowx->idProductos; ?>" title="<?php echo $rowx->idSalida; ?>" class="widget-icon widget-icon-small editar"><span class="icon-pencil"></span></a>



                    </td>
                </tr>


                <?php
            }
        }
        ?>
    </tbody>
</table>   