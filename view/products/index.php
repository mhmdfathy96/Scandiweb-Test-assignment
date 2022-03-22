    <?php

    use app\model\ProductModel;
    ?>

    <form method="POST" action="/products/delete">
        <div class="page-header">
            <p class="header-title">Products List</p>
            <div class="header-buttons">
                <a href="/products/create" class="btn btn-success">ADD</a>
                <button type="submit" class="btn btn-sm btn-danger">MASS DELETE</button>
            </div>
        </div>
        <hr>
        <?php
        if (empty($products)) : ?>

            <div class="no-products">
                <p> No Products Available Right Now , Please add some ..</p>
            </div>
        <?php elseif (!empty($products)) : ?>
            <section class="products-list">
                <?php
                foreach ($products
                    as $product) :
                ?>
                    <div>
                        <input type="checkbox" class="delete-checkbox" name="<?php echo $product->getSKU() ?>" value="<?php echo $product->getSKU() ?>">
                        <p class="card-id"><?php echo 'SKU: '.$product->getSKU() ?></p>
                        <p class="card-name"><?php echo 'Name: '.$product->getName()?></p>
                        <p class="card-price"><?php echo 'Price: '.$product->getPrice().' $' ?></p>
                        <p class="card-specific"><?php
                        if($product->getSize()!=0){
                            echo 'Size: '.$product->getSize().' MB';
                        }elseif($product->getWeight()!=0.0){
                            echo 'Weight: '.$product->getWeight().' KG';
                        }elseif($product->getHeight()!=0){
                            echo 'Dimensions: '.$product->getHeight().'x'.$product->getWidth().'x'.$product->getLength();
                        }
                        ?></p>
                        <p class="card-date"><?php echo 'Date: '.$product->getDate() ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            </section>
    </form>