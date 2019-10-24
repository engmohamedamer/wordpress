<?php
/**
 * KBA post type
 */
if ( ! class_exists( 'Lsvr_CPT_KBA' ) && class_exists( 'Lsvr_CPT' ) ) {
    class Lsvr_CPT_KBA extends Lsvr_CPT {

		public function __construct() {

			parent::__construct( array(
				'id' => 'lsvr_kba',
				'wp_args' => array(
					'labels' => array(
						'name' => esc_html__( 'Knowledge Base', 'lsvr-knowledge-base' ),
						'singular_name' => esc_html__( 'Article', 'lsvr-knowledge-base' ),
						'add_new' => esc_html__( 'Add New Article', 'lsvr-knowledge-base' ),
						'add_new_item' => esc_html__( 'Add New Article', 'lsvr-knowledge-base' ),
						'edit_item' => esc_html__( 'Edit Article', 'lsvr-knowledge-base' ),
						'new_item' => esc_html__( 'Add New Article', 'lsvr-knowledge-base' ),
						'view_item' => esc_html__( 'View Article', 'lsvr-knowledge-base' ),
						'search_items' => esc_html__( 'Search articles', 'lsvr-knowledge-base' ),
						'not_found' => esc_html__( 'No articles found', 'lsvr-knowledge-base' ),
						'not_found_in_trash' => esc_html__( 'No articles found in trash', 'lsvr-knowledge-base' ),
					),
					'exclude_from_search' => false,
					'public' => true,
					'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail', 'author', 'revisions', 'excerpt', 'comments', 'post-formats', 'author' ),
					'capability_type' => 'post',
					'rewrite' => array( 'slug' => 'knowledge-base' ),
					'menu_position' => 5,
					'has_archive' => true,
					'show_in_nav_menus' => true,
					'show_in_rest' => true,
					'menu_icon' => 'dashicons-book',
				),
			));

			// Add Category taxonomy
			$this->add_taxonomy(array(
				'id' => 'lsvr_kba_cat',
				'wp_args' => array(
					'labels' => array(
						'name' => esc_html__( 'Article Categories', 'lsvr-knowledge-base' ),
						'singular_name' => esc_html__( 'Article Category', 'lsvr-knowledge-base' ),
						'search_items' => esc_html__( 'Search Article Categories', 'lsvr-knowledge-base' ),
						'popular_items' => esc_html__( 'Popular Article Categories', 'lsvr-knowledge-base' ),
						'all_items' => esc_html__( 'All Article Categories', 'lsvr-knowledge-base' ),
						'parent_item' => esc_html__( 'Parent Article Category', 'lsvr-knowledge-base' ),
						'parent_item_colon' => esc_html__( 'Parent Article Category:', 'lsvr-knowledge-base' ),
						'edit_item' => esc_html__( 'Edit Article Category', 'lsvr-knowledge-base' ),
						'update_item' => esc_html__( 'Update Article Category', 'lsvr-knowledge-base' ),
						'add_new_item' => esc_html__( 'Add New Article Category', 'lsvr-knowledge-base' ),
						'new_item_name' => esc_html__( 'New Article Category Name', 'lsvr-knowledge-base' ),
						'separate_items_with_commas' => esc_html__( 'Separate article categories by comma', 'lsvr-knowledge-base' ),
						'add_or_remove_items' => esc_html__( 'Add or remove article categories', 'lsvr-knowledge-base' ),
						'choose_from_most_used' => esc_html__( 'Choose from the most used article categories', 'lsvr-knowledge-base' ),
						'menu_name' => esc_html__( 'Article Categories', 'lsvr-knowledge-base' )
					),
					'public' => true,
					'show_in_nav_menus' => true,
					'show_ui' => true,
					'show_admin_column' => true,
					'show_tagcloud' => true,
					'hierarchical' => true,
					'rewrite' => array( 'slug' => 'knowledge-base-category' ),
					'query_var' => true,
					'show_in_rest' => true,
				),
				'args' => array(
					'admin_tax_filter' => true,
				),
			));

			// Add Tag taxonomy
			$this->add_taxonomy(array(
				'id' => 'lsvr_kba_tag',
				'wp_args' => array(
					'labels' => array(
						'name' => esc_html__( 'Article Tags', 'lsvr-knowledge-base' ),
						'singular_name' => esc_html__( 'Article Tag', 'lsvr-knowledge-base' ),
						'search_items' => esc_html__( 'Search Article Tags', 'lsvr-knowledge-base' ),
						'popular_items' => esc_html__( 'Popular Article Tags', 'lsvr-knowledge-base' ),
						'all_items' => esc_html__( 'All Article Tags', 'lsvr-knowledge-base' ),
						'parent_item' => esc_html__( 'Parent Article Tag', 'lsvr-knowledge-base' ),
						'parent_item_colon' => esc_html__( 'Parent Article Tag:', 'lsvr-knowledge-base' ),
						'edit_item' => esc_html__( 'Edit Article Tag', 'lsvr-knowledge-base' ),
						'update_item' => esc_html__( 'Update Article Tag', 'lsvr-knowledge-base' ),
						'add_new_item' => esc_html__( 'Add New Article Tag', 'lsvr-knowledge-base' ),
						'new_item_name' => esc_html__( 'New Article Tag Name', 'lsvr-knowledge-base' ),
						'separate_items_with_commas' => esc_html__( 'Separate article tags by comma', 'lsvr-knowledge-base' ),
						'add_or_remove_items' => esc_html__( 'Add or remove article tags', 'lsvr-knowledge-base' ),
						'choose_from_most_used' => esc_html__( 'Choose from the most used article tags', 'lsvr-knowledge-base' ),
						'menu_name' => esc_html__( 'Article Tags', 'lsvr-knowledge-base' )
					),
					'public' => true,
					'show_in_nav_menus' => true,
					'show_ui' => true,
					'show_admin_column' => true,
					'show_tagcloud' => true,
					'hierarchical' => false,
					'rewrite' => array( 'slug' => 'knowledge-base-tag' ),
					'query_var' => true,
					'show_in_rest' => true,
				),
				'args' => array(
					'admin_tax_filter' => true,
				),
			));

			// Additional custom admin functionality
			if ( is_admin() ) {

				// Add Article Settings metabox
				add_action( 'init', array( $this, 'add_kba_post_metabox' ) );

				// Add knowledge base category metabox
				add_action( 'init', array( $this, 'add_kba_cat_tax_metabox' ) );

				// Display custom columns in admin archive view
				add_filter( 'manage_edit-lsvr_kba_columns', array( $this, 'add_columns' ), 10, 1 );
				add_action( 'manage_posts_custom_column', array( $this, 'display_columns' ), 10, 1 );

			}

		}

		// Add Article Settings metabox
		public function add_kba_post_metabox() {
			if ( class_exists( 'Lsvr_Post_Metabox' ) ) {
				$lsvr_kba_post_metabox = new Lsvr_Post_Metabox(array(
					'id' => 'lsvr_kba_settings',
					'wp_args' => array(
						'title' => __( 'Article Settings', 'lsvr-knowledge-base' ),
						'screen' => 'lsvr_kba',
					),
					'fields' => array(

						// Local Attachments
						'lsvr_kba_local_attachments' => array(
							'type' => 'attachment',
							'title' => esc_html__( 'Local Attachments', 'lsvr-knowledge-base' ),
							'description' => esc_html__( 'Upload new or select existing files.', 'lsvr-knowledge-base' ),
							'select_btn_label' => esc_html__( 'Select Local Attachments', 'lsvr-knowledge-base' ),
							'priority' => 10,
						),

						// External Attachments
						'lsvr_kba_external_attachments' => array(
							'type' => 'external-attachment',
							'title' => esc_html__( 'External Attachments', 'lsvr-knowledge-base' ),
							'description' => esc_html__( 'Insert URL of external attachment.', 'lsvr-knowledge-base' ),
							'priority' => 20,
						),

						// Related Articles
						'lsvr_kba_related_articles' => array(
							'type' => 'text',
							'title' => esc_html__( 'Related Articles', 'lsvr-knowledge-base' ),
							'description' => esc_html__( 'Display related Knowledge Base articles at the bottom of the article detail page. List of IDs or slugs separated by comma.', 'lsvr-knowledge-base' ),
							'priority' => 30,
						),

					),
				));
			}
		}

		// Add Article Cateogry taxonomy metabox
		public function add_kba_cat_tax_metabox() {
			if ( class_exists( 'Lsvr_Tax_Metabox' ) ) {
				$lsvr_kba_cat_metabox = new Lsvr_Tax_Metabox(array(
					'taxonomy_name' => 'lsvr_kba_cat',
					'fields' => array(

						// Icon
						'icon' => array(
							'type' => 'text',
							'title' => esc_html__( 'Category Icon', 'lsvr-knowledge-base' ),
							'hint' => esc_html__( 'Name of the icon. Please refer to the documentation to learn more about using the icons.', 'lsvr-knowledge-base' ),
							'priority' => 20,
						),

					),
				));
			}
		}

		// Add custom columns to admin view
		public function add_columns( $columns ) {

			if ( 'disable' !== apply_filters( 'lsvr_knowledge_base_kba_rating_type', 'disable' ) ) {
				$rating = array( 'lsvr_kba_rating' => esc_html__( 'Rating', 'lsvr-knowledge-base' ) );
				$columns = array_slice( $columns, 0, 2, true ) + $rating + array_slice( $columns, 1, NULL, true );
			}

			return $columns;
		}

		// Display custom columns in admin view
		public function display_columns( $column ) {
			global $post;
			global $typenow;
			if ( 'lsvr_kba' == $typenow ) {

				// Rating
				if ( 'lsvr_kba_rating' === $column && 'disable' !== apply_filters( 'lsvr_knowledge_base_kba_rating_type', 'disable' ) ) {

					$rating = lsvr_knowledge_base_get_kba_rating( $post->ID );
					ob_start(); ?>

					<div class="lsvr-knowledge-base-admin-view__rating lsvr-knowledge-base-admin-view__rating--likes">
						<?php echo sprintf( esc_html__( 'Likes: %d', 'lsvr-knowledge-base' ), $rating['likes'] ); ?>
					</div>
					<div class="lsvr-knowledge-base-admin-view__rating lsvr-knowledge-base-admin-view__rating--dislikes">
						<?php echo sprintf( esc_html__( 'Dislikes: %d', 'lsvr-knowledge-base' ), $rating['dislikes'] ); ?>
					</div>
					<div class="lsvr-knowledge-base-admin-view__rating lsvr-knowledge-base-admin-view__rating--sum">
						<strong><?php echo sprintf( esc_html__( 'Sum: %d', 'lsvr-knowledge-base' ), $rating['sum'] ); ?></strong>
					</div>

					<?php echo ob_get_clean();

				}

			}
		}

	}
}

?>