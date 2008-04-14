<?php
// ** MySQL settings ** //
define('DB_NAME', 'putyourdbnamehere');    // The name of the database 数据库名
define('DB_USER', 'usernamehere');     // Your MySQL username 数据库用户名
define('DB_PASSWORD', 'yourpasswordhere'); // ...and password 用户密码
define('DB_HOST', 'localhost');    // 99% chance you won't need to change this value 数据库主机名，一般不用修改
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// Change SECRET_KEY to a unique phrase.  You won't have to remember it later,
// so make it long and complicated.  You can visit https://www.grc.com/passwords.htm
// to get a phrase generated for you, or just make something up.
define('SECRET_KEY', 'put your unique phrase here'); // Change this to a unique phrase.

// You can have multiple installations in one database if you give each a unique prefix
$table_prefix  = 'wp_';   // Only numbers, letters, and underscores please!

// Change this to localize WordPress.  A corresponding MO file for the
// chosen language must be installed to wp-content/languages.
// For example, install de.mo to wp-content/languages and set WPLANG to 'de'
// to enable German language support.
// 语言设置，如果要恢复使用英文，请改为 define ('WPLANG', '');
define ('WPLANG', 'zh_CN');

/* That's all, stop editing! Happy blogging. 下面的几行请不要修改！*/

define('ABSPATH', dirname(__FILE__).'/');
require_once(ABSPATH.'wp-settings.php');
?>
