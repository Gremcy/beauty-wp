<?php get_header(); ?>

<body class="product-page">
	<?php get_template_part('parts/_header'); ?>

	<main class="product-main">
		<div class="pagination">
			<ul class="pagination__list">
				<li class="pagination__item">
					<a href="<?php echo get_the_permalink(\PS::$front_page); ?>"><?php echo get_the_title(\PS::$front_page); ?></a>
				</li>
				<li class="pagination__item">
					<a href="<?php echo get_the_permalink(\PS::$shop_page); ?>"><?php echo get_the_title(\PS::$shop_page); ?></a>
				</li>
				<?php woocommerce_breadcrumb(array(
					'home' => false
				)); ?>
			</ul>
		</div>

        <?php woocommerce_output_all_notices(); ?>

        <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>
            <?php wc_get_template_part( 'content', 'single-product' ); ?>
        <?php endwhile; ?>
	</main>

	<?php get_template_part('parts/_footer'); ?>

	<?php get_template_part('parts/_popups'); ?>

    <?php /*
    <div class="modal modal--sm js-modal" data-modal="review-popup">
        <div class="modal__overlay js-close-modal"></div>

        <div class="fill-out-form-content">
            <div class="fill-out-form-close js-close-modal">
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_491_6576)">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M24.5424 24.5589C23.932 25.1696 22.942 25.1698 22.3314 24.5594C22.3312 24.5592 22.3311 24.5591 22.3309 24.5589L12.4872 14.7152L2.65248 24.5504C2.03855 25.1578 1.04845 25.1526 0.441031 24.5386C-0.161837 23.9293 -0.16182 22.9482 0.44107 22.3389L10.2761 12.504L0.442866 2.67081C-0.158909 2.05141 -0.144619 1.06145 0.474782 0.459676C1.0815 -0.129778 2.04698 -0.129863 2.65381 0.459483L12.4874 10.2926L22.3292 0.450888C22.9318 -0.167737 23.9217 -0.180748 24.5404 0.421825C25.159 1.0244 25.172 2.01437 24.5694 2.633C24.5598 2.64289 24.55 2.65266 24.5401 2.66229L14.6989 12.504L24.5426 22.3478C25.1532 22.9582 25.1532 23.948 24.5428 24.5586C24.5426 24.5587 24.5425 24.5588 24.5424 24.5589L24.5424 24.5589Z"
                              fill="#CB94D3" />
                    </g>
                    <defs>
                        <clipPath id="clip0_491_6576">
                            <rect width="25" height="25" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </div>

            <form action="#" class="fill-out-form">
                <div class="fill-out-form-title">
                    LEAVE A REVIEW
                </div>
                <div class="fill-out-form-input error">
                    <input type="text" placeholder="Name">
                    <div class="error-text">Fill in the field</div>
                </div>
                <div class="fill-out-form-input">
                    <input type="text" placeholder="Your E-mail">
                    <div class="error-text">Fill in the field</div>
                </div>
                <div class="rating-title">
                    your mark
                </div>
                <div class="simple-rating">
                    <div class="simple-rating__items">
                        <input id="simple-rating__5" type="radio" class="simple-rating__item" name="simple-rating" value="5">
                        <label for="simple-rating__5" class="simple-rating__label"></label>
                        <input id="simple-rating__4" type="radio" class="simple-rating__item" name="simple-rating" value="4">
                        <label for="simple-rating_4" class="simple-rating__label"></label>
                        <input id="simple-rating__3" type="radio" class="simple-rating__item" name="simple-rating" value="3">
                        <label for="simple-rating__3" class="simple-rating__label"></label>
                        <input id="simple-rating__2" type="radio" class="simple-rating__item" name="simple-rating" value="2">
                        <label for="simple-rating__2" class="simple-rating__label"></label>
                        <input id="simple-rating__1" type="radio" class="simple-rating__item" name="simple-rating" value="1">
                        <label for="simple-rating__1" class="simple-rating__label"></label>
                    </div>
                </div>
                <div class="review-popup-comment">
                    <div class="review-popup-comment-title">
                        add comment
                    </div>
                    <div class="review-popup-comment-textarea">
                        <textarea name="review-text"></textarea>
                    </div>
                </div>
                <button type="submit" class="fill-out-form-btn">
                    send
                </button>
            </form>

        </div>
    </div>
    */ ?>

	<?php /* DON'T REMOVE THIS */ ?>
	<?php get_footer(); ?>
	<?php /* END */ ?>

	<?php /* WRITE SCRIPTS HERE */ ?>
    <script>
        $(document).ready(function (){
            // product Gallery and Zoom
            var galleryThumbs = new Swiper('.gallery-thumbs', {
                spaceBetween: 20,
                freeMode: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                breakpoints: {
                    0: {
                        slidesPerView: 4,
                    },
                    992: {
                        slidesPerView: 4,
                    }
                }
            });
            var galleryTop = new Swiper('.gallery-top', {
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                thumbs: {
                    swiper: galleryThumbs
                },
            });
        });
    </script>
	<?php /* END */ ?>

</body>
</html>