    <h2 class="related-products-title">Camisetas relacionadas</h2>
                        <div class="related-products-carousel">
                            <?php foreach ($camRelacionadas as $key => $cam): ?>

                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="<?= base_url().'assets/images/'.$cam['imagen']?>" alt="" >
                                        <div class="product-hover">
                                            <a href="<?=base_url()."index.php/Carrito/comprar/".$cam['idCamiseta']?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Comprar</a>
                                            
                                            <?=anchor('Camiseta/ver/'.$cam['idCamiseta'], '<i class="fa fa-link"></i>Ver detalles', 'class="view-details-link"')?>
                                            
                                        </div>
                                    </div>

                                    <h2><?=anchor('Camiseta/ver/'.$cam['idCamiseta'], $cam['descripcion'])?></h2>

                                    <div class="product-carousel-price">
                                        <?= MostrarDescuento($cam['precio'], $cam['descuento']) ?>
                                    </div> 
                                </div>

                            <?php endforeach; ?>

                        </div>
                    </div>
