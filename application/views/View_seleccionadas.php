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
                            <img src="<?= base_url().'assets/images/'.$camiseta['imagen'] ?>" alt="" style="heigth: 243; width: 208px;">
                        </div>
                        <h2> <?php echo anchor('Ctrl_camiseta/Ver/'.$camiseta['idCamiseta'], $camiseta['descripcion'])?></h2>
                        <div class="product-carousel-price">                            
                            <?php MostrarDescuento($camiseta['precio'], $camiseta['descuento'])?>
                        </div>  

                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Comprar</a>
                        </div>                       
                    </div>
                </div>     
            <?php endforeach; ?>

        </div>
    </div>
</div>