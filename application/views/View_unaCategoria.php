<?php
//echo '<pre>';
//print_r($camisetas);
//echo '</pre>';
if (count($camisetas) == 0):
    ?>
    <div class="woocommerce-info">No existen camisetas para mostrar en esta categoría</div>
    <?php
endif;

if (count($camisetas) > 0):
    ?>

    <div class="single-product-area">
        <div class="container">
            <div class="row">

                <?php foreach ($camisetas as $key => $camiseta) : ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="single-shop-product">
                            <div class="product-upper">
                                <img src="<?= base_url() . 'assets/images/' . $camiseta['imagen'] ?>" alt="" style="heigth: 243; width: 208px;">
                            </div>
                            <h2><a href=""><?= $camiseta['descripcion'] ?></a></h2>
                            <div class="product-carousel-price">
                                <?php if ($camiseta['descuento'] != '0.00') : ?>
                                    <ins><?= $camiseta['precio'] * (1 - ($camiseta['descuento'] / 100)) ?> €</ins>
                                    <del><?= $camiseta['precio'] ?> €</del>
                                <?php endif; ?>

                                <?php if ($camiseta['descuento'] == '0.00') : ?>
                                    <ins><?= $camiseta['precio'] ?> €</ins>
                                <?php endif; ?>
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
    <?php
endif;
?>