<div class="product-container">
    <a href="?c=product&a=show&id=<?= $product->getId() ?>">
        <div class="image">
            <img class="img-responsive" src="../upload/<?= $product->getFeaturedImage() ?>" alt="">
        </div>
        <div class="product-meta">
            <h5 class="name">
                <a class="product-name" href="?c=product&a=show&id=<?= $product->getId() ?>" title="Kem làm trắng da 5 trong 1 Beaumore Secret Whitening Cream"><?= $product->getName() ?></a>
            </h5>
            <div class="product-item-price">
                <?php if ($product->getPrice() != $product->getSalePrice()) : ?>
                    <span class="product-item-regular"><?= number_format($product->getPrice()) ?></span>
                <?php endif ?>
                <span class="product-item-discount"><?= number_format($product->getSalePrice()) ?></span>
            </div>
        </div>

    </a>
</div>