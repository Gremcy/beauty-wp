<?php defined( 'ABSPATH' ) || exit;

global $product;

$favs = \PS\Functions\Helper\Helper::get_favorite_ids();
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'poduct-fluid ajax-products-item', $product ); ?>>
    <div class="product-centered">
        <div class="product-left">
            <div class="product__carousel">
                <div class="swiper-container gallery-top">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide easyzoom easyzoom--overlay">
                            <a href="<?php $image_id = $product->get_image_id(); echo $image_id ? wp_get_attachment_image_url( $image_id, '1600x0' ) : wc_placeholder_img_src(); ?>">
                                <img src="<?php echo $image_id ? wp_get_attachment_image_url( $image_id, '960x0' ) : wc_placeholder_img_src(); ?>" alt="">
                            </a>
                        </div>
                        <?php $attachment_ids = $product->get_gallery_image_ids(); if ( count($attachment_ids) ): ?>
                            <?php foreach ( $attachment_ids as $attachment_id ): ?>
                                <div class="swiper-slide easyzoom easyzoom--overlay">
                                    <a href="<?php echo wp_get_attachment_image_url( $attachment_id, '1600x0' ); ?>">
                                        <img src="<?php echo wp_get_attachment_image_url( $attachment_id, '960x0' ); ?>" alt="">
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="swiper-button-next">
                        <img src="<?php echo \PS::$assets_url; ?>images/icon22.svg" alt="" />
                    </div>
                    <div class="swiper-button-prev">
                        <img src="<?php echo \PS::$assets_url; ?>images/icon23.svg" alt="" />
                    </div>
                </div>
                <div class="swiper-container gallery-thumbs">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="<?php echo $image_id ? wp_get_attachment_image_url( $image_id, '150x0' ) : wc_placeholder_img_src(); ?>" alt="">
                        </div>
                        <?php $attachment_ids = $product->get_gallery_image_ids(); if ( count($attachment_ids) ): ?>
                            <?php foreach ( $attachment_ids as $attachment_id ): ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo wp_get_attachment_image_url( $attachment_id, '150x0' ); ?>" alt="">
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-right">
            <?php $in_stock = $product->is_in_stock(); if($in_stock): ?>
                <div class="product-right-stock">
                    <img src="<?php echo \PS::$assets_url; ?>images/icon24.svg" alt="">
                    <span>
                        <?php _e( 'In stock', \PS::$theme_name ); ?>
                        <?php if ( $product->get_type() == 'variable' ): ?>
                            <?php foreach ($product->get_available_variations() as $key): ?>
                                <?php
                                $variation = wc_get_product( $key['variation_id'] );
                                $stock = $variation->get_availability();

                                $attr_string = array();
                                foreach ( $key['attributes'] as $attr_name => $attr_value ) {
                                    $attr_string[] = $attr_value;
                                }
                                ?>
                                <span class="ajax-stock variation-stock variation_<?php echo implode( '_', $attr_string ); ?>">(<?php echo $stock['availability']; ?>)</span>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="ajax-stock">(<?php echo $product->get_max_purchase_quantity(); ?> <?php _e('in stock', \PS::$theme_name) ?>)</span>
                        <?php endif; ?>
                    </span>
                </div>
            <?php else: ?>
                <div class="product-right-out-stock">
                    <img src="<?php echo \PS::$assets_url; ?>images/icon28.svg" alt="">
                    <span><?php _e( 'Out of stock', \PS::$theme_name ); ?></span>
                </div>
            <?php endif; ?>

            <div class="product-right-name"><?php _e($product->get_name()); ?></div>

            <?php woocommerce_template_single_price(); ?>

            <?php woocommerce_template_single_add_to_cart(); ?>
            <a href="javascript:void(0)" class="product-right-favourite <?= in_array($product->get_id(), $favs) ? "selected" : '' ?>" data-product-id="<?= $product->get_id() ?>">
                <div class="product-right-favourite-icon">
                    <svg width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.325 1C3.83188 1 1 3.86955 1 7.40914C1 13.8183 8.475 19.6448 12.5 21C16.525 19.6448 24 13.8183 24 7.40914C24 3.86955 21.1681 1 17.675 1C15.536 1 13.6442 2.07615 12.5 3.7233C11.9168 2.88149 11.1419 2.19448 10.2411 1.72044C9.34032 1.24639 8.34005 0.999274 7.325 1Z" stroke="#424242" stroke-width="1.33177" stroke-linecap="round" stroke-linejoin="round" /></svg>
                </div>
                <div class="product-right-favourite-text"><?php _e( 'Add to favorite', \PS::$theme_name ); ?></div>
            </a>
<?php
/*
$current_url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if (strpos($current_url, 'onrial.eu/pl/') !== false) {
    // Показать текст для польской версии
    echo '<div class="product-right-name">';
    echo 'Na wszystko -20% przy zakupach min. 249 zł<br>';
    echo '-15% przy zakupach min. 149 zł<br>';
    echo 'Oferta ważna w dniach 15-29.12.2023';
    echo '</div>';
} else {
    // Показать текст для других версий
    echo '<div class="product-right-name">';
    echo 'On everything -20% when purchasing 129 euros <br>';
    echo '-15% when purchasing 99 euros<br> Offer valid from 15 to 29.12.2023';
    echo '</div>';
}
*/
?>
        </div>
    </div>
</div>
<div class="products-about-fluid">
    <div class="products-about-centered">
        <div class="products-about-tabs">
            <div class="tabs">
                <div class="tabs__nav">
                    <?php $description = get_field('description'); if($description): ?><div class="tabs__nav-btn" data-tab="#tab1"><span><?php _e( 'Description', \PS::$theme_name ); ?></span></div><?php endif; ?>
                    <?php $certificates = get_field('certificates'); if(is_array($certificates) && count($certificates)): ?><div class="tabs__nav-btn" data-tab="#tab2"><span><?php _e( 'Certificates', \PS::$theme_name ); ?></span></div><?php endif; ?>
                    <?php /*<div class="tabs__nav-btn" data-tab="#tab3"><span><?php _e( 'Reviews', \PS::$theme_name ); ?></span></div>*/ ?>
                </div>
            </div>
        </div>
        <div class="home-methods-right tabs__content">
            <?php if($description): ?>
                <div class="tabs__item" id="tab1">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>
            <?php if(is_array($certificates) && count($certificates)): ?>
                <div class="tabs__item" id="tab2">
                    <div class="product-about-sertificats">
                        <?php foreach ($certificates as $certificate): ?>
                            <a href="<?php echo $certificate['certificate']; ?>" class="product-about-sertificats-item" target="_blank">
                                <img src="<?php echo \PS::$assets_url; ?>images/icon26.svg" alt="">
                                <div class="product-about-sertificats-item-name"><?php echo $certificate['title']; ?></div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php /*<div class="tabs__item" id="tab3">
                <div class="product-reviews">
                    <div class="product-reviews-leave-btn  js-modal-link" data-target="review-popup">
                        <span>leave a review</span>
                        <img src="/images/arrow9.svg" alt="img">
                    </div>
                    <div class="product-reviews-container">
                        <div class="product-reviews-item">
                            <div class="product-reviews-item-left">
                                <div class="product-reviews-item-left-name">
                                    Olena
                                </div>
                                <div class="product-reviews-item-left-date">
                                    06/12/2022
                                </div>
                                <div class="product-reviews-item-left-stars">
                                    <div class="simple-rating">
                                        <div class="simple-rating__items">
                                            <input id="simple-rating__5" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="5">
                                            <label for="simple-rating__5" class="simple-rating__label"></label>
                                            <input id="simple-rating__4" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="4">
                                            <label for="simple-rating_4" class="simple-rating__label"></label>
                                            <input checked id="simple-rating__3" type="radio" class="simple-rating__item"
                                                   name="simple-rating" value="3">
                                            <label for="simple-rating__3" class="simple-rating__label"></label>
                                            <input id="simple-rating__2" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="2">
                                            <label for="simple-rating__2" class="simple-rating__label"></label>
                                            <input id="simple-rating__1" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="1">
                                            <label for="simple-rating__1" class="simple-rating__label"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-reviews-item-right">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur. Eu tristique id amet at congue sed enim. Facilisi aliquam
                                    purus quam maecenas cursus in dolor mi. Pharetra tellus faucibus amet posuere. Scelerisque magna
                                    risus
                                    tincidunt feugiat venenatis vel adipiscing magna eget. Convallis bibendum pharetra cursus sed est
                                    blandit id platea fames. Eu sit sed nulla molestie nibh dignissim tellus. In pharetra porttitor urna
                                    nullam. Sit orci diam ut quis. Augue at non et tempor tristique velit. Dui ac suspendisse dui
                                    vulputate. Metus orci cursus id sem semper massa ultricies tempus. Sapien viverra semper purus
                                    vitae.
                                    Mauris feugiat odio sit eu posuere mi.
                                </>
                            </div>
                        </div>
                        <div class="product-reviews-item">
                            <div class="product-reviews-item-left">
                                <div class="product-reviews-item-left-name">
                                    Olena
                                </div>
                                <div class="product-reviews-item-left-date">
                                    06/12/2022
                                </div>
                                <div class="product-reviews-item-left-stars">
                                    <div class="simple-rating">
                                        <div class="simple-rating__items">
                                            <input id="simple-rating__5" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="5">
                                            <label for="simple-rating__5" class="simple-rating__label"></label>
                                            <input id="simple-rating__4" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="4">
                                            <label for="simple-rating_4" class="simple-rating__label"></label>
                                            <input checked id="simple-rating__3" type="radio" class="simple-rating__item"
                                                   name="simple-rating" value="3">
                                            <label for="simple-rating__3" class="simple-rating__label"></label>
                                            <input id="simple-rating__2" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="2">
                                            <label for="simple-rating__2" class="simple-rating__label"></label>
                                            <input id="simple-rating__1" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="1">
                                            <label for="simple-rating__1" class="simple-rating__label"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-reviews-item-right">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur. Eu tristique id amet at congue sed enim. Facilisi aliquam
                                    purus quam maecenas cursus in dolor mi. Pharetra tellus faucibus amet posuere. Scelerisque magna
                                    risus
                                    tincidunt feugiat venenatis vel adipiscing magna eget. Convallis bibendum pharetra cursus sed est
                                    blandit id platea fames. Eu sit sed nulla molestie nibh dignissim tellus. In pharetra porttitor urna
                                    nullam. Sit orci diam ut quis. Augue at non et tempor tristique velit. Dui ac suspendisse dui
                                    vulputate. Metus orci cursus id sem semper massa ultricies tempus. Sapien viverra semper purus
                                    vitae.
                                    Mauris feugiat odio sit eu posuere mi.
                                </>
                            </div>
                        </div>
                        <div class="product-reviews-item">
                            <div class="product-reviews-item-left">
                                <div class="product-reviews-item-left-name">
                                    Olena
                                </div>
                                <div class="product-reviews-item-left-date">
                                    06/12/2022
                                </div>
                                <div class="product-reviews-item-left-stars">
                                    <div class="simple-rating">
                                        <div class="simple-rating__items">
                                            <input id="simple-rating__5" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="5">
                                            <label for="simple-rating__5" class="simple-rating__label"></label>
                                            <input id="simple-rating__4" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="4">
                                            <label for="simple-rating_4" class="simple-rating__label"></label>
                                            <input checked id="simple-rating__3" type="radio" class="simple-rating__item"
                                                   name="simple-rating" value="3">
                                            <label for="simple-rating__3" class="simple-rating__label"></label>
                                            <input id="simple-rating__2" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="2">
                                            <label for="simple-rating__2" class="simple-rating__label"></label>
                                            <input id="simple-rating__1" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="1">
                                            <label for="simple-rating__1" class="simple-rating__label"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-reviews-item-right">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur. Eu tristique id amet at congue sed enim. Facilisi aliquam
                                    purus quam maecenas cursus in dolor mi. Pharetra tellus faucibus amet posuere. Scelerisque magna
                                    risus
                                    tincidunt feugiat venenatis vel adipiscing magna eget. Convallis bibendum pharetra cursus sed est
                                    blandit id platea fames. Eu sit sed nulla molestie nibh dignissim tellus. In pharetra porttitor urna
                                    nullam. Sit orci diam ut quis. Augue at non et tempor tristique velit. Dui ac suspendisse dui
                                    vulputate. Metus orci cursus id sem semper massa ultricies tempus. Sapien viverra semper purus
                                    vitae.
                                    Mauris feugiat odio sit eu posuere mi.
                                </>
                            </div>
                        </div>
                        <div class="product-reviews-item">
                            <div class="product-reviews-item-left">
                                <div class="product-reviews-item-left-name">
                                    Olena
                                </div>
                                <div class="product-reviews-item-left-date">
                                    06/12/2022
                                </div>
                                <div class="product-reviews-item-left-stars">
                                    <div class="simple-rating">
                                        <div class="simple-rating__items">
                                            <input id="simple-rating__5" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="5">
                                            <label for="simple-rating__5" class="simple-rating__label"></label>
                                            <input id="simple-rating__4" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="4">
                                            <label for="simple-rating_4" class="simple-rating__label"></label>
                                            <input checked id="simple-rating__3" type="radio" class="simple-rating__item"
                                                   name="simple-rating" value="3">
                                            <label for="simple-rating__3" class="simple-rating__label"></label>
                                            <input id="simple-rating__2" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="2">
                                            <label for="simple-rating__2" class="simple-rating__label"></label>
                                            <input id="simple-rating__1" type="radio" class="simple-rating__item" name="simple-rating"
                                                   value="1">
                                            <label for="simple-rating__1" class="simple-rating__label"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-reviews-item-right">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur. Eu tristique id amet at congue sed enim. Facilisi aliquam
                                    purus quam maecenas cursus in dolor mi. Pharetra tellus faucibus amet posuere. Scelerisque magna
                                    risus
                                    tincidunt feugiat venenatis vel adipiscing magna eget. Convallis bibendum pharetra cursus sed est
                                    blandit id platea fames. Eu sit sed nulla molestie nibh dignissim tellus. In pharetra porttitor urna
                                    nullam. Sit orci diam ut quis. Augue at non et tempor tristique velit. Dui ac suspendisse dui
                                    vulputate. Metus orci cursus id sem semper massa ultricies tempus. Sapien viverra semper purus
                                    vitae.
                                    Mauris feugiat odio sit eu posuere mi.
                                </>
                            </div>
                        </div>
                    </div>
                </div>
            </div>*/ ?>
        </div>
    </div>
</div>

<?php woocommerce_output_related_products(); ?>