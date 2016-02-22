<!DOCTYPE html>
<html>
  <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">      
    <title><?php 
    // Indicamos el t�tulo de la p�gina. Por defecto se mostrar� "Agregador de tiendas" 
   	if (isset($tmpl_titulo))
   		echo $tmpl_titulo; 
   	else 
   		echo "Agregador tiendas"; ?></title>
    <!-- CSS de Bootstrap -->
    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" media="screen">
 
    <!-- librer�as opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
    <?php
    // Incluimos cualquier tipo de informaci�n que deseemos en la secci�n <head> 
    if (isset($tmpl_head))
    {
    	echo $tmpl_head; 
    }
    ?> 
  </head>
  <body>
  	<?php 
  	if (isset($tmpl_encabezado)) 
  		echo $tmpl_encabezado;
  	else { ?>
    <h1>Agregador de tiendas</h1>
    <?php } ?>
    
    <!-- AQU� INCLUIR�IS UN ENLACE AL CLIENTE DE VUESTRA TIENDA - El enlace llevar� vuestro nombre -->
    <div id="menu" class="col-md-2"><?=$tmpl_menu?></div>
    <div id="cuerpo" class="col-md-10">
    <?php
    // Cuerpo de la p�gina 
    if (isset($tmpl_cuerpo))
    {
    	echo $tmpl_cuerpo; 
    }
    ?>     	
    </div>
 
    <!-- Librer�a jQuery requerida por los plugins de JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>
 
    <!-- Todos los plugins JavaScript de Bootstrap (tambi�n puedes
         incluir archivos JavaScript individuales de los �nicos
         plugins que utilices) -->
    <script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
    <?php
    // Scripts que necesitemos incorporar al final de la plantilla. Tan solo hay que suministrar el c�digo, la etiqueta <script> se a�ade 
    if (isset($tmpl_script))
    { 
    	echo "\n<script>\n$tmpl_script\n</script>";
    }
    ?> 
    </body>
</html>