<?php
/*
 * VISTA 
 */
?>
<!-- CUERPO -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form method="post" action="<?=  site_url().'/XML/ProcesaArchivo'?>" enctype="multipart/form-data">
                <input type="file" name="archivo" class="add_to_cart_button" /><br />
                <input type="submit" value="Enviar" />
            </form>               
        </div>
    </div>
</div>
