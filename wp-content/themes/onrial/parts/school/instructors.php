<?php if (!defined('ABSPATH')){exit;} ?>

<div class="instructors-second-fluid">
    <div class="instructors-second-centered">
        <?php $title_2_2 = get_field('title_2_2'); if($title_2_2): ?>
            <div class="instructors-second-title"><?php echo str_ireplace('ONRIAL', '<span>ONRIAL</span>', $title_2_2); ?></div>
        <?php endif; ?>
        <?php $text_2_2 = get_field('text_2_2'); if($text_2_2): ?>
            <div class="instructors-second-paragraph"><?php echo $text_2_2; ?></div>
        <?php endif; ?>
    </div>
</div>

<?php
global $wp_query;
\PS\Functions\Helper\Helper::get_school('instructors', 'instructors');
$custom_query = $wp_query;
?>
<?php if ( $custom_query->have_posts() ): ?>
    <div class="instructors-third-fluid">
        <div class="instructors-third-centered">
            <?php $title_2_3 = get_field('title_2_3'); if($title_2_3): ?>
                <div class="instructors-third-title"><?php echo $title_2_3; ?></div>
            <?php endif; ?>
            <div class="instructors-third-container">
                <?php while ( $custom_query->have_posts() ): $custom_query->the_post(); ?>
                    <div class="instructors-third-item js-modal-link" data-target="training-popup-<?php echo get_the_ID(); ?>">
                        <?php $img = get_field('img'); if(is_array($img) && count($img)): ?>
                            <div class="instructors-third-item-image">
                                <img src="<?php echo $img['sizes']['960x0']; ?>" alt="">
                            </div>
                        <?php endif; ?>
                        <div class="instructors-third-item-down">
                            <div class="instructors-third-item-down-name"><?php echo get_the_title(); ?></div>
                            <div class="instructors-third-item-down-arrow">
                                <img src="<?php echo \PS::$assets_url; ?>images/arrow7.svg" alt="">
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php wp_reset_query(); ?>

<?php $speakers_2_4 = get_field('speakers_2_4'); if(is_array($speakers_2_4) && count($speakers_2_4)): ?>
    <?php foreach ($speakers_2_4 as $block): ?>
        <div class="instructors-speakers-fluid">
            <div class="instructors-speakers-centered">
                <?php if($block['title']): ?>
                    <div class="instructors-speakers-title"><?php echo $block['title']; ?></div>
                <?php endif; ?>
                <div class="instructors-speakers-content">
                    <?php if(is_array($block['img']) && count($block['img'])): ?>
                        <div class="instructors-speakers-content-left">
                            <img src="<?php echo $block['img']['sizes']['960x0']; ?>" alt="">
                        </div>
                    <?php endif; ?>
                    <?php if(is_array($block['list']) && count($block['list'])): ?>
                        <div class="instructors-speakers-content-right">
                            <ul>
                                <?php foreach ($block['list'] as $li): ?>
                                    <li><?php echo $li['text']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<div class="instructors-how-fluid">
    <div class="instructors-how-centered">
        <?php $title_2_5 = get_field('title_2_5'); if($title_2_5): ?>
            <div class="instructors-how-title"><?php echo $title_2_5; ?></div>
        <?php endif; ?>
        <div class="instructors-how-content">
            <?php $list_2_5 = get_field('list_2_5'); if(is_array($list_2_5) && count($list_2_5)): ?>
                <div class="instructors-how-content-left">
                    <?php foreach ($list_2_5 as $n => $li): ?>
                        <div class="instructors-how-content-left-item">
                            <div class="instructors-how-content-left-item-num"><?php echo $n + 1; ?></div>
                            <div class="instructors-how-content-left-item-<?php if($n === 0): ?>link<?php else: ?>name<?php endif; ?><?php if($n === 0): ?> js-modal-link<?php endif; ?>"<?php if($n === 0): ?> data-target="questionary-popup"<?php endif; ?>>
                                <div class="instructors-how-content-left-item-name"><?php echo $li['text']; ?></div>
                                <?php if($n === 0): ?>
                                    <div class="instructors-how-content-left-item-arr">
                                        <img src="<?php echo \PS::$assets_url; ?>images/arrow8.svg" alt="">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php $img_2_5 = get_field('img_2_5'); if(is_array($img_2_5) && count($img_2_5)): ?>
                <div class="instructors-how-content-right">
                    <img src="<?php echo $img_2_5['sizes']['960x0']; ?>" alt="">
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>