<?php
/** 
 * WordPress���������ļ���
 *
 * ���ļ�������������ѡ��: MySQL����, ���ݿ����ǰ׺,
 * �ܳ�, WordPress�����趨�Լ�ABSPATH. ���������Ϣ�������
 * {@link http://codex.wordpress.org/Editing_wp-config.php �༭
 * wp-config.php}Codex. MySQL���þ�����Ϣ����ѯ���Ŀռ��ṩ�̡�
 *
 * ����ļ������ڰ�װ�����Զ����� wp-config.php �����ļ���
 * ������ֶ���������ļ�����������Ϊ wp-config.php��Ȼ�����������Ϣ��
 *
 *
 * @package WordPress
 */

// ** MySQL���� - ������Ϣ����������ʹ�õ����� ** //
/** WordPress���ݿ�����ƣ��滻�� ��putyourdbnamehere�� */
define('DB_NAME', 'putyourdbnamehere');

/** MySQL���ݿ��û������滻�� ��usernamehere�� */
define('DB_USER', 'usernamehere');

/** MySQL���ݿ����룬�滻�� ��yourpasswordhere�� */
define('DB_PASSWORD', 'yourpasswordhere');

/** MySQL������ */
define('DB_HOST', 'localhost');

/** �������ݱ�ʱĬ�ϵ����ֱ��� */
define('DB_CHARSET', 'utf8');

/** ���ݿ��������͡��粻ȷ��������� */
define('DB_COLLATE', '');

/**#@+
 * ����ܳ��趨��
 *
 * ����������дһЩ�ַ�
 * ����ֱ�ӷ��� {@link https://api.wordpress.org/secret-key/1.1/ WordPress.org Secret-keyҳ�潫�Զ�Ϊ�����ɣ��κ��޸Ķ��ᵼ��cookiesʧЧ�������û��������µ�¼}
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '�滻���ַ���');
define('SECURE_AUTH_KEY', '�滻���ַ���');
define('LOGGED_IN_KEY', '�滻���ַ���');
define('NONCE_KEY', '�滻���ַ���');
/**#@-*/

/**
 * WordPress���ݱ�ǰ׺��
 *
 * ���������ͬһ���ݿ��ڰ�װ��� WordPress ��������Ϊÿ�� WordPress ���ò�ͬ�����ݱ�ǰ׺��
 * ǰ׺��ֻ��Ϊ���֡���ĸ���»��ߡ�
 */
$table_prefix  = 'wp_';

/**
 * WordPress�������á�Ĭ��ΪӢ�
 *
 * �����趨�ܹ��� WordPress ��ʾ����Ҫ�����ԡ�wp-content/languages ��Ӧ����ͬ���� .mo �����ļ���
 * Ҫʹ�� WordPress �������Ľ��棬ֻ������ zh_CN��
 */
define ('WPLANG', 'zh_CN');

/* �趨��ϣ��뱣����ļ��� */

/** WordPressĿ¼�ľ���·���� */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** ����WordPress�����Ͱ����ļ��� */
require_once(ABSPATH . 'wp-settings.php');
?>
