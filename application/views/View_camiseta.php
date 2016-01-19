<?php
//echo '<pre>';
//print_r($camiseta);
//echo '</pre>'; 
//
//echo '<pre>';
//print_r($categoria);
//echo '</pre>'; 

//echo '<pre>';
//print_r($camRelacionadas);
//echo '</pre>';
?>
<!-- CUERPO -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-1">
            </div>

            <div class="col-md-10">
                <div class="product-content-right">                        
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <img src="<?= base_url() . 'assets/images/' . $camiseta[0]['imagen'] ?>" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name"><?= $camiseta[0]['nombre_cam'] . ' - ' . $camiseta[0]['cod_camiseta'] ?></h2>
                                <div class="product-inner-price">
                                    <?= MostrarDescuento($camiseta[0]['precio'], $camiseta[0]['descuento']) ?>
                                </div>    

                                <form action="" class="cart">
                                    <div class="quantity">
                                        <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                    </div>
                                    <button class="add_to_cart_button" type="submit"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Comprar</button>
                                </form>   


                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">                                         

                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>Descripción</h2>  
                                            <p><?= $camiseta[0]['descripcion'] ?></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- CAMISETAS RELACIONDAS -->
                    <div class="related-products-wrapper">
                        <h2 class="related-products-title">Camisetas relacionadas</h2>
                        <div class="related-products-carousel">
                            <?php foreach ($camRelacionadas as $key => $cam): ?>

                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="<?= base_url().'assets/images/'.$cam['imagen']?>" alt="" >
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <?=anchor('Ctrl_camiseta/Ver/'.$cam['idCamiseta'], '<i class="fa fa-link"></i>Ver detalles', 'class="view-details-link"')?>
                                            
                                        </div>
                                    </div>

                                    <h2><?=anchor('Ctrl_camiseta/Ver/'.$cam['idCamiseta'], $cam['descripcion'])?></h2>

                                    <div class="product-carousel-price">
                                        <?= MostrarDescuento($cam['precio'], $cam['descuento']) ?>
                                    </div> 
                                </div>

                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>                    
            </div>

            <div class="col-md-2">
            </div>
        </div>
    </div>
</div>