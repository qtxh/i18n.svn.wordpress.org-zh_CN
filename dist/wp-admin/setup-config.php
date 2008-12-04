<?php
/**
 * Retrieves and creates the wp-config.php file.
 *
 * The permissions for the base directory must allow for writing files in order
 * for the wp-config.php to be created using this page.
 *
 * @package WordPress
 * @subpackage Administration
 */

/**
 * We are installing.
 *
 * @package WordPress
 */
define('WP_INSTALLING', true);

/**#@+
 * These three defines are required to allow us to use require_wp_db() to load
 * the database class while being wp-content/db.php aware.
 * @ignore
 */
define('ABSPATH', dirname(dirname(__FILE__)).'/');
define('WPINC', 'wp-includes');
define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
/**#@-*/

require_once('../wp-includes/compat.php');
require_once('../wp-includes/functions.php');
require_once('../wp-includes/classes.php');

if (!file_exists('../wp-config-sample.php'))
	wp_die('��ʾ��δ�ܼ�⵽ wp-config-sample.php �ļ�����ȷ�ϸ�Ŀ¼���ڴ��ļ��������ϴ���');

$configFile = file('../wp-config-sample.php');

if ( !is_writable('../'))
	wp_die("��ʾ��Ŀ¼����д�������Ŀ¼���Ի����ֶ����� wp-config.php��");

// Check if wp-config.php has been created
if (file_exists('../wp-config.php'))
	wp_die("<p>'wp-config.php' �ļ��Ѵ��ڡ����������� wp-config.php �����е��趨������ɾ���������򵼻����´��� wp-config.php��<a href='install.php'>����</a>��</p>");

// Check if wp-config.php exists above the root directory
if (file_exists('../../wp-config.php') && ! file_exists('../../wp-load.php'))
	wp_die("<p>'wp-config.php' �Ѵ����ڸ���һ����Ŀ¼�ڡ����������� wp-config.php �����е��趨������ɾ���������򵼻����´��� wp-config.php�� <a href='install.php'>����</a>��</p>");

if (isset($_GET['step']))
	$step = $_GET['step'];
else
	$step = 0;

/**
 * Display setup wp-config.php file header.
 *
 * @ignore
 * @since 2.3.0
 * @package WordPress
 * @subpackage Installer_WP_Config
 */
function display_header() {
	header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WordPress &rsaquo; ��װ��</title>
<link rel="stylesheet" href="css/install.css" type="text/css" />

</head>
<body>
<h1 id="logo"><img alt="WordPress" src="images/wordpress-logo.png" /></h1>
<?php
}//end function display_header();

switch($step) {
	case 0:
		display_header();
?>

<p>W��ӭ���� WordPress �����磡��ʽ��ʼ֮ǰ��������ҪһЩ�������ݿ����Ϣ����ȷ�����Ѿ�ӵ��������Ϣ��</p>
<ol>
	<li>���ݿ�����</li>
	<li>���ݿ��û���</li>
	<li>���ݿ�����</li>
	<li>���ݿ�������ַ</li>
	<li>���ݱ�ǰ׺���������Ҫ��ͬһ���ݿ��ڰ�װ��� WordPress �Ļ���</li>
</ol>
<p><strong>����޷�������һ�������ż������򵼵�Ŀ�����ڴ��� Wordpress �������ļ���������������ֱ�����ı��༭���� <code>wp-config-sample.php</code>��������ʾ��д��Ӧ��Ϣ��Ȼ�󱣴沢����������Ϊ <code>wp-config.php</code>��</strong></p>
<p>��������£����Ŀռ��̻��֪���ݿ���й���Ϣ���������̫�����������ϵ���Ŀռ��̡�����Ѿ�׼������ &hellip;</p>

<p class="step"><a href="setup-config.php?step=1" class="button">��ô���ڿ�ʼ��</a></p>
<?php
	break;

	case 1:
		display_header();
	?>
<form method="post" action="setup-config.php?step=2">
	<p>��Ӧ��������ı��������Ӧ�����ݿ���Ϣ����ȷ������Ŀ����ϵ���Ŀռ���ȷ�ϡ�</p>
	<table class="form-table">
		<tr>
			<th scope="row"><label for="dbname">���ݿ�����</label></th>
			<td><input name="dbname" id="dbname" type="text" size="25" value="wordpress" /></td>
			<td>���ڴ洢 WordPress ���ݵ����ݿ����ơ�</td>
		</tr>
		<tr>
			<th scope="row"><label for="uname">���ݿ��û���</label></th>
			<td><input name="uname" id="uname" type="text" size="25" value="username" /></td>
			<td>���� MySQL �û���</td>
		</tr>
		<tr>
			<th scope="row"><label for="pwd">���ݿ�����</label></th>
			<td><input name="pwd" id="pwd" type="text" size="25" value="password" /></td>
			<td>...�Լ� MySQL ����</td>
		</tr>
		<tr>
			<th scope="row"><label for="dbhost">���ݿ��ַ</label></th>
			<td><input name="dbhost" id="dbhost" type="text" size="25" value="localhost" /></td>
			<td>�󲿷����������޸ġ�</td>
		</tr>
		<tr>
			<th scope="row"><label for="prefix">���ݱ�ǰ׺</label></th>
			<td><input name="prefix" id="prefix" type="text" id="prefix" value="wp_" size="25" /></td>
			<td>�������ͬһ���ݿ��ڰ�װ��� WordPress ����������Ĵ��</td>
		</tr>
	</table>
	<p class="step"><input name="submit" type="submit" value="�����" class="button" /></p>
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
	/**#@+
	 * @ignore
	 */
	define('DB_NAME', $dbname);
	define('DB_USER', $uname);
	define('DB_PASSWORD', $passwrd);
	define('DB_HOST', $dbhost);
	/**#@-*/

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
<p>��ϲ��WordPress �����ݿ�������Ѿ�������׼�����ˣ� ��ʼ &hellip;</p>

<p class="step"><a href="install.php" class="button">��װ��</a></p>
<?php
	break;
}
?>
</body>
</html>
