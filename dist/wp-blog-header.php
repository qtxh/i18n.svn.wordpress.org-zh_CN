<?php

if (! isset($wp_did_header)):
if ( !file_exists( dirname(__FILE__) . '/wp-config.php') ) {
	if (strpos($_SERVER['PHP_SELF'], 'wp-admin') !== false) $path = '';
	else $path = 'wp-admin/';

	require_once( dirname(__FILE__) . '/wp-includes/classes.php');
	require_once( dirname(__FILE__) . '/wp-includes/functions.php');
	require_once( dirname(__FILE__) . '/wp-includes/plugin.php');
	wp_die("找不到 <code>wp-config.php</code> 配置文件. WordPress需要有这个配置文件才能正常工作。如果需要帮助，请参考 <a href='http://codex.wordpress.org/Editing_wp-config.php'>说明文档(英文)</a>. 如果您要开始安装WordPress，可以通过向导开始配置 <code>wp-config.php</code> 文件，但是由于各个服务器配置的不同，向导有可能在一些主机上不能正常工作，如果出现这种情况，请手工创建配置文件.</p><p><a href='{$path}setup-config.php' class='button'>开始配置向导</a>", "WordPress &rsaquo; 错误");
}

$wp_did_header = true;

require_once( dirname(__FILE__) . '/wp-config.php');

wp();

require_once(ABSPATH . WPINC . '/template-loader.php');

endif;

?>
