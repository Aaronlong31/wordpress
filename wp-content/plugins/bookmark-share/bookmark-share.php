<?php
/*
Plugin Name: Bookmarkcn & Share
Plugin URI: http://fairyfish.net/2008/01/19/bookmark-share-plugin/
Description: Bookmarkcn & Share
Version:1.0
Author: Denis
Author URI: http://fairyfish.net/
*/
$auto_add_to_single = 1;
$auto_add_to_feed = 1;

function get_bookmark_share_string(){
	global $post;
	$keywords	= "";		
	$tags = wp_get_post_tags($post->ID);
	foreach ($tags as $tag ) {
		$keywords = $keywords . $tag->name . ", ";
	}

	$bookmark_share_string = ' <p><a href="http://fairyfish.net/bookmark/?url='. get_permalink($post->ID) . '&title=' . urlencode(wptexturize($post->post_title)) . '&tags='. $keywords. '"><img src="'.get_settings('siteurl').PLUGINDIR . '/' . dirname(plugin_basename (__FILE__)).'/bookmark.gif" alt="bookmark" /></a></p>';
	return $bookmark_share_string;
}

function bookmark_share(){
	$bookmark_share_string = get_bookmark_share_string();
	echo $bookmark_share_string;
}

function auto_bookmark_share($content="") {
	global $auto_add_to_feed, $auto_add_to_single;
	$bookmark_share_string = get_bookmark_share_string();
	
	if (is_single() && $auto_add_to_single) {
		$content = $content .$bookmark_share_string;
	}
	
	if ( is_feed() && $auto_add_to_feed) {
			$content = $content .$bookmark_share_string;
	}
	
	return $content;
}

if($auto_add_to_feed || $auto_add_to_single){
	add_filter('the_content', 'auto_bookmark_share',99);
}
?>