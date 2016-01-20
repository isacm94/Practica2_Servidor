<?php
//echo '<pre>';
//print_r($seleccionadas);
//echo '</pre>';
?>
<!-- CUERPO -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">

            <?php foreach ($seleccionadas as $key => $camiseta) : ?>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">

                        </div>
                        <h2> <?php echo anchor('Ctrl_camiseta/Ver/' . $camiseta['idCamiseta'], '<img src="' . base_url() . 'assets/images/' . $camiseta['imagen'] . '">' . $camiseta['descripcion']) ?></h2>
                        <div class="product-carousel-price">                            
                            <?php MostrarDescuento($camiseta['precio'], $camiseta['descuento']) ?>
                        </div>  

                        <div class="product-option-shop">
                            <?php echo anchor('Carrito/Comprar/'.$camiseta['idCamiseta'], '<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Comprar', 'class  = "add_to_cart_button"') ?>
                            
                             
                        </div>                       
                    </div>
                </div>     
            <?php endforeach; ?>

        </div>
    </div>
</div>