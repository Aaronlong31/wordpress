<?php ob_start();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<?php include('includes/seo.php'); ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/post.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="http://mufeng.me/favicon.ico" type="image/x-icon" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
if(isset($_POST['new_post']) == '1') {
    $post_title = $_POST['post_title'];
    $post_category = $_POST['cat'];
	$post_tags = preg_split('#\s+#',$_POST['post_tags']);
    $post_content = $_POST['post_content'];
	$post_content = save_post_pic($post_content);
    $new_post = array(
          'ID' => '',
          'post_author' => $user->ID, 
          'post_category' => array($post_category),
		'tags_input' => $post_tags,
          'post_content' => $post_content, 
          'post_title' => $post_title,//pending
          'post_status' => 'publish'
        );
    $post_id = wp_insert_post($new_post);
	$post = get_post($post_id);
	wp_redirect('http://mufeng.me/photo/?page_id=972&action=complete');
}
?>
	<?php if( isset($_GET['action'])&& $_GET['action'] == 'new' && $_GET['src'] && $_GET['title'] ) :?>
		<?php if (is_user_logged_in()){ ?>
		<div id="new-post">
			<form method="post" action="">
				<div id="left">
					<div id="img-preview"><img src="<?php echo $_GET['src'];?>" /></div>
				</div>
				<div id="right">
					<h3>标题:<input type="text" name="post_title" size="50" id="input-title" value="<?php echo $_GET['title'];?>"/></h3>
					<h3>分类:<?php wp_dropdown_categories('orderby=name&hide_empty=0&hierarchical=1'); ?></h3>
					<h3>标签:<input type="text" name="post_tags" size="45" id="input-tags"/></h3>
					<textarea hidden rows="5" name="post_content" cols="66" id="text-desc"><a href="<?php echo $_GET['src'];?>"><img src="<?php echo $_GET['src'];?>" /></a></textarea>
					<input id="newsubmit" class="subput round" type="submit" name="submit" value="发布"/>
				</div>
				<input type="hidden" name="new_post" value="1"/> 
				<div class="clear"></div>
			</form>
		</div>
		<?php }?>
	<?php elseif( isset($_GET['action'])&& $_GET['action'] == 'complete' ) :?>
		<div id="new-post">
			<p>成功发布</p>
			<script type="text/javascript">
			function closeWindow(){
				var browserName = navigator.appName;
				if (browserName == "Netscape") {
					window.open('', '_parent', '');
					window.close();
				} else if (browserName == "Microsoft Internet Explorer") {
					window.opener = "whocares";
					window.close();
				}
			}
			setTimeout(closeWindow,3000)
			</script>
		</div>
	<?php else:?>
		<?php wp_redirect('http://mufeng.me/photo');?>
	<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>