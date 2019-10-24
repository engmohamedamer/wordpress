<?php

// Get editor custom colors template
if ( ! function_exists( 'lsvr_lore_get_editor_custom_colors_template' ) ) {
	function lsvr_lore_get_editor_custom_colors_template() {

			return '
.editor-styles-wrapper { color: $body-font; }
.editor-styles-wrapper a { color: $body-link; }
.editor-styles-wrapper abbr { border-color: $body-font; }
.editor-styles-wrapper button { color: $body-font; }
.editor-styles-wrapper input,
.editor-styles-wrapper select,
.editor-styles-wrapper textarea { color: $body-font; }
.editor-styles-wrapper .c-button { background-color: $accent1; }
.editor-styles-wrapper .c-post-rating__likes,
.editor-styles-wrapper .c-post-rating__sum--positive { color: $accent1; }
.editor-styles-wrapper .c-search-form__button { color: $accent1; }
.editor-styles-wrapper .widget_archive a { color: $body-link; box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_archive a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .widget_archive a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_calendar tfoot a { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_calendar tfoot a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .widget_calendar tfoot a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_categories a { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_categories a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .widget_categories a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_meta a { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_meta a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .widget_meta a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_nav_menu a { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_nav_menu a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .widget_nav_menu a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_pages a { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_pages a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .widget_pages a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_recent_comments .comment-author-link { color: $body-font; }
.editor-styles-wrapper .widget_recent_comments a { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_recent_comments a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .widget_recent_comments a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_recent_entries a { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_recent_entries a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .widget_recent_entries a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_rss a { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_rss a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .widget_rss a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_tag_cloud a { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_tag_cloud a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .widget_tag_cloud a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-lore-kba-category-widget__icon { color: $accent1; }
.editor-styles-wrapper .lsvr-lore-kba-category-widget__item-link { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-lore-kba-category-widget__item-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr-lore-kba-category-widget__item-link:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-definition-list-widget__item-text-link { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-definition-list-widget__item-text-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr-definition-list-widget__item-text-link:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-post-list-widget__item-title-link { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-post-list-widget__item-title-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr-post-list-widget__item-title-link:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-post-featured-widget__title-link { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-post-featured-widget__title-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr-post-featured-widget__title-link:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-post-featured-widget__excerpt-more-link { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-post-featured-widget__excerpt-more-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr-post-featured-widget__excerpt-more-link:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr_kba-categories-widget a,
.editor-styles-wrapper .lsvr_faq-categories-widget a { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr_kba-categories-widget a:hover,
.editor-styles-wrapper .lsvr_faq-categories-widget a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr_kba-categories-widget a:active,
.editor-styles-wrapper .lsvr_faq-categories-widget a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr_kba-tree-widget__item-icon { color: $accent1; }
.editor-styles-wrapper .lsvr_kba-tree-widget__item-link { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr_kba-tree-widget__item-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr_kba-tree-widget__item-link:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr_kba-tree-widget__item-toggle--active,
.editor-styles-wrapper .lsvr_kba-tree-widget__item-toggle:hover { background-color: $accent1; border-color: $accent1; }
.editor-styles-wrapper .lsvr_kba-tree-widget__item--current > .lsvr_kba-tree-widget__item-inner { border-color: $accent1; }
.editor-styles-wrapper .lsvr_kba-tree-widget__item--current > .lsvr_kba-tree-widget__item-inner .lsvr_kba-tree-widget__item-icon { color: $accent1; }
.editor-styles-wrapper .lsvr_kba-list-widget__item-icon { color: $accent1; }
.editor-styles-wrapper .lsvr_kba-list-widget__item-title-link { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr_kba-list-widget__item-title-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr_kba-list-widget__item-title-link:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr_kba-featured-widget__title-link { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr_kba-featured-widget__title-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr_kba-featured-widget__title-link:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr_faq-list-widget__item-title-link { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr_faq-list-widget__item-title-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr_faq-list-widget__item-title-link:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr_faq-featured-widget__title-link { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr_faq-featured-widget__title-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr_faq-featured-widget__title-link:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_display_search .button { background-color: $accent1; }
.editor-styles-wrapper .widget_display_forums a { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_display_forums a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .widget_display_forums a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .bbp_widget_login .bbp-login-links a { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .bbp_widget_login .bbp-login-links a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .bbp_widget_login .bbp-login-links a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_display_replies a { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_display_replies a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .widget_display_replies a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_display_topics a { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_display_topics a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .widget_display_topics a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_display_views a { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .widget_display_views a:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .widget_display_views a:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-lore-faq__post--expanded .lsvr-lore-faq__post-inner { border-color: $accent1; }
.editor-styles-wrapper .lsvr-lore-faq__post-permalink-link { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-lore-faq__post-permalink-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr-lore-faq__post-permalink-link:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-lore-posts__post-permalink-link { box-shadow: 0 1px 0 0 $body-link; }
.editor-styles-wrapper .lsvr-lore-posts__post-permalink-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr-lore-posts__post-permalink-link:active { box-shadow: 0 1px 0 0 $body-link; }
.editor-styles-wrapper .lsvr-lore-sitemap__item-icon { color: $accent1; }
.editor-styles-wrapper .lsvr-lore-sitemap__item-link { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-lore-sitemap__item-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr-lore-sitemap__item-link:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-lore-toc__item-link { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-lore-toc__item-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr-lore-toc__item-link:active { box-shadow: 0 0 0 0 $body-link; }
.editor-styles-wrapper .lsvr-button { background-color: $accent1; }
.editor-styles-wrapper .lsvr-counter__number { color: $accent1; }
.editor-styles-wrapper .lsvr-cta__button-link { background-color: $accent1; }
.editor-styles-wrapper .lsvr-feature__more-link { box-shadow: 0 1px 0 0 $body-link; }
.editor-styles-wrapper .lsvr-feature__more-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.editor-styles-wrapper .lsvr-feature__more-link:active { box-shadow: 0 1px 0 0 $body-link; }
.editor-styles-wrapper .lsvr-pricing-table__title { background-color: $accent1; }
.editor-styles-wrapper .lsvr-pricing-table__price-value { color: $accent1; }
.editor-styles-wrapper .lsvr-pricing-table__button-link { background-color: $accent1; }
.editor-styles-wrapper .lsvr-progress-bar__bar-inner { background-color: $accent1; }
';

	}
}
?>