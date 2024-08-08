<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {
    if(is_singular('product')){
        $parent = 0;
        $list = [];
        $categories = get_the_terms( get_the_ID(), 'product_cat' ); if(is_array($categories) && count($categories)){
            foreach ( $categories as $m => $category ) {
                if($category->parent === $parent){
                    $list[] = $category;

                    $parent = $category->term_id;
                    unset($categories[$m]);
                }
            }
            if(is_array($categories) && count($categories)){
                foreach ( $categories as $m => $category ) {
                    if($category->parent === $parent){
                        $list[] = $category;

                        $parent = $category->term_id;
                        unset($categories[$m]);
                    }
                }
            }
            if(is_array($categories) && count($categories)){
                foreach ( $categories as $m => $category ) {
                    if($category->parent === $parent){
                        $list[] = $category;

                        $parent = $category->term_id;
                        unset($categories[$m]);
                    }
                }
            }

            foreach ($list as $li){
                echo '<li class="pagination__item"><a href="' . get_term_link( $li->term_id ) . '">' . esc_html( $li->name ) . '</a></li>';
            }
        }

        /*array_pop($breadcrumb);
        foreach ( $breadcrumb as $key => $crumb ) {
            echo '<li class="pagination__item"><a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a></li>';
        }*/
    }else{
        foreach ( $breadcrumb as $key => $crumb ) {
            if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
                echo '<li class="pagination__item"><a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a></li>';
            } else {
                echo '<li class="pagination__item"><a href="javascript:void(0)">' . esc_html( $crumb[0] ) . '</a></li>';
            }
        }
    }
}
