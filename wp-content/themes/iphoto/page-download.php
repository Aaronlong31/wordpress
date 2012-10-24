<?php ob_start();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<?php wp_head(); ?>
</head>
<body>
<?php
	if((current_user_can('level_0'))){
		if(isset($_GET['dl'])){
			$id = $_GET['dl'];
			$id = (int) base64_decode($id)-10;
			$file = 'wp-content/dl/'.$id.'.zip';
			if (file_exists($file)) {
				header('Content-Description: File Transfer');   
				header('Content-Type: application/octet-stream');   
				header('Content-Disposition: attachment; filename='.basename($file));   
				header('Content-Transfer-Encoding: binary');   
				header('Expires: 0');   
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');   
				header('Pragma: public');   
				header('Content-Length: ' . filesize($file));   
				ob_clean();   
				flush();   
				readfile($file);   
				exit;   
			}else{
				die("文件不存在");
			}
		}
	}else{
		wp_redirect(get_option('home'));
	}
?>
<?php wp_footer(); ?>
</body>
</html>