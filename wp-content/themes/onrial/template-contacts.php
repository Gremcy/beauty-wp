<?php /* Template Name: Contacts */ ?>
<?php get_header(); ?>

<body class="contacts-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="contacts-page">
        <div class="pagination">
            <ul class="pagination__list">
                <li class="pagination__item">
                    <a href="<?php echo get_the_permalink(\PS::$front_page); ?>"><?php echo get_the_title(\PS::$front_page); ?></a>
                </li>
                <li class="pagination__item">
                    <a href="javascript:void(0)"><?php echo get_the_title(); ?></a>
                </li>
            </ul>
        </div>

        <section class="contacts">
            <div class="contacts__container">
                <div class="contacts__wrapper">
                    <div class="contacts__inner">
                        <?php $title_1 = get_field('title_1'); if($title_1): ?><h1><?php echo $title_1; ?></h1><?php endif; ?>
                        <?php $text_1 = get_field('text_1'); if($text_1): ?><p class="contacts__subtitle"><?php echo $text_1; ?></p><?php endif; ?>
                        <?php $address = get_field('address'); if($address): ?><p class="contacts__subtitle-secondary"><?php echo $address; ?></p><?php endif; ?>
                    </div>
                    <ul class="social__list">
                        <?php $in = get_field('in'); if($in): ?>
                            <li class="social__item">
                                <a href="<?php echo $in; ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 55 55"><path d="M27.5 32.313c-2.578 0-4.813-2.063-4.813-4.813 0-2.578 2.063-4.813 4.813-4.813 2.578 0 4.813 2.063 4.813 4.813 0 2.578-2.235 4.813-4.813 4.813Z"/><path fill-rule="evenodd" d="M33.344 15.813H21.656c-1.375.171-2.062.343-2.578.515-.687.172-1.203.516-1.719 1.031-.408.408-.6.816-.833 1.31-.062.13-.126.266-.198.41-.026.079-.057.163-.09.253a6.066 6.066 0 0 0-.425 2.324v11.688c.171 1.375.343 2.062.515 2.578.172.687.516 1.203 1.031 1.719.408.408.816.6 1.31.833.13.062.266.126.41.198.079.027.163.057.253.09.49.18 1.162.425 2.324.425h11.688c1.375-.171 2.062-.343 2.578-.515.687-.172 1.203-.516 1.719-1.031.408-.408.6-.816.833-1.31.062-.13.126-.266.198-.41.027-.079.057-.163.09-.253.18-.49.425-1.162.425-2.324V21.656c-.171-1.375-.343-2.062-.515-2.578-.172-.687-.516-1.203-1.031-1.719-.408-.408-.816-.6-1.31-.833-.13-.062-.266-.126-.41-.198a9.457 9.457 0 0 1-.253-.09 6.066 6.066 0 0 0-2.324-.425ZM27.5 20.108c-4.125 0-7.39 3.266-7.39 7.391s3.265 7.39 7.39 7.39 7.39-3.265 7.39-7.39-3.265-7.39-7.39-7.39Zm9.281-.172a1.719 1.719 0 1 1-3.437 0 1.719 1.719 0 0 1 3.437 0Z" clip-rule="evenodd"/><path fill-rule="evenodd" d="M0 27.5C0 12.312 12.312 0 27.5 0S55 12.312 55 27.5 42.688 55 27.5 55 0 42.688 0 27.5Zm21.656-14.266h11.688c1.547.172 2.578.344 3.437.688 1.032.515 1.719.86 2.578 1.719.86.859 1.375 1.718 1.72 2.578.343.86.687 1.89.687 3.437v11.688c-.172 1.547-.344 2.578-.688 3.437-.516 1.032-.86 1.719-1.719 2.578-.859.86-1.718 1.375-2.578 1.72-.86.343-1.89.687-3.437.687H21.656c-1.547-.172-2.578-.344-3.437-.688-1.032-.516-1.719-.86-2.578-1.719-.86-.859-1.375-1.718-1.72-2.578-.343-.86-.687-1.89-.687-3.437V21.656c.172-1.547.344-2.578.688-3.437.515-1.032.86-1.719 1.719-2.578.859-.86 1.718-1.375 2.578-1.72.86-.343 1.89-.687 3.437-.687Z" clip-rule="evenodd"/></svg>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php $fb = get_field('fb'); if($fb): ?>
                            <li class="social__item">
                                <a href="<?php echo $fb; ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 40 40"><path fill-rule="evenodd" d="M0 20C0 8.954 8.954 0 20 0s20 8.954 20 20-8.954 20-20 20S0 31.046 0 20Zm20-10c5.5 0 10 4.5 10 10 0 5-3.625 9.25-8.625 10v-7.125h2.375l.5-2.875H21.5v-1.875c0-.75.375-1.5 1.625-1.5h1.25v-2.5s-1.125-.25-2.25-.25c-2.25 0-3.75 1.375-3.75 3.875V20h-2.5v2.875h2.5v7C13.625 29.125 10 25 10 20c0-5.5 4.5-10 10-10Z" clip-rule="evenodd"/></svg>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php $yt = get_field('yt'); if($yt): ?>
                            <li class="social__item">
                                <a href="<?php echo $yt; ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 40 40"><path d="M23.25 20 18 17v6l5.25-3Z" /><path fill-rule="evenodd" d="M0 20C0 8.954 8.954 0 20 0s20 8.954 20 20-8.954 20-20 20S0 31.046 0 20Zm27.75-6.625c.875.25 1.5.875 1.75 1.75C30 16.75 30 20 30 20s0 3.25-.375 4.875c-.25.875-.875 1.5-1.75 1.75C26.25 27 20 27 20 27s-6.375 0-7.875-.375a2.476 2.476 0 0 1-1.75-1.75C10 23.25 10 20 10 20s0-3.25.25-4.875c.25-.875.875-1.5 1.75-1.75C13.625 13 19.875 13 19.875 13s6.375 0 7.875.375Z" clip-rule="evenodd"/></svg>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <?php if(get_field('active_2')): ?>
                    <?php get_template_part('parts/forms/contact-us', null, ['page' => 'contacts']); ?>

                    <div class="contacts__thanks">
                        <img src="<?php echo \PS::$assets_url; ?>images/partnership-page/partnership__icon.png" alt="" class="contacts__icon"/>
                        <?php $form_letter_success_title = get_field('form_letter_success_title', \PS::$option_page); if($form_letter_success_title): ?>
                            <p class="contacts__title"><?php echo __($form_letter_success_title); ?></p>
                        <?php endif; ?>
                        <?php $form_letter_success_text = get_field('form_letter_success_text', \PS::$option_page); if($form_letter_success_text): ?>
                            <p class="contacts__description"><?php echo __($form_letter_success_text); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php get_template_part('parts/_footer'); ?>

    <?php get_template_part('parts/_popups'); ?>

    <?php /* DON'T REMOVE THIS */ ?>
    <?php get_footer(); ?>
    <?php /* END */ ?>

    <?php /* WRITE SCRIPTS HERE */ ?>

    <?php /* END */ ?>

</body>
</html>