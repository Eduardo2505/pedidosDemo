
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Talla</th>
            <th>Cantidad</th>

        </tr>
    </thead>
    <?php
    if (isset($entradas)) {
        $sum = 0;
        foreach ($entradas->result() as $rowx) {
            ?>



            <tbody>
                <tr>
                    <td><?php echo $rowx->nombre; ?></td>
                    <td><?php echo $rowx->talla; ?></td>
                    <td><?php echo $rowx->cantidad; ?> pz</td>

                </tr>

            </tbody>


            <?php
            $sum+=$rowx->cantidad;
        }
    }
    ?>
    <tr>
        <th></th>
        <th>TOTAL: </th>
        <th><?php echo $sum ?> pz</th>

    </tr>

</table> 