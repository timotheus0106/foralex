<?php
class Mbi_WPOptimizr {
    function __construct() {

    	//remove unnecessary scripts
    	add_action('init', array($this, 'cleanupHead'), 1);

    	//remove default widgets
    	add_action('widgets_init', array($this, 'unregisterDefaultWidgets'), 1);
    }

    function unregisterDefaultWidgets(){
	    unregister_widget('WP_Widget_Pages');
			unregister_widget('WP_Widget_Calendar');
			unregister_widget('WP_Widget_Archives');
			unregister_widget('WP_Widget_Links');
			unregister_widget('WP_Widget_Meta');
			unregister_widget('WP_Widget_Search');
			unregister_widget('WP_Widget_Text');
			unregister_widget('WP_Widget_Categories');
			unregister_widget('WP_Widget_Recent_Posts');
			unregister_widget('WP_Widget_Recent_Comments');
			unregister_widget('WP_Widget_RSS');
			unregister_widget('WP_Widget_Tag_Cloud');
    }

    function cleanupHead(){
			remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
			remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
			remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
			remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
			remove_action('wp_head', 'index_rel_link'); // Index link
			remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
			remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
			remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current
			remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
			remove_action('wp_head', 'start_post_rel_link', 10, 0);
			remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
			remove_action('wp_head', 'rel_canonical');
			remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

			global $wp_widget_factory;
			remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
		}

}

$MbiWPOptimizr = new Mbi_WPOptimizr(); ?>
