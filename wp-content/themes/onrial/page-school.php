<?php get_header(); ?>

<?php $section = get_query_var('section'); ?>

<body class="<?php if($section === 'instructors'): ?>instructors-page<?php else: ?>school-page<?php endif; ?>">
    <?php get_template_part('parts/_header'); ?>

    <main class="<?php if($section === 'instructors'): ?>instructors-main<?php else: ?>school-main<?php endif; ?>">
        <div class="pagination">
            <ul class="pagination__list">
                <li class="pagination__item">
                    <a href="<?php echo get_the_permalink(\PS::$front_page); ?>"><?php echo get_the_title(\PS::$front_page); ?></a>
                </li>
                <li class="pagination__item">
                    <a href="<?php if($section): ?><?php echo get_the_permalink(); ?><?php else: ?>javascript:void(0)<?php endif; ?>"><?php echo get_the_title(); ?></a>
                </li>
                <?php if($section): ?>
                    <li class="pagination__item">
                        <a href="javascript:void(0)"><?php echo get_field('title_' . ($section === 'masters' ? 1 : 2)); ?></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="school-first-fluid">
            <div class="school-first-centered">
                <div class="school-first-container">
                    <?php for ($n = 1; $n <= 2; $n++): ?>
                        <?php if(get_field('active_' . $n)): ?>
                            <a href="<?php echo \PS\Functions\Plugins\Qtranslate::current_site_url('/school/' . ($n === 1 ? 'masters' : 'instructors') . '/'); ?>" class="school-first-item<?php if($n === 1 && $section === 'masters' || $n === 2 && $section === 'instructors'): ?> active<?php endif; ?>">
                                <?php $img = get_field('img_' . $n); if(is_array($img) && count($img)): ?>
                                    <div class="school-first-item-images">
                                        <img src="<?php echo $img['sizes']['960x0']; ?>" alt="">
                                    </div>
                                <?php endif; ?>
                                <div class="school-first-item-bottom">
                                    <span><?php echo get_field('title_' . $n); ?></span>
                                    <img src="<?php echo \PS::$assets_url; ?>images/icon19.svg" alt="">
                                </div>
                            </a>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <?php if($section): ?>
            <?php get_template_part('parts/school/' . $section); ?>
        <?php endif; ?>

        <?php if(get_field('active_3')): ?>
            <div class="registration-sales-news-fluid">
                <div class="registration-sales-news-centered">
                    <?php $title_3 = get_field('title_3'); if($title_3): ?>
                        <div class="registration-sales-news-left"><?php echo $title_3; ?></div>
                    <?php endif; ?>

                    <?php get_template_part('parts/forms/questions'); ?>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <?php get_template_part('parts/_footer'); ?>

    <?php get_template_part('parts/_popups'); ?>

    <?php if(get_field('active_3')): ?>
        <div class="modal modal--sm js-modal" data-modal="letter-thanks-popup">
            <div class="modal__overlay js-close-modal"></div>
            <div class="thanks-popup-content">
                <div class="fill-out-form-close js-close-modal">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_491_6576)"><path fill-rule="evenodd" clip-rule="evenodd" d="M24.5424 24.5589C23.932 25.1696 22.942 25.1698 22.3314 24.5594C22.3312 24.5592 22.3311 24.5591 22.3309 24.5589L12.4872 14.7152L2.65248 24.5504C2.03855 25.1578 1.04845 25.1526 0.441031 24.5386C-0.161837 23.9293 -0.16182 22.9482 0.44107 22.3389L10.2761 12.504L0.442866 2.67081C-0.158909 2.05141 -0.144619 1.06145 0.474782 0.459676C1.0815 -0.129778 2.04698 -0.129863 2.65381 0.459483L12.4874 10.2926L22.3292 0.450888C22.9318 -0.167737 23.9217 -0.180748 24.5404 0.421825C25.159 1.0244 25.172 2.01437 24.5694 2.633C24.5598 2.64289 24.55 2.65266 24.5401 2.66229L14.6989 12.504L24.5426 22.3478C25.1532 22.9582 25.1532 23.948 24.5428 24.5586C24.5426 24.5587 24.5425 24.5588 24.5424 24.5589L24.5424 24.5589Z" fill="#CB94D3" /></g><defs><clipPath id="clip0_491_6576"><rect width="25" height="25" fill="white" /></clipPath></defs></svg>
                </div>
                <div class="thanks-popup-icon">
                    <img src="<?php echo \PS::$assets_url; ?>images/check-icon.svg" alt="">
                </div>
                <?php $form_letter_success_title = get_field('form_letter_success_title', \PS::$option_page); if($form_letter_success_title): ?>
                    <div class="thanks-popup-title"><?php echo __($form_letter_success_title); ?></div>
                <?php endif; ?>
                <?php $form_letter_success_text = get_field('form_letter_success_text', \PS::$option_page); if($form_letter_success_text): ?>
                    <div class="thanks-popup-description"><?php echo __($form_letter_success_text); ?></div>
                <?php endif; ?>
                <a href="<?php echo get_the_permalink(\PS::$shop_page); ?>" class="thanks-popup-btn"><?php _e( 'Go to catalog', \PS::$theme_name ); ?></a>
            </div>
        </div>
    <?php endif; ?>

    <?php if($section === 'masters'): ?>
        <?php
        global $wp_query;
        \PS\Functions\Helper\Helper::get_school('masters');
        $custom_query = $wp_query;
        ?>
        <?php if ( $custom_query->have_posts() ): ?>
            <?php while ( $custom_query->have_posts() ): $custom_query->the_post(); ?>
                <?php $skills = get_field('skills'); if(is_array($skills) && count($skills)): ?>
                    <?php foreach ($skills as $n => $skill): ?>
                        <?php if($skill['text_1'] || $skill['text_2']): ?>
                            <div class="modal modal--sm js-modal" data-modal="training-popup-<?php echo get_the_ID(); ?>-<?php echo $n; ?>">
                                <div class="modal__overlay js-close-modal"></div>
                                <div class="training-popup-content">
                                    <div class="training-popup-close js-close-modal">
                                        <img src="<?php echo \PS::$assets_url; ?>images/icon21.svg" alt="">
                                    </div>
                                    <div class="training-popup-content-top">
                                        <div class="training-popup-title"><?php echo $skill['title']; ?></div>
                                        <div class="training-popup-container-tabs">
                                            <?php if($skill['text_1']): ?>
                                                <div class="training-popup-container-tabs-item tab-individual active"><?php _e( 'Individual training', \PS::$theme_name ); ?></div>
                                            <?php endif; ?>
                                            <?php if($skill['text_2']): ?>
                                                <div class="training-popup-container-tabs-item tab-school<?php if(!$skill['text_1']): ?> active<?php endif; ?>"><?php _e( 'Course plan', \PS::$theme_name ); ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="training-popup-container">
                                            <?php if($skill['text_1']): ?>
                                                <div class="training-popup-individual-block show"><?php echo $skill['text_1']; ?></div>
                                            <?php endif; ?>
                                            <?php if($skill['text_2']): ?>
                                                <div class="training-popup-school-block<?php if(!$skill['text_1']): ?> show<?php endif; ?>"><?php echo $skill['text_2']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="training-popup-content-bottom">
                                        <div class="training-popup-content-bottom-btn js-modal-link school-signup" data-course="<?php echo $skill['title']; ?>" data-master="<?php echo get_the_title(); ?>" data-target="questionary-popup"><?php _e( 'Sign up', \PS::$theme_name ); ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    <?php endif; ?>
    
    <?php
    global $wp_query;
    \PS\Functions\Helper\Helper::get_school('instructors');
    $custom_query = $wp_query;
    ?>
    <?php if ( $custom_query->have_posts() ): ?>
        <?php while ( $custom_query->have_posts() ): $custom_query->the_post(); ?>
            <div class="modal modal--sm js-modal" data-modal="training-popup-<?php echo get_the_ID(); ?>">
                <div class="modal__overlay js-close-modal"></div>
                <div class="training-popup-content">
                    <div class="training-popup-close js-close-modal">
                        <img src="<?php echo \PS::$assets_url; ?>images/icon21.svg" alt="">
                    </div>
                    <div class="training-popup-content-top">
                        <div class="training-popup-title"><?php echo get_the_title(); ?></div>
                        <div class="training-popup-container-tabs">
                            <?php $text_1 = get_field('text_1'); if($text_1): ?>
                                <div class="training-popup-container-tabs-item tab-individual active"><?php _e( 'Individual training', \PS::$theme_name ); ?></div>
                            <?php endif; ?>
                            <?php $text_2 = get_field('text_2'); if($text_2): ?>
                                <div class="training-popup-container-tabs-item tab-school<?php if(!$text_1): ?> active<?php endif; ?>"><?php _e( 'Course plan', \PS::$theme_name ); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="training-popup-container">
                            <?php if($text_1): ?>
                                <div class="training-popup-individual-block show"><?php echo $text_1; ?></div>
                            <?php endif; ?>
                            <?php if($text_2): ?>
                                <div class="training-popup-school-block<?php if(!$text_1): ?> show<?php endif; ?>"><?php echo $text_2; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="training-popup-content-bottom">
                        <div class="training-popup-content-bottom-btn js-modal-link school-signup" data-course="<?php echo get_the_title(); ?>" data-master="" data-target="questionary-popup"><?php _e( 'Sign up', \PS::$theme_name ); ?></div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_query(); ?>

    <div class="modal modal--sm js-modal" data-modal="questionary-popup">
        <div class="modal__overlay js-close-modal"></div>
        <div class="fill-out-form-content">
            <div class="fill-out-form-close js-close-modal">
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_491_6576)"><path fill-rule="evenodd" clip-rule="evenodd" d="M24.5424 24.5589C23.932 25.1696 22.942 25.1698 22.3314 24.5594C22.3312 24.5592 22.3311 24.5591 22.3309 24.5589L12.4872 14.7152L2.65248 24.5504C2.03855 25.1578 1.04845 25.1526 0.441031 24.5386C-0.161837 23.9293 -0.16182 22.9482 0.44107 22.3389L10.2761 12.504L0.442866 2.67081C-0.158909 2.05141 -0.144619 1.06145 0.474782 0.459676C1.0815 -0.129778 2.04698 -0.129863 2.65381 0.459483L12.4874 10.2926L22.3292 0.450888C22.9318 -0.167737 23.9217 -0.180748 24.5404 0.421825C25.159 1.0244 25.172 2.01437 24.5694 2.633C24.5598 2.64289 24.55 2.65266 24.5401 2.66229L14.6989 12.504L24.5426 22.3478C25.1532 22.9582 25.1532 23.948 24.5428 24.5586C24.5426 24.5587 24.5425 24.5588 24.5424 24.5589L24.5424 24.5589Z" fill="#CB94D3" /></g><defs><clipPath id="clip0_491_6576"><rect width="25" height="25" fill="white" /></clipPath></defs></svg>
            </div>
            <?php get_template_part('parts/forms/questionnare'); ?>
        </div>
    </div>

    <div class="modal modal--sm js-modal" data-modal="questionnaire-thanks-popup">
        <div class="modal__overlay js-close-modal"></div>
        <div class="thanks-popup-content">
            <div class="fill-out-form-close js-close-modal">
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_491_6576)"><path fill-rule="evenodd" clip-rule="evenodd" d="M24.5424 24.5589C23.932 25.1696 22.942 25.1698 22.3314 24.5594C22.3312 24.5592 22.3311 24.5591 22.3309 24.5589L12.4872 14.7152L2.65248 24.5504C2.03855 25.1578 1.04845 25.1526 0.441031 24.5386C-0.161837 23.9293 -0.16182 22.9482 0.44107 22.3389L10.2761 12.504L0.442866 2.67081C-0.158909 2.05141 -0.144619 1.06145 0.474782 0.459676C1.0815 -0.129778 2.04698 -0.129863 2.65381 0.459483L12.4874 10.2926L22.3292 0.450888C22.9318 -0.167737 23.9217 -0.180748 24.5404 0.421825C25.159 1.0244 25.172 2.01437 24.5694 2.633C24.5598 2.64289 24.55 2.65266 24.5401 2.66229L14.6989 12.504L24.5426 22.3478C25.1532 22.9582 25.1532 23.948 24.5428 24.5586C24.5426 24.5587 24.5425 24.5588 24.5424 24.5589L24.5424 24.5589Z" fill="#CB94D3" /></g><defs><clipPath id="clip0_491_6576"><rect width="25" height="25" fill="white" /></clipPath></defs></svg>
            </div>
            <div class="thanks-popup-icon">
                <img src="<?php echo \PS::$assets_url; ?>images/check-icon.svg" alt="">
            </div>
            <?php $form_questionnaire_success_title = get_field('form_questionnaire_success_title', \PS::$option_page); if($form_questionnaire_success_title): ?>
                <div class="thanks-popup-title"><?php echo __($form_questionnaire_success_title); ?></div>
            <?php endif; ?>
            <?php $form_questionnaire_success_text = get_field('form_questionnaire_success_text', \PS::$option_page); if($form_questionnaire_success_text): ?>
                <div class="thanks-popup-description"><?php echo __($form_questionnaire_success_text); ?></div>
            <?php endif; ?>
            <a href="<?php echo get_the_permalink(\PS::$shop_page); ?>" class="thanks-popup-btn"><?php _e( 'Go to catalog', \PS::$theme_name ); ?></a>
        </div>
    </div>

    <?php /* DON'T REMOVE THIS */ ?>
    <?php get_footer(); ?>
    <?php /* END */ ?>

    <?php /* WRITE SCRIPTS HERE */ ?>
    <?php if($section): ?>
        <script>
            // scroll
            $(document).ready(function (){
                $('html, body').animate({
                    scrollTop: $(".school-first-fluid").offset().top - $('header').outerHeight() + $('.school-first-centered').outerHeight()
                }, 1000);
            });
        </script>
    <?php endif; ?>

    <script>
        // filtering
        $(document).on('change', '.change-region', function (){
            var region = $(this).val();
            if(region){
                $('.school-instrucrors-item, .nothing-found').hide();
                if($('.school-instrucrors-item[data-region="' + region + '"]').length){
                    $('.school-instrucrors-item[data-region="' + region + '"]').show();
                }else{
                    $('.nothing-found').show();
                }
            }else{
                $('.nothing-found').hide();
                if($('.school-instrucrors-item').length){
                    $('.school-instrucrors-item').show();
                }else{
                    $('.nothing-found').show();
                }
            }

            // map
            $('.school-map-region').removeClass('select');
            if(region){
                $('.school-map-region[data-region="' + region + '"]').addClass('select');
            }
        });

        $(document).on('click', '.school-map-region', function (){
            var region = $(this).data('region');
            if(region){
                $('.change-region').val(region).trigger('change');

                $('html, body').animate({
                    scrollTop: $(".school-instrucrors-fluid").offset().top - $('header').outerHeight()
                }, 1000);
            }
        });
    </script>

    <script>
        // form
        $(document).on('click', '.school-signup', function (){
            var text = '';
            var course = $(this).data('course');
            var master = $(this).data('master');
            if(course){
                text += course;
            }
            if(master){
                text += (' / ' + master);
            }
            $('.questionnaire-form [name="master"]').val(text);
        });
    </script>
    <?php /* END */ ?>

</body>
</html>