<?php
/**
 * LSVR Knowledge Base KBA Tree walker
 */
if ( ! class_exists( 'Lsvr_Knowledge_Base_KBA_Tree_Walker' ) && class_exists( 'Walker_Category' ) ) {
class Lsvr_Knowledge_Base_KBA_Tree_Walker extends Walker_Category {

    function start_lvl( &$output, $depth = 0, $args = [] ) {
        $output .= '<ul class="lsvr_kba-tree-widget__list lsvr_kba-tree-widget__list--category lsvr_kba-tree-widget__list--level-' . esc_attr( (int) $depth + 1 ) . '">';
    }

    function end_lvl( &$output, $depth = 0, $args = [] ) {
        $output .= '</ul>';
    }

    function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {

    	$class_arr = array( 'lsvr_kba-tree-widget__item', 'lsvr_kba-tree-widget__item--category', 'lsvr_kba-tree-widget__item--level-' . $depth );
        $category_meta = get_option( 'lsvr_kba_cat_term_' . $item->term_id . '_meta' );
        $category_icon_class = ! empty( $category_meta['icon'] ) ? $category_meta['icon'] : 'lsvr_kba-tree-widget__item-icon--default';

        if ( is_tax( 'lsvr_kba_cat' ) && $item->term_id === get_queried_object()->term_id ) {
        	array_push( $class_arr, 'lsvr_kba-tree-widget__item--current' );
        }

        if ( ! empty( $args['current_post_cat'] ) && $item->term_id === $args['current_post_cat'] ) {
        	array_push( $class_arr, 'lsvr_kba-tree-widget__item--current-post-category' );
        }

        ob_start(); ?>

        <li class="<?php echo esc_attr( implode( ' ', $class_arr ) ); ?>">
            <div class="lsvr_kba-tree-widget__item-inner">

            	<div class="lsvr_kba-tree-widget__item-link-wrapper">

	                <i class="lsvr_kba-tree-widget__item-icon <?php echo esc_attr( $category_icon_class ); ?>"></i>

	                <a href="<?php echo esc_url( get_term_link( $item ) ); ?>"
	                	class="lsvr_kba-tree-widget__item-link lsvr_kba-tree-widget__item-link--category lsvr_kba-tree-widget__item-link--level-<?php echo esc_attr( $depth ); ?>"><?php echo esc_attr( $item->name ); ?></a>

	                <?php if ( ! empty( $args['show_count'] ) && true === $args['show_count'] ) : ?>
	                    <span class="lsvr_kba-tree-widget__item-count">(<?php echo (int) $item->count; ?>)</span>
	                <?php endif; ?>

            	</div>

            </div>

        <?php $output .= ob_get_clean();

    }

    function end_el( &$output, $item, $depth = 0, $args = [] ) {

        // Post list
        if ( ! empty( $args['show_posts'] ) && true === $args['show_posts'] ) {

            // Post query args
            $post_query_args = array(
                'post_type' => 'lsvr_kba',
                'numberposts' => 1000,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'lsvr_kba_cat',
                        'field' => 'id',
                        'terms' => $item->term_id,
                        'include_children' => false,
                    ),
                ),
            );

            // Merge with passed arguments from the widget
            if ( ! empty( $args['post_query_args'] ) ) {
                $post_query_args = array_merge( $post_query_args, $args['post_query_args'] );
            }

            $posts = get_posts( $post_query_args );

            ob_start(); ?>

            <?php if ( ! empty( $posts ) ) : ?>

                <ul class="lsvr_kba-tree-widget__list lsvr_kba-tree-widget__list--post lsvr_kba-tree-widget__list--level-<?php echo esc_attr( (int) $depth + 1 ); ?>">

                    <?php foreach ( $posts as $post ) :

						$class_arr = array( 'lsvr_kba-tree-widget__item', 'lsvr_kba-tree-widget__item--post', 'lsvr_kba-tree-widget__item--level-' . ( (int) $depth + 1 ) );

						if ( is_singular( 'lsvr_kba') && ! empty( $args['current_post_id'] ) && $args['current_post_id'] === $post->ID ) {
							array_push( $class_arr, 'lsvr_kba-tree-widget__item--current' );
						}

                    	?>

                        <li class="<?php echo esc_attr( implode( ' ', $class_arr ) ); ?>">
                            <div class="lsvr_kba-tree-widget__item-inner">

                                <div class="lsvr_kba-tree-widget__item-link-wrapper">

									<?php if ( ! empty( get_post_format( $post->ID ) ) ) : ?>

										<i class="lsvr_kba-tree-widget__item-icon c-lsvr_kba-format-icon c-lsvr_kba-format-icon--<?php echo esc_attr( get_post_format( $post->ID ) ); ?>"></i>

									<?php else : ?>

										<i class="lsvr_kba-tree-widget__item-icon c-post-type-icon c-post-type-icon--lsvr_kba"></i>

									<?php endif; ?>

                                    <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"
                                    	class="lsvr_kba-tree-widget__item-link lsvr_kba-tree-widget__item-link--post lsvr_kba-tree-widget__item-link--level-<?php echo esc_attr( (int) $depth + 1 ); ?>">
                                    	<?php echo esc_html( $post->post_title ); ?></a>

                                </div>

                            </div>
                        </li>

                    <?php endforeach; ?>

                </ul>

            <?php endif; ?>

            <?php $output .= ob_get_clean();

        }

        $output .= '</li>';

    }

}}

?>