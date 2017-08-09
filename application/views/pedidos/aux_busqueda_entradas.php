
<script type="text/javascript">
    $(document).ready(function() {
        $('.optenerID').click(function() {
            var user = $(this).attr("title"); // Aqui se optine el valor del idProducto 

            var dataString = 'idProducto=' + user;
            $.ajax({
                type: "GET",
                url: "<?php echo site_url('') ?>pedidos/agregar",
                data: dataString,
                success: function(data) {
                    // alert(data);
                    $('#resultado').html(data);

                    return false;
                }

            });




        }


        );
    });


</script>
<?php
if (isset($productos)) {
    foreach ($productos->result() as $row) {
        ?>
        <?php $summm = $row->suma; ?>
        <a href="#" class="list-item optenerID" title="<?php echo $row->idProductos; ?>"  >
            <div class="list-info">
                <img src="<?php echo site_url('') ?>img/example/user/dmitry_s.jpg" class="img-circle img-thumbnail">
            </div>
            <div class="list-text">
                <span class="list-text-name"><?php echo $row->nombre; ?></span>                                    
                <div class="list-text-info">
                    <i class="icon-user-md"></i>  TALLA: <?php echo $row->talla; ?>    <i class="icon-check"></i> <?= $summm ?> PZ

                </div>
            </div>

            <?php if ($summm == 0) { ?>
                <div class="list-status list-status-offline"></div> 
            <?php } ?>

            <?php if ($summm <= 5 && $summm != 0) { ?>
                <div class="list-status list-status-away"></div>
            <?php } ?>

            <?php if ($summm > 10) { ?>
                <div class="list-status list-status-online"></div>
            <?php } ?>




        </a>

        <?php
    }
}
?>
