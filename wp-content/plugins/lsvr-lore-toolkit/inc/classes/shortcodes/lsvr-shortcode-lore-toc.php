<?php
/**
 * LSVR Lore Tabe of Contents Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Lore_TOC' ) ) {
    class Lsvr_Shortcode_Lore_TOC {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Merge default atts and received atts
            $args = shortcode_atts(
                array(
                    'title' => '',
                    'excluded_ids' => '',
                    'id' => '',
                    'className' => '',
                    'editor_view' => false,
                ),
                $atts
            );

            // Check if editor view
            $editor_view = true === $args['editor_view'] || '1' === $args['editor_view'] || 'true' === $args['editor_view'] ? true : false;

            // Element class
            $class_arr = array( 'lsvr-lore-toc' );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr-lore-toc--editor-view' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }

            ob_start(); ?>

            <!-- LORE TABLE OF CONTENTS : begin -->
            <section class="<?php echo esc_attr( implode( ' ', $class_arr ) ); ?>"
                <?php echo ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : ''; ?>
                <?php echo ! empty( $args['excluded_ids'] ) ? ' data-excluded="' . esc_attr( $args['excluded_ids'] ) . '"' : ''; ?>>
                <div class="lsvr-container">
                    <div class="lsvr-lore-toc__inner">

                        <?php if ( ! empty( $args['title'] ) ) : ?>

                            <h6 class="lsvr-lore-toc__title">
                                <span class="lsvr-lore-toc__title-inner">

                                    <?php echo esc_html( $args['title'] ); ?>

                                </span>
                            </h6>

                        <?php endif; ?>

                        <?php if ( true === $editor_view ) : ?>

                            <div class="lsvr-lore-toc__content">
                                <p><?php esc_html_e( 'The list of anchors will be generated on the front-end.', 'lsvr-lore-toolkit' ); ?></p>
                            </div>

                        <?php else : ?>

                            <div class="lsvr-lore-toc__content lsvr-lore-toc__content--loading">
                                <span class="lsvr-lore-toc__spinner c-spinner"></span>
                            </div>

                        <?php endif; ?>

                    </div>
                </div>
            </section>
            <!-- LORE TABLE OF CONTENTS : end -->

            <?php return ob_get_clean();

        }

        // Shortcode params
        public static function lsvr_shortcode_atts() {
            return array_merge( array(

                // Title
                array(
                    'name' => 'title',
                    'type' => 'text',
                    'label' => esc_html__( 'Title', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Title of this section.', 'lsvr-lore-toolkit' ),
                    'default' => esc_html__( 'Table of Contents', 'lsvr-lore-toolkit' ),
                    'priority' => 10,
                ),

                // Excluded IDs
                array(
                    'name' => 'excluded_ids',
                    'type' => 'text',
                    'label' => esc_html__( 'Excluded IDs', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'Headings with these IDs (anchors) will not be displayed in table of contents. Separate IDs with comma.', 'lsvr-lore-toolkit' ),
                    'default' => '',
                    'priority' => 20,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-lore-toolkit' ),
                    'description' => esc_html__( 'You can use this ID to style this specific element with custom CSS, for example.', 'lsvr-lore-toolkit' ),
                    'priority' => 30,
                ),

            ), apply_filters( 'lsvr_lore_toc_shortcode_atts', array() ) );
        }

    }
}
?>