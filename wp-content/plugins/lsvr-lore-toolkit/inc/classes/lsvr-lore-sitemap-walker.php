<?php
// Sitemap section walker
if ( ! class_exists( 'Lsvr_Lore_Sitemap_Walker' ) ) {
    class Lsvr_Lore_Sitemap_Walker extends Walker_Nav_Menu {

        private $lsvr_counter = 0,
                $lsvr_cta_added = false;

        function start_lvl( &$output, $depth = 0, $args = [] ) {
            ob_start(); ?>

            <ul class="lsvr-lore-sitemap__submenu lsvr-lore-sitemap__submenu--level-<?php echo esc_attr( (int) $depth + 1 ); ?>">

            <?php $output .= ob_get_clean();

        }

        function end_lvl( &$output, $depth = 0, $args = [] ) {
            ob_start(); ?>

            </ul>

            <?php $output .= ob_get_clean();
        }

        function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
            if ( 0 === $depth ) { $this->lsvr_counter++; }
            ob_start(); ?>

            <?php if ( ! empty( $args->cta_position ) && 0 === $depth && false === $this->lsvr_cta_added
                && ( ( 'first' === $args->cta_position && 1 === $this->lsvr_counter )
                    || ( 'second' === $args->cta_position && 2 === $this->lsvr_counter )
                    || ( 'third' === $args->cta_position && 3 === $this->lsvr_counter )
                    || ( 'fourth' === $args->cta_position && 4 === $this->lsvr_counter ) ) ) : ?>

                <li class="lsvr-lore-sitemap__item lsvr-lore-sitemap__item--cta lsvr-lore-sitemap__item--level-0">
                    <div class="lsvr-lore-sitemap__item-inner">

                        <?php the_widget( 'Lsvr_Widget_Lore_CTA', array(
                            'title' => $args->cta_title,
                            'text' => $args->cta_text,
                            'more_label' => $args->cta_more_label,
                            'more_link' => $args->cta_more_link,
                        ), array(
                            'before_widget' => '<div class="widget lsvr-lore-cta-widget"><div class="widget__inner">',
                            'after_widget' => '</div></div>',
                            'before_title' => '<h3 class="widget__title">',
                            'after_title' => '</h3>',
                        )); ?>

                    </div>
                </li>

            <?php $this->lsvr_cta_added = true; endif; ?>

            <li class="lsvr-lore-sitemap__item lsvr-lore-sitemap__item--level-<?php echo esc_attr( $depth ); ?> <?php echo ! empty( $item->classes ) ? esc_attr( trim( implode( ' ', $item->classes ) ) ) : ''; ?>">
                <div class="lsvr-lore-sitemap__item-inner">

                    <?php if ( 0 === $depth && ! empty( $item->description ) ) : ?>

                        <i class="lsvr-lore-sitemap__item-icon <?php echo esc_attr( $item->description ); ?>"></i>

                    <?php endif; ?>

                    <?php if ( 0 === $depth ) : ?>

                        <h3 class="lsvr-lore-sitemap__item-title">

                    <?php endif; ?>

                    <a href="<?php echo esc_url( $item->url ); ?>"
                        class="lsvr-lore-sitemap__item-link lsvr-lore-sitemap__item-link--level-<?php echo esc_attr( $depth ); ?>"
                        <?php echo ! empty( $item->post_excerpt ) ? ' title="' . esc_attr( $item->post_excerpt ) . '"' : ''; ?>
                        <?php echo ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : ''; ?>><?php echo esc_html( $item->title ); ?></a>

                    <?php if ( 0 === $depth ) : ?>

                        </h3>

                    <?php endif; ?>

            <?php $output .= ob_get_clean();
        }

        function end_el( &$output, $item, $depth = 0, $args = [] ) {
            ob_start(); ?>

                </div>
            </li>

            <?php if ( ! empty( $args->cta_position ) && 0 === $depth && false === $this->lsvr_cta_added
                && 'last' === $args->cta_position && $args->top_level_count === $this->lsvr_counter ) : ?>

                <li class="lsvr-lore-sitemap__item lsvr-lore-sitemap__item--cta lsvr-lore-sitemap__item--level-0">
                    <div class="lsvr-lore-sitemap__item-inner">

                        <?php the_widget( 'Lsvr_Widget_Lore_CTA', array(
                            'title' => $args->cta_title,
                            'text' => $args->cta_text,
                            'more_label' => $args->cta_more_label,
                            'more_link' => $args->cta_more_link,
                        ), array(
                            'before_widget' => '<div class="widget lsvr-lore-cta-widget"><div class="widget__inner">',
                            'after_widget' => '</div></div>',
                            'before_title' => '<h3 class="widget__title">',
                            'after_title' => '</h3>',
                        )); ?>

                    </div>
                </li>

            <?php $this->lsvr_cta_added = true; endif; ?>

            <?php $output .= ob_get_clean();

        }

    }
}