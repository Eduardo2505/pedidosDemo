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
            var user = $(this).attr("title"); // Aqui se optine el valor del idProducto 

            var dataString = 'inputeditar=' + user;
            $.ajax({
                type: "GET",
                url: "<?php echo site_url('') ?>entradas/mas",
                data: dataString,
                success: function(data) {
                    //  alert(data);
                    $('#' + user).html(data);

                    return false;
                }

            });




        }


        );
    });
    $(document).ready(function() {
        $('.menos').click(function() {
            var user = $(this).attr("title"); // Aqui se optine el valor del idProducto 

            var dataString = 'inputeditar=' + user;
            $.ajax({
                type: "GET",
                url: "<?php echo site_url('') ?>entradas/menos",
                data: dataString,
                success: function(data) {

                   var string = $.trim(data);
                   if (string == 'error') {

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
                <tr id="tr<?php echo $rowx->idEntradas; ?>">
                    <td ><span id="<?php echo $rowx->idEntradas; ?>" ><?php echo $rowx->cantidad; ?></span></td>
                    <td><?php echo $rowx->nombre; ?></td>
                    <td><?php echo $rowx->talla; ?></td>
                    <td>

                        <button type="button"  title="<?php echo $rowx->idEntradas; ?>"  class="btn btn-primary mas">+</button>
                        <button type="button"  title="<?php echo $rowx->idEntradas; ?>"  class="btn btn-success menos">-</button>
                        <a href="#modal_default_6" data-toggle="modal" title="<?php echo $rowx->idEntradas; ?>" class="widget-icon widget-icon-small eliminar"><span class="icon-trash"></span></a>
                        <a href="#modal_default_3" data-toggle="modal" title="<?php echo $rowx->idEntradas; ?>" class="widget-icon widget-icon-small editar"><span class="icon-pencil"></span></a>


                    </td>
                </tr>


                <?php
            }
        }
        ?>
    </tbody>
</table>   