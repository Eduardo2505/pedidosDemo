  <!DOCTYPE html>
  <html>
  <head>
   <title>Impimir</title>
   <script type='text/javascript' src='<?php echo site_url('') ?>js/connectcode-javascript-code128a.js'></script>
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
        //"
    </script> 
</head>
<body onload="javascript:imprSelec('muestra')"> 

    <div  id="muestra">



        <table style="font-size:12px" >
            <tr>
                <td style="width: 30px"></td>
                <td style="width: 260px;text-align: center;">
                   Cedis: <?php echo $cedis?>
               </td>
               <td style="width: 60px"></td>
           </tr>
           <tr>
               <td></td>
               <td> <div id="barcode"><?php echo $cedis?></div><br></td>
               <td></td>
           </tr>
           <tr>
            <td>OC: </td>
            <td> <div id="barcode1"><?php echo $oc?></div></td>
            <td ></td>
        </tr>
        <tr>
            <td>UPC: </td><td> <div id="barcode2"><?php echo $upc1?></div></td>
            <td>piezas : <?php echo $pzaupc1?></td>
        </tr>
        <tr>
            <td>UPC: </td><td> <div id="barcode3"><?php echo $upc2?></div></td>
            <td>piezas : <?php echo $pzaupc2?></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center">Piezas totales en caja : <?php echo $pzat?></td>
        </tr>
        <tr>
            <td></td><td> <div id="barcode4"><?php echo $numcaja?></div></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center">No. de caja <?php echo $numcaja?> de <?php echo $cajaTotal?></td>
        </tr>


    </table>

</div>

<button> <a href="javascript:history.back(1)">REGRESAR</a></button>

<script type="text/javascript">
    /* <![CDATA[ */
    function get_object(id) {
       var object = null;
       if (document.layers) {
        object = document.layers[id];
    } else if (document.all) {
        object = document.all[id];
    } else if (document.getElementById) {
        object = document.getElementById(id);
    }
    return object;
}
get_object("barcode").innerHTML=DrawHTMLBarcode_Code128A(get_object("barcode").innerHTML,"yes","in",0,2.5,.7,"bottom","center","","black","white");
get_object("barcode1").innerHTML=DrawHTMLBarcode_Code128A(get_object("barcode1").innerHTML,"yes","in",0,2.5,.7,"bottom","center","","black","white");
get_object("barcode2").innerHTML=DrawHTMLBarcode_Code128A(get_object("barcode2").innerHTML,"yes","in",0,2.5,.7,"bottom","center","","black","white");
get_object("barcode3").innerHTML=DrawHTMLBarcode_Code128A(get_object("barcode3").innerHTML,"yes","in",0,2.5,.7,"bottom","center","","black","white");
get_object("barcode4").innerHTML=DrawHTMLBarcode_Code128A(get_object("barcode4").innerHTML,"yes","in",0,2.5,.7,"bottom","center","","black","white");
/* ]]> */
</script>
</body>
</html>