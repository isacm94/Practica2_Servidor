<?php
//echo '<pre>';
//print_r($categorias);
//echo '</pre>';
?>
<!--CUERPO-->
<div class="single-product-area">

    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">            
            <div class="col-md-2">
                <div id="customer_details">
                    <h3>Categorías</h3>
                    <?php foreach ($categorias as $key => $categoria): ?>

                        <?= anchor('Categorias/ver/'.$categoria['idCategoria'], '<div class="shopping-item" style="float: none; margin-top: 0px;">'.$categoria['nombre_cat']).'</div>' ?>
                        <br>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-9">
                <?php
                if (isset($htmlUnaCategoria))
                    echo $htmlUnaCategoria;
                ?>
            </div>

        </div>
    </div>
</div>
</div>
