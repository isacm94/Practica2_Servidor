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
                                    <img src="<?= base_url() . 'assets/img/imagesAPP/' . $camiseta[0]['imagen'] ?>" alt="">
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
                                   <?php echo anchor('Carrito/comprar/'.$camiseta[0]['idCamiseta'], '<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Comprar', 'class  = "add_to_cart_button"') ?>
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
                    <?php $this->load->view('View_camisetasRel');?>
                </div>                    
            </div>

            <div class="col-md-2">
            </div>
        </div>
    </div>
</div>