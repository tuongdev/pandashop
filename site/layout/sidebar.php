<aside class="col-md-3">
                <div class="inner-aside">
                    <div class="category">
                        <h5>Danh mục sản phẩm</h5>
                        <ul>
                            <li class="<?= empty($category_id) ? 'active' : '' ?>">
                                <a href="?c=product" title="Tất cả sản phẩm" target="_self">Tất cả sản phẩm
                                </a>
                            </li>
                            <?php foreach ($categories as $category) : ?>
                                <li class="<?= $category->getId() == $category_id ? 'active' : '' ?>">
                                    <a href="?c=product&category_id=<?= $category->getId() ?>" title="<?= $category->getName() ?>" target="_self"><?= $category->getName() ?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="price-range">
                        <h5>Khoảng giá</h5>
                        <ul>
                            <li>
                                <label for="filter-less-100">
                                    <input type="radio" id="filter-less-100" name="filter-price" value="0-100000" <?=!empty($price_range) && $price_range == "0-100000" ? 'checked' : ''?>>
                                    <i class="fa"></i>
                                    Giá dưới 100.000đ
                                </label>
                            </li>
                            <li>
                                <label for="filter-100-200">
                                    <input type="radio" id="filter-100-200" name="filter-price" value="100000-200000" <?=!empty($price_range) && $price_range == '100000-200000' ? 'checked': ''?>>
                                    <i class="fa"></i>
                                    100.000đ - 200.000đ
                                </label>
                            </li>
                            <li>
                                <label for="filter-200-300">
                                    <input type="radio" id="filter-200-300" name="filter-price" value="200000-300000" <?=!empty($price_range) && $price_range == '200000-300000' ? 'checked': ''?>>
                                    <i class="fa"></i>
                                    200.000đ - 300.000đ
                                </label>
                            </li>
                            <li>
                                <label for="filter-300-500">
                                    <input type="radio" id="filter-300-500" name="filter-price" value="300000-500000" <?=!empty($price_range) && $price_range == '300000-500000' ? 'checked': ''?>>
                                    <i class="fa"></i>
                                    300.000đ - 500.000đ
                                </label>
                            </li>
                            <li>
                                <label for="filter-500-1000">
                                    <input type="radio" id="filter-500-1000" name="filter-price" value="500000-1000000" <?=!empty($price_range) && $price_range == '500000-1000000' ? 'checked': ''?>>
                                    <i class="fa"></i>
                                    500.000đ - 1.000.000đ
                                </label>
                            </li>
                            <li>
                                <label for="filter-greater-1000">
                                    <input type="radio" id="filter-greater-1000" name="filter-price" value="1000000-greater" <?=!empty($price_range) && $price_range == '1000000-greater' ? 'checked': ''?>>
                                    <i class="fa"></i>
                                    Giá trên 1.000.000đ
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>