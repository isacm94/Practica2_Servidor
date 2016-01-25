<?php
//echo '<pre>';
//print_r($this->cart->contents());
//echo '</pre>';
?>
<!--CUERPO -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <form method="post" action="">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">Eliminar</th>
                                        <th class="product-thumbnail">Imagen</th>
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
                                                <?= anchor('Carrito/eliminar/' . $items['id'], '<span class="glyphicon glyphicon-remove"></span>', 'title = "Eliminar esta camiseta"') ?>
                                            </td>

                                            <td class="product-thumbnail">
                                                <a href="single-product.html"><img width="145" height="145" class="shop_thumbnail" src="<?= base_url() . 'assets/images/' . $items['options']['imagen'] ?>"></a>
                                            </td>

                                            <td class="product-name">
                                                <a href="single-product.html"><?= $items['name'] ?></a>
                                            </td>

                                            <td class="product-price">
                                                <span class="amount"><?= $items['price'] ?> €</span>
                                            </td>

                                            <td class="product-quantity">

                                                <div class="quantity buttons_added">

                                                    <button type="button" class="add_to_cart_button"  onclick="menos(<?= $items['id'] ?>)">
                                                        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                                                    </button>

                                                    <input type="number" id="cantidad[<?= $items['id'] ?>]" name="cantidad[<?= $items['id'] ?>]" size="4" class="input-text qty text" value="<?= $items['qty'] ?>" min="0" step="1">

                                                    <button type="button" class="add_to_cart_button"  onclick="mas(<?= $items['id'] ?>)">
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                                    </button>


                                                    <?= $items['options']['error']; ?>

                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount"><?= $items['subtotal'] ?> €</span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr class="product-name">
                                        <td class="actions" colspan="3">
                                            <strong>Importe Total:</strong> <?= $this->cart->total() ?> €
                                        </td>

                                        <td class="actions" colspan="3">
                                            <strong>Cantidad Total:</strong> <?= $this->cart->total_items() ?> camisetas
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md-8">
                                <?php
                                if (isset($msg_error))
                                    echo $msg_error;
                                ?>

                            </div>
                            <div class="col-md-4">

                                <button type="submit" class="add_to_cart_button product-name" name="guardar">
                                    <span class="glyphicon glyphicon-floppy-disk"></span> Guardar cambios
                                </button>
                                <a href="http://localhost/Practica2_Servidor/index.php" class="add_to_cart_button product-name">
                                    <span class="glyphicon glyphicon-ok"></span> FINALIZAR COMPRA
                                </a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


