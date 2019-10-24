=== WordPress Password Protect Page Plugin ===
Contributors: gaupoit, rexhoang, ppwp, buildwps
Donate link: https://passwordprotectwp.com/features/?utm_source=wp.org&utm_medium=post&utm_campaign=plugin-link
Tags: password protect, password, protect page, wordpress protection, login
Requires at least: 3.9
Tested up to: 5.2.4
Stable tag: 5.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Password protect WordPress pages and posts by user roles or with multiple passwords; protect your entire website with a single password

== Description ==

Password protect WordPress pages and posts by user roles or with multiple passwords; protect your entire website with a single password.

This plugin does not protect images or uploaded files so if you attach the media files to the protected pages or posts, they are still accessible to anyone with the link. Use [Prevent Direct Access Gold](https://preventdirectaccess.com/features/?utm_source=wp.org&utm_medium=ref-link&utm_campaign=password-protect-page-lite) to block their direct file URL access.

Please note that the passwords will be stored in the post meta and this plugin will set a cookie to allow access the protected pages or posts.

= An Inside Look at Password Protect WordPress Pro =
https://www.youtube.com/watch?v=myYsKXZyNwc

== Password Protected Features ==
The Lite version of Password Protect WordPress plugin offers the following features:

= Protect WordPress Pages & Posts with Multiple Passwords =
The plugin extends WordPress's built-in password protection feature by allowing you to set multiple passwords per Page and Post.

= Password Protect WordPress Pages & Posts by User Roles =
You can also password protect your WordPress Pages & Posts by user roles. In other words, you can set different passwords for different user roles, i.e. one for subscribers, one for editors role.

= Password's Cookies Expiration =
Users won't have to keep entering the password to access a protected page or post until its cookies expire. You can change the expiration time on the plugin's settings page.

= Password Protect The Entire WordPress Website =
You can password protect your whole WordPress website with a single password. All your website content including pages, posts and other custom post types (but not media files) are locked as well.

= Partial Content Protection =
Partial Content Protection features allows you to password protect certain sections of a page or post instead of locking the entire content. This is useful to create teaser content which encourages visitors to register to unlock the entire post.


> #### Pro Version
> Our [Pro version](https://passwordprotectwp.com/features/?utm_source=wp.org&utm_medium=plugin_desc_link&utm_campaign=password-protect-page-lite&utm_content=premium-after-pro-heading) offers more advanced features:
>
>* Password protect all WordPress custom post types including WooCommerce Products
>* Manage all passwords while editing content or via our friendly popup
>* Create unlimited passwords per user role
>* Create the same passwords for multiple user roles
>* Customize password protected form and error message
>* Embed password in access URL
>* Protect all posts under a category
>* Automatically protect all child pages
>* Set the same password for multiple pages
>
> Check out [Password Protect WordPress Pro](https://passwordprotectwp.com/pricing/?utm_source=wp.org&utm_medium=plugin-desc&utm_campaign=password-protect-page-lite&utm_content=premium-after-pro-features) now!
>
> If you need any help with the plugin or want to request new features, feel free to contact us through [this form](https://passwordprotectwp.com/contact/?utm_source=wp.org&utm_medium=plugin_desc_link&utm_campaign=ppwp_lite&utm_content=contact-after-pro-features) or drop us an email at [hello@preventdirectaccess.com](mailto:hello@preventdirectaccess.com)

Please check out these guides on [how to password protect WordPress page](https://passwordprotectwp.com/docs/getting-started/?utm_source=wp.org&utm_medium=guide-link&utm_campaign=password-protect-page-lite).

== Installation ==

There are 2 easy ways to install our plugin:

= 1.The standard way =
* In your WordPress Admin, go to menu Plugins > Add
* Search for "Password Protect WordPress"
* Click to install
* Activate the plugin
* Password Protect WordPress Lite

= 2.The nerdy way =
* Download the plugin (.zip file) on the right column of this page
* In your WordPress Admin, go to menu Plugins > Add
* Select the tab "Upload"
* Upload the .zip file you just downloaded
* Activate the plugin
* Password Protect WordPress Lite


== Frequently Asked Questions ==

= I’ve installed Password Protect WordPress plugin. What should I do next? =

Once our plugin is activated, you can start [password protecting your WordPress pages and posts](https://passwordprotectwp.com/docs/password-protect-wordpress-lite/?utm_source=wp.org&utm_medium=faq-link&utm_campaign=ppwp-lite) right way.

= Which users roles can I password protect against? =

Our plugin allows you to password protect your pages or posts against all roles created under WordPress users.

= Does the plugin password protect WooCommerce products? =

Yes, the Pro version helps [password protect any WordPress custom post types](https://passwordprotectwp.com/docs/password-protect-wordpress-custom-post-types/?utm_source=wp.org&utm_medium=faq-link&utm_campaign=ppwp-lite), including WooCommerce product pages.

= Will my password protected content show up in Google search results? =

No, your content won’t appear on Google and other search engine results once password protected by the Pro version. The Free version doesn't [block search engines from finding and indexing your content](https://passwordprotectwp.com/docs/block-google-search-indexing/?utm_source=wp.org&utm_medium=faq-link&utm_campaign=ppwp-lite).

= Can I password protect parts of WordPress page content? =

Yes, you can [secure parts of your post and page content](https://passwordprotectwp.com/docs/password-protect-wordpress-content-sections/?utm_source=wp.org&utm_medium=faq-link&utm_campaign=ppwp-lite) with a password using our [ppwp] shortcode.

= Why do I still see the password form after entering the correct password? =

It looks like your content is cached. You'll need to [configure your caching plugin or cache server](https://passwordprotectwp.com/docs/caching-plugins-cache-servers-integration/?utm_source=wp.org&utm_medium=faq-link&utm_campaign=ppwp-lite) in order for our plugin to work properly.

= Can I protect child pages automatically? =

Our Pro version of Password Protect WordPress enables you to [automatically password protect child pages](https://passwordprotectwp.com/docs/password-protect-sub-pages-and-categories/?utm_source=wp.org&utm_medium=faq-link&utm_campaign=ppwp-lite) once the parent page is locked up.

== Screenshots ==

1. Protect your private pages and posts with multiple passwords.

2. Protect your private pages and posts by user roles. You can create one password per role with our Free version but unlimited passwords with our Pro version.

3. Users don't need to re-enter password when accessing your private content until its cookies expire. Simply change the default value under our plugin's Settings page.

4. It's easy to password protect your whole site with our plugin. Users are required to enter password when accessing any pages or posts including the homepage.

5. Copy and add the shortcode into your page or post. Remember replace "Your content" with that you want to protect.

6. This is what your post will look like after published. Visitors have to enter "password1" or "password2" to access the protected content.

== Upgrade Notice ==

N/A

== Changelog ==

= 1.2.3.1 =

* Change Whitelist Roles -> Whitelisted Roles
* Write unit test for part of content and password core service classes
* Apply unit test in building and development process
* Handle password form WooCommerce product when remove "woocommerce_before_single_product"
* Run automation test of Pro version in building and deployment process
* Show error and UI displays wrong
* Unprotected post becomes protected when activating PPWP Pro
* Fix not update post in gutenberg when use ppw

= 1.2.3 =

* HotFix for debug mode flag

= 1.2.2 =

* HotFix for debug mode flag

= 1.2.1 =

* Optimize & Remove Unnecessary CSS & JS files
* Fix issue with the_password_form
* Show error message under password field
* Add new feature part of the content password protection

= 1.2.0 =
* Revamp the architecture design

= 1.1.2.2 =
* Fatal error when activating Pro & Lite version
* Show notification when enter wrong password

= 1.1.2.1 =
* Password Protect Entire Site is enabled but the password field is empty
* Password Protect Entire Site doesn't work if Cookies Expiration Time is more than 9999 days
* WP logo is missing on sub pages
* Can't submit after error notification display in Chrome
* Auto login a protected page without entering password
* The page reloads after entering the correct password
* Integrate with WP Fastest Cache
* Integrate with W3 Total Cache
* Integrate with WP Super Cache
* Show notice not work with sites use caching
* Update the text when visitors can't see the password field
* Support users which have multiple roles

= 1.1.2 =
* Separate the password protected by roles from the page's content update.
* Set password for Admin, when log-in by Editor then not enter the password.
* Resolve the data conflict between gold and free version

= 1.1.1 =
* Add new features that user can set the post's visibility with multiple passwords.
* Change cookies lifetime to 1 day.
* Enhance the css for the metabox.

= 1.0.0 =
* Add UI in the pages/posts that allow users to set a password for each user roles.
