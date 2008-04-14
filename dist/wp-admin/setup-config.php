<?php
define('WP_INSTALLING', true);
//These two defines are required to allow us to use require_wp_db() to load the database class while being wp-content/wp-db.php aware
define('ABSPATH', dirname(dirname(__FILE__)).'/');
define('WPINC', 'wp-includes');

require_once('../wp-includes/compat.php');
require_once('../wp-includes/functions.php');
require_once('../wp-includes/classes.php');

if (!file_exists('../wp-config-sample.php'))
	wp_die('对不起, 找不到 wp-config-sample.php 文件. 请重新上传 WordPress 根目录下的此文件.');

$configFile = file('../wp-config-sample.php');

if ( !is_writable('../'))
	wp_die("对不起, 当前目录不可写入. 请把 WordPress 目录设置为可写，或者手动修改 wp-config.php 配置文件.");

// Check if wp-config.php has been created
if (file_exists('../wp-config.php'))
	wp_die("<p>配置文件 'wp-config.php' 已经存在. 如果你希望重新设置，请删除现有的配置文件. 如果你确定配置文件内容无误，也可以 <a href='install.php'>开始安装</a>.</p>");

if (isset($_GET['step']))
	$step = $_GET['step'];
else
	$step = 0;

function display_header(){
	header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WordPress &rsaquo; 安装 &rsaquo; 配置文件</title>
<link rel="stylesheet" href="<?php echo $admin_dir; ?>css/install.css" type="text/css" />

</head>
<body>
<h1 id="logo"><img alt="WordPress" src="images/wordpress-logo.png" /></h1>
<?php
}//end function display_header();

switch($step) {
	case 0:
		display_header();
?>

<p>欢迎使用 WordPress. 开始安装之前，需要先配置数据库. 你需要提供以下的信息:</p>
<ol>
	<li>数据库名</li>
	<li>数据库用户名</li>
	<li>用户密码</li>
	<li>数据库主机</li>
	<li>数据库表格前缀 (如果要在一个数据库内安装多个WordPress，请给每个安装一个前缀) </li>
</ol>
<p><strong>如果这个向导没有成功生成配置文件, 也请不要担心. 这一个步骤可以通过手动完成: 首先用任何文本编辑器打开 <code>wp-config-sample.php</code> 文件, 按照提示填入你的数据库信息, 另存为 <code>wp-config.php</code> 文件即可. </strong></p>
<p>正常情况下, 所有这些信息都可以从主机提供商获得. 如果你还没有这些信息, 请和主机提供商联系. 如果你已经准备好了，那就</p>

<p><a href="setup-config.php?step=1" class="button">开始数据库配置!</a></p>
<?php
	break;

	case 1:
		display_header();
	?>
<form method="post" action="setup-config.php?step=2">
	<p>请在下面输入你的数据库信息. 如果你对这些信息不太清楚, 请联系主机提供商. </p>
	<table class="form-table">
		<tr>
			<th scope="row">数据库名</th>
			<td><input name="dbname" type="text" size="25" value="wordpress" /></td>
			<td>要安装WordPress的数据库名称. </td>
		</tr>
		<tr>
			<th scope="row">用户名</th>
			<td><input name="uname" type="text" size="25" value="username" /></td>
			<td>你的 MySQL 数据库用户名</td>
		</tr>
		<tr>
			<th scope="row">密码</th>
			<td><input name="pwd" type="text" size="25" value="password" /></td>
			<td>... MySQL 用户密码.</td>
		</tr>
		<tr>
			<th scope="row">数据库主机</th>
			<td><input name="dbhost" type="text" size="25" value="localhost" /></td>
			<td>主机的地址。99% 的情况下，用默认的即可。</td>
		</tr>
		<tr>
			<th scope="row">数据库表格前缀</th>
			<td><input name="prefix" type="text" id="prefix" value="wp_" size="25" /></td>
			<td>如果要在一个数据库内安装多个WordPress，请给每个安装一个前缀.</td>
		</tr>
	</table>
	<h2 class="step">
	<input name="submit" type="submit" value="提交" class="button" />
	</h2>
</form>
<?php
	break;

	case 2:
	$dbname  = trim($_POST['dbname']);
	$uname   = trim($_POST['uname']);
	$passwrd = trim($_POST['pwd']);
	$dbhost  = trim($_POST['dbhost']);
	$prefix  = trim($_POST['prefix']);
	if (empty($prefix)) $prefix = 'wp_';

	// Test the db connection.
	define('DB_NAME', $dbname);
	define('DB_USER', $uname);
	define('DB_PASSWORD', $passwrd);
	define('DB_HOST', $dbhost);

	// We'll fail here if the values are no good.
	require_wp_db();
	if ( !empty($wpdb->error) )
		wp_die($wpdb->error->get_error_message());

	$handle = fopen('../wp-config.php', 'w');

	foreach ($configFile as $line_num => $line) {
		switch (substr($line,0,16)) {
			case "define('DB_NAME'":
				fwrite($handle, str_replace("putyourdbnamehere", $dbname, $line));
				break;
			case "define('DB_USER'":
				fwrite($handle, str_replace("'usernamehere'", "'$uname'", $line));
				break;
			case "define('DB_PASSW":
				fwrite($handle, str_replace("'yourpasswordhere'", "'$passwrd'", $line));
				break;
			case "define('DB_HOST'":
				fwrite($handle, str_replace("localhost", $dbhost, $line));
				break;
			case '$table_prefix  =':
				fwrite($handle, str_replace('wp_', $prefix, $line));
				break;
			default:
				fwrite($handle, $line);
		}
	}
	fclose($handle);
	chmod('../wp-config.php', 0666);

	display_header();
?>
<p>完成所有的数据库配置！WordPress 已经成功连接到你的数据库. 一切就绪，还等什么呢？</p>

<p><a href="install.php" class="button">开始安装</a></p>
<?php
	break;
}
?>
</body>
</html>
