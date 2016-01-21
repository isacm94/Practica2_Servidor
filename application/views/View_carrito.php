<!--CUERPO -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <form method="post" action="#">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Descripción</th>
                                        <th class="product-price">Precio</th>
                                        <th class="product-quantity">Cantidad</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($this->cart->contents() as $items): ?>
                                    <tr class="cart_item">
                                        <td class="product-remove">
                                            <?=anchor('', '<span class="glyphicon glyphicon-remove"></span>', 'title = "Eliminar esta camiseta"')?> 
                                        </td>

                                        <td class="product-thumbnail">
                                            <a href="single-product.html"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="img/product-thumb-2.jpg"></a>
                                        </td>

                                        <td class="product-name">
                                            <a href="single-product.html"><?=$items['name']?></a> 
                                        </td>

                                        <td class="product-price">
                                            <span class="amount">£15.00</span> 
                                        </td>

                                        <td class="product-quantity">
                                            <div class="quantity buttons_added">
                                                <?=anchor('', '<span class="glyphicon glyphicon-minus"></span>', Array('title' => 'Eliminar esta camiseta', 'class' => 'add_to_cart_button'))?>
                                                <input type="number" size="4" class="input-text qty text" title="Qty" value="1" min="0" step="1">
                                                <?=anchor('', '<span class="glyphicon glyphicon-plus"></span>', Array('title' => 'Eliminar esta camiseta', 'class' => 'add_to_cart_button'))?>
                                            </div>
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="amount">£15.00</span> 
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                    <tr class="product-name">
                                        <td class="actions" colspan="3">
                                            <strong>Importe Total:</strong> 
                                        </td>
                                        
                                        <td class="actions" colspan="3">
                                            <?=anchor('', '<span class="glyphicon glyphicon-refresh"></span> Actualizar', Array('title' => 'Actualizar', 'class' => 'add_to_cart_button'))?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>                       
                    </div>                        
                </div>                    
            </div>
        </div>
    </div>
</div>


