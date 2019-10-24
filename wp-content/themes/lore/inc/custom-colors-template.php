<?php

// Get custom colors template
if ( ! function_exists( 'lsvr_lore_get_custom_colors_template' ) ) {
	function lsvr_lore_get_custom_colors_template() {

return '
body { color: $body-font; }
a { color: $body-link; }
abbr { border-color: $body-font; }
button { color: $body-font; }
input, select, textarea { color: $body-font; }
.c-button { background-color: $accent1; }
.c-post-rating__likes,
.c-post-rating__sum--positive { color: $accent1; }
.c-search-form__button { color: $accent1; }
.header-menu__item--dropdown .header-menu__submenu .header-menu__item-link:hover { background-color: $accent1; }
.header-search-form__input { color: $accent1; }
.header-search-form__submit { color: $accent1; }
.header-search-form__panel { color: $body-font; border-color: $accent1; }
.header-search-form__filter-label { color: $body-font; }
.header-search-form__filter-label:hover { border-color: $accent1; }
.header-search-form__filter-label--active { background-color: $accent1; border-color: $accent1; }
.header-search-form__results-more-link { color: $body-link; box-shadow: 0 0 0 0 $body-link; }
.header-search-form__results-more-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.header-search-form__results-more-link:active { box-shadow: 0 0 0 0 $body-link; }
.header-search-form__keywords-inner { background-color: $accent1; }
.post-author__badge { color: $accent1; }
.post-author__more-link { box-shadow: 0 0 0 0 $body-link; }
.post-author__more-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.post-author__more-link:active { box-shadow: 0 0 0 0 $body-link; }
.post-navigation__link { box-shadow: 0 0 0 0 $body-link; }
.post-navigation__link:hover { box-shadow: 0 2px 0 0 $body-link; }
.post-navigation__link:active { box-shadow: 0 0 0 0 $body-link; }
.post-comments__list .comment-reply-link { color: $accent1; box-shadow: 0 0 0 0 $accent1; }
.post-comments__list .comment-reply-link:hover { box-shadow: 0 1px 0 0 $accent1; }
.post-comments__list .comment-reply-link:active { box-shadow: 0 0 0 0 $accent1; }
.post-comments .form-submit .submit { background-color: $accent1; }
.logged-in-as > a { box-shadow: 0 0 0 0 $body-link; }
.logged-in-as > a:hover { box-shadow: 0 2px 0 0 $body-link; }
.logged-in-as > a:active { box-shadow: 0 0 0 0 $body-link; }
.navigation.pagination .page-numbers.current { background-color: $accent1; }
ul.page-numbers .page-numbers.current { background-color: $accent1; }
.general-post-archive .post__title-link { box-shadow: 0 0 0 0 $body-link; }
.general-post-archive .post__title-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.general-post-archive .post__title-link:active { box-shadow: 0 0 0 0 $body-link; }
.blog-post-page .post__term-link,
.blog-post-page .post__meta-item-link { box-shadow: 0 0 0 0 $body-link; }
.blog-post-page .post__term-link:hover,
.blog-post-page .post__meta-item-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.blog-post-page .post__term-link:active,
.blog-post-page .post__meta-item-link:active { box-shadow: 0 0 0 0 $body-link; }
.blog-post-archive .post__date-author-link { box-shadow: 0 0 0 0 $body-link; }
.blog-post-archive .post__date-author-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.blog-post-archive .post__date-author-link:active { box-shadow: 0 0 0 0 $body-link; }
.blog-post-single .post__date-author-link { box-shadow: 0 0 0 0 $body-link; }
.blog-post-single .post__date-author-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.blog-post-single .post__date-author-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-archive--default .post-archive__subcategory-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-archive--default .post-archive__subcategory-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr_kba-post-archive--default .post-archive__subcategory-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-archive--default .post__title-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-archive--default .post__title-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr_kba-post-archive--default .post__title-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-archive--category-view .post-archive__item-icon { color: $accent1; }
.lsvr_kba-post-archive--category-view .post-archive__item-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-archive--category-view .post-archive__item-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr_kba-post-archive--category-view .post-archive__item-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-archive--category-view .post-archive__item-child-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-archive--category-view .post-archive__item-child-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr_kba-post-archive--category-view .post-archive__item-child-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-single .post-attachments__link { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-single .post-attachments__link:hover { box-shadow: 0 1px 0 0 $body-link; }
.lsvr_kba-post-single .post-attachments__link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-single .post__date-author-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-single .post__date-author-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr_kba-post-single .post__date-author-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-single .post__term-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-single .post__term-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr_kba-post-single .post__term-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-single .post-rating__button--like { color: $accent1; }
.lsvr_kba-post-single .post-rating__button--like:hover { border-color: $accent1; }
.lsvr_kba-post-single .post-related__link { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-post-single .post-related__link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr_kba-post-single .post-related__link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_faq-post-archive .post__permalink-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr_faq-post-archive .post__permalink-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr_faq-post-archive .post__permalink-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_faq-post-archive--is-expandable .post--expanded .post__inner { border-color: $accent1; }
.lsvr_faq-post-single .post__term-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr_faq-post-single .post__term-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr_faq-post-single .post__term-link:active { box-shadow: 0 0 0 0 $body-link; }
.widget_archive a { color: $body-link; box-shadow: 0 0 0 0 $body-link; }
.widget_archive a:hover { box-shadow: 0 2px 0 0 $body-link; }
.widget_archive a:active { box-shadow: 0 0 0 0 $body-link; }
.widget_calendar tfoot a { box-shadow: 0 0 0 0 $body-link; }
.widget_calendar tfoot a:hover { box-shadow: 0 2px 0 0 $body-link; }
.widget_calendar tfoot a:active { box-shadow: 0 0 0 0 $body-link; }
.widget_categories a { box-shadow: 0 0 0 0 $body-link; }
.widget_categories a:hover { box-shadow: 0 2px 0 0 $body-link; }
.widget_categories a:active { box-shadow: 0 0 0 0 $body-link; }
.widget_meta a { box-shadow: 0 0 0 0 $body-link; }
.widget_meta a:hover { box-shadow: 0 2px 0 0 $body-link; }
.widget_meta a:active { box-shadow: 0 0 0 0 $body-link; }
.widget_nav_menu a { box-shadow: 0 0 0 0 $body-link; }
.widget_nav_menu a:hover { box-shadow: 0 2px 0 0 $body-link; }
.widget_nav_menu a:active { box-shadow: 0 0 0 0 $body-link; }
.widget_pages a { box-shadow: 0 0 0 0 $body-link; }
.widget_pages a:hover { box-shadow: 0 2px 0 0 $body-link; }
.widget_pages a:active { box-shadow: 0 0 0 0 $body-link; }
.widget_recent_comments .comment-author-link { color: $body-font; }
.widget_recent_comments a { box-shadow: 0 0 0 0 $body-link; }
.widget_recent_comments a:hover { box-shadow: 0 2px 0 0 $body-link; }
.widget_recent_comments a:active { box-shadow: 0 0 0 0 $body-link; }
.widget_recent_entries a { box-shadow: 0 0 0 0 $body-link; }
.widget_recent_entries a:hover { box-shadow: 0 2px 0 0 $body-link; }
.widget_recent_entries a:active { box-shadow: 0 0 0 0 $body-link; }
.widget_rss a { box-shadow: 0 0 0 0 $body-link; }
.widget_rss a:hover { box-shadow: 0 2px 0 0 $body-link; }
.widget_rss a:active { box-shadow: 0 0 0 0 $body-link; }
.widget_tag_cloud a { box-shadow: 0 0 0 0 $body-link; }
.widget_tag_cloud a:hover { box-shadow: 0 2px 0 0 $body-link; }
.widget_tag_cloud a:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr-lore-kba-category-widget__icon { color: $accent1; }
.lsvr-lore-kba-category-widget__item-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr-lore-kba-category-widget__item-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr-lore-kba-category-widget__item-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr-definition-list-widget__item-text-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr-definition-list-widget__item-text-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr-definition-list-widget__item-text-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr-post-list-widget__item-title-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr-post-list-widget__item-title-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr-post-list-widget__item-title-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr-post-featured-widget__title-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr-post-featured-widget__title-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr-post-featured-widget__title-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr-post-featured-widget__excerpt-more-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr-post-featured-widget__excerpt-more-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr-post-featured-widget__excerpt-more-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-categories-widget a,
.lsvr_faq-categories-widget a { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-categories-widget a:hover,
.lsvr_faq-categories-widget a:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr_kba-categories-widget a:active,
.lsvr_faq-categories-widget a:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-tree-widget__item-icon { color: $accent1; }
.lsvr_kba-tree-widget__item-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-tree-widget__item-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr_kba-tree-widget__item-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-tree-widget__item-toggle--active,
.lsvr_kba-tree-widget__item-toggle:hover { background-color: $accent1; border-color: $accent1; }
.lsvr_kba-tree-widget__item--current > .lsvr_kba-tree-widget__item-inner { border-color: $accent1; }
.lsvr_kba-tree-widget__item--current > .lsvr_kba-tree-widget__item-inner .lsvr_kba-tree-widget__item-icon { color: $accent1; }
.lsvr_kba-list-widget__item-icon { color: $accent1; }
.lsvr_kba-list-widget__item-title-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-list-widget__item-title-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr_kba-list-widget__item-title-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-featured-widget__title-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr_kba-featured-widget__title-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr_kba-featured-widget__title-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_faq-list-widget__item-title-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr_faq-list-widget__item-title-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr_faq-list-widget__item-title-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr_faq-featured-widget__title-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr_faq-featured-widget__title-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr_faq-featured-widget__title-link:active { box-shadow: 0 0 0 0 $body-link; }
.widget_display_search .button { background-color: $accent1; }
.widget_display_forums a { box-shadow: 0 0 0 0 $body-link; }
.widget_display_forums a:hover { box-shadow: 0 2px 0 0 $body-link; }
.widget_display_forums a:active { box-shadow: 0 0 0 0 $body-link; }
.bbp_widget_login .bbp-login-links a { box-shadow: 0 0 0 0 $body-link; }
.bbp_widget_login .bbp-login-links a:hover { box-shadow: 0 2px 0 0 $body-link; }
.bbp_widget_login .bbp-login-links a:active { box-shadow: 0 0 0 0 $body-link; }
.widget_display_replies a { box-shadow: 0 0 0 0 $body-link; }
.widget_display_replies a:hover { box-shadow: 0 2px 0 0 $body-link; }
.widget_display_replies a:active { box-shadow: 0 0 0 0 $body-link; }
.widget_display_topics a { box-shadow: 0 0 0 0 $body-link; }
.widget_display_topics a:hover { box-shadow: 0 2px 0 0 $body-link; }
.widget_display_topics a:active { box-shadow: 0 0 0 0 $body-link; }
.widget_display_views a { box-shadow: 0 0 0 0 $body-link; }
.widget_display_views a:hover { box-shadow: 0 2px 0 0 $body-link; }
.widget_display_views a:active { box-shadow: 0 0 0 0 $body-link; }
.footer-social__item-link { color: $accent1; }
.footer-widgets a { color: $accent1; }
.footer-widgets .widget_archive a { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_archive a:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .widget_archive a:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_calendar tfoot a { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_calendar tfoot a:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .widget_calendar tfoot a:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_categories a { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_categories a:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .widget_categories a:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_meta a { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_meta a:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .widget_meta a:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_nav_menu a { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_nav_menu a:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .widget_nav_menu a:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_pages a { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_pages a:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .widget_pages a:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_recent_comments a { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_recent_comments a:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .widget_recent_comments a:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_recent_entries a { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_recent_entries a:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .widget_recent_entries a:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_rss a { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_rss a:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .widget_rss a:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_tag_cloud .tag-cloud-link { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .widget_tag_cloud .tag-cloud-link:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .widget_tag_cloud .tag-cloud-link:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr-lore-kba-category-widget__item-link { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr-lore-kba-category-widget__item-link:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .lsvr-lore-kba-category-widget__item-link:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr-definition-list-widget__item-text-link { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr-definition-list-widget__item-text-link:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .lsvr-definition-list-widget__item-text-link:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr-post-list-widget__item-title-link { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr-post-list-widget__item-title-link:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .lsvr-post-list-widget__item-title-link:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr-post-featured-widget__title-link { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr-post-featured-widget__title-link:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .lsvr-post-featured-widget__title-link:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr_kba-categories-widget a,
.footer-widgets .lsvr_faq-categories-widget a { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr_kba-categories-widget a:hover,
.footer-widgets .lsvr_faq-categories-widget a:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .lsvr_kba-categories-widget a:active,
.footer-widgets .lsvr_faq-categories-widget a:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr_kba-tree-widget__item-link { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr_kba-tree-widget__item-link:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .lsvr_kba-tree-widget__item-link:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr_kba-tree-widget__item-toggle--active,
.footer-widgets .lsvr_kba-tree-widget__item-toggle:hover { background-color: $accent1; border-color: $accent1; }
.footer-widgets .lsvr_kba-tree-widget__item--current > .lsvr_kba-tree-widget__item-inner .lsvr_kba-tree-widget__item-icon { color: $accent1; }
.footer-widgets .lsvr_kba-list-widget__item-title-link { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr_kba-list-widget__item-title-link:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .lsvr_kba-list-widget__item-title-link:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr_kba-featured-widget__title-link { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr_kba-featured-widget__title-link:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .lsvr_kba-featured-widget__title-link:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr_faq-list-widget__item-title-link { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr_faq-list-widget__item-title-link:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .lsvr_faq-list-widget__item-title-link:active { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr_faq-featured-widget__title-link { box-shadow: 0 0 0 0 $accent1; }
.footer-widgets .lsvr_faq-featured-widget__title-link:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-widgets .lsvr_faq-featured-widget__title-link:active { box-shadow: 0 0 0 0 $accent1; }
.footer-text a { box-shadow: 0 0 0 0 $accent1; }
.footer-text a:hover { box-shadow: 0 2px 0 0 $accent1; }
.footer-text a:active { box-shadow: 0 0 0 0 $accent1; }
.lsvr-lore-faq__post--expanded .lsvr-lore-faq__post-inner { border-color: $accent1; }
.lsvr-lore-faq__post-permalink-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr-lore-faq__post-permalink-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr-lore-faq__post-permalink-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr-lore-posts__post-permalink-link { box-shadow: 0 1px 0 0 $body-link; }
.lsvr-lore-posts__post-permalink-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr-lore-posts__post-permalink-link:active { box-shadow: 0 1px 0 0 $body-link; }
.lsvr-lore-sitemap__item-icon { color: $accent1; }
.lsvr-lore-sitemap__item-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr-lore-sitemap__item-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr-lore-sitemap__item-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr-lore-toc__item-link { box-shadow: 0 0 0 0 $body-link; }
.lsvr-lore-toc__item-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr-lore-toc__item-link:active { box-shadow: 0 0 0 0 $body-link; }
.lsvr-button { background-color: $accent1; }
.lsvr-counter__number { color: $accent1; }
.lsvr-cta__button-link { background-color: $accent1; }
.lsvr-feature__more-link { box-shadow: 0 1px 0 0 $body-link; }
.lsvr-feature__more-link:hover { box-shadow: 0 2px 0 0 $body-link; }
.lsvr-feature__more-link:active { box-shadow: 0 1px 0 0 $body-link; }
.lsvr-pricing-table__title { background-color: $accent1; }
.lsvr-pricing-table__price-value { color: $accent1; }
.lsvr-pricing-table__button-link { background-color: $accent1; }
.lsvr-progress-bar__bar-inner { background-color: $accent1; }
.bbp-submit-wrapper button { background-color: $accent1; }
div.bbp-template-notice a { color: $body-link; box-shadow: 0 0 0 0 $body-link; }
div.bbp-template-notice a:hover { box-shadow: 0 2px 0 0 $body-link; }
div.bbp-template-notice a:active { box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums #favorite-toggle .favorite-toggle,
#bbpress-forums #subscription-toggle .subscription-toggle { color: $body-link; box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums #favorite-toggle .favorite-toggle a:hover,
#bbpress-forums #subscription-toggle .subscription-toggle a:hover { box-shadow: 0 2px 0 0 $body-link; }
#bbpress-forums #favorite-toggle .favorite-toggle a:active,
#bbpress-forums #subscription-toggle .subscription-toggle a:active { box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums .bbp-topic-tags { color: $body-font; }
#bbpress-forums .bbp-topic-tags a { color: $body-font; box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums .bbp-topic-tags a:hover { box-shadow: 0 1px 0 0 $body-link; }
#bbpress-forums .bbp-topic-tags a:active { box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums .bbp-topic-meta a { box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums .bbp-topic-meta a:hover { box-shadow: 0 1px 0 0 $body-link; }
#bbpress-forums .bbp-topic-meta a:active { box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums .bbp-forum-title,
#bbpress-forums .bbp-topic-permalink { box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums .bbp-forum-title:hover,
#bbpress-forums .bbp-topic-permalink:hover { box-shadow: 0 2px 0 0 $body-link; }
#bbpress-forums .bbp-forum-title:active,
#bbpress-forums .bbp-topic-permalink:active { box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums .bbp-forum-link { box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums .bbp-forum-link:hover { box-shadow: 0 1px 0 0 $body-link; }
#bbpress-forums .bbp-forum-link:active { box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums .bbp-topic-freshness a,
#bbpress-forums .bbp-forum-freshness a { box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums .bbp-topic-freshness a:hover,
#bbpress-forums .bbp-forum-freshness a:hover { box-shadow: 0 1px 0 0 $body-link; }
#bbpress-forums .bbp-topic-freshness a:active,
#bbpress-forums .bbp-forum-freshness a:active { box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums div.bbp-forum-author a.bbp-author-name,
#bbpress-forums div.bbp-topic-author a.bbp-author-name,
#bbpress-forums div.bbp-reply-author a.bbp-author-name { color: $body-link; box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums div.bbp-forum-author a.bbp-author-name:hover,
#bbpress-forums div.bbp-topic-author a.bbp-author-name:hover,
#bbpress-forums div.bbp-reply-author a.bbp-author-name:hover { box-shadow: 0 2px 0 0 $body-link; }
#bbpress-forums div.bbp-forum-author a.bbp-author-name:active,
#bbpress-forums div.bbp-topic-author a.bbp-author-name:active,
#bbpress-forums div.bbp-reply-author a.bbp-author-name:active { box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums .bbp-pagination .page-numbers.current { background-color: $accent1; }
#bbpress-forums #bbp-single-user-details #bbp-user-navigation a,
#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a { box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums #bbp-single-user-details #bbp-user-navigation a:hover,
#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a:hover { box-shadow: 0 2px 0 0 $body-link; }
#bbpress-forums #bbp-single-user-details #bbp-user-navigation a:active,
#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a:active { box-shadow: 0 0 0 0 $body-link; }
#bbpress-forums #bbp-your-profile fieldset input, fieldset textarea { color: $body-font; }
#bbpress-forums #bbp-your-profile #bbp_user_edit_submit { background-color: $accent1; }
.wpcf7-submit { background-color: $accent1; }
@media ( max-width: 1199px ) {
	.header-menu__item-link:hover { background-color: $accent1; }
	.current-menu-ancestor > .header-menu__item-link--level-0, .current-menu-parent > .header-menu__item-link--level-0,
	.current-menu-item > .header-menu__item-link--level-0 { border-color: $accent1; }
}
';

	}
}
?>