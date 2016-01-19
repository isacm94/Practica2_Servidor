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
                <form enctype="multipart/form-data" action="#" class="checkout" method="post" name="checkout">

                    <div id="customer_details" class="col2-set">
                        <h3>Seleccione una categoría...</h3>
                        <p id="billing_country_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                            <label class="" for="billing_country">Categoría</label>
                            <select class="country_to_state country_select" id="categoriaselect" name="categoriaselect">

                                <?php foreach ($categorias as $categoria => $value) : ?>

                                    <option value="<?= $value['idCategoria'] ?>" <?=set_select('categoriaselect', $value['idCategoria']); ?> ><?= $value['nombre_cat'] ?></option>  

                                <?php endforeach; ?>

                                <input type="submit" value="Ver" name="vercategoria">

                            </select>
                        </p>
                    </div>
                </form>

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