  <?php  $row = $etiqueta->row(); ?>

  <!DOCTYPE html>
  <html>
  <head>
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
    </script> 
</head>
<body onload="javascript:imprSelec('muestra')">

    <div  id="muestra" >
        <div id="barcode"><?php echo $row->codigo?></div>

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
    get_object("barcode").innerHTML=DrawHTMLBarcode_Code128A(get_object("barcode").innerHTML,"yes","in",0,5.1,2.54,"bottom","center","","black","white");
    /* ]]> */
</script>
</body>
</html>