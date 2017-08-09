  <?php  $row = $pedido->row(); ?>

  <!DOCTYPE html>
  <html>
  <head>
    
     <script type="text/javascript">
        function imprSelec(muestra)
        {
            var ficha = document.getElementById(muestra);
            var ventimp = window.open(' ', 'popimpr');
            ventimp.document.write(ficha.innerHTML);
            ventimp.document.close();
            ventimp.print();
            ventimp.close();
            javascript:history.back(1);
        }
    </script> 
</head>
<body onload="javascript:imprSelec('muestra')">

    <div  id="muestra">
    <table style="font-size:13px;" border=".5">


        <tr>
            <td>REFERENCIA:</td>
            <td style="width: 100px"><?php echo $row->referencia?></td>
            <td>RUTA :</td>
            <td style="width: 70px"></td>
            <td>DETERMINATE :</td> 
            <td style="width: 55px" ><h1><?php echo $row->determinante?></h1></td>
        </tr>
        

        <tr><td>TIENDA</td> <td colspan="5"><?php echo $row->tienda?></td></tr>
        <tr><td colspan="6"><br><br></td></tr>
        <tr><td><strong>PROVEEDOR: </strong></td> <td colspan="5">Proveedora Industrial Alfed S.A de C.V</td></tr>
        <tr><td colspan="6"><br><br></td></tr>
        <tr><td>BULTOS:</td><td ></td><td>FECHA: </td><td colspan="3"><?php echo $hora?> Hrs</td></tr>
        
        <tr><td valign="top">PRODUCTOS:</td><td colspan="5">Talla CH (71-79 cm) = <?php echo $row->tallaCH?> pz
            <br> Tall M (80-87 cm) = <?php echo $row->tallaM?> pz
            <br> Tall G (88-94 cm) = <?php echo $row->tallaG?> pz
            <br> Tall EX (95-101 cm) = <?php echo $row->tallaEX?> pz
            <br> Tall EXX (102-109 cm)  = <?php echo $row->tallaEXX?> pz<br>______________________<br>
            <br> TOTAL <?php echo $row->total?> pz

        </td></tr>



    </table>

</div>

<button> <a href="javascript:history.back(1)">REGRESAR</a></button>
</body>
</html>