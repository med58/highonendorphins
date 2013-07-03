<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'highonendorphins');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '@Q<{g-Z|GK1%M8k8$7* g -h[u@U64KH@E~2!8V~M/]293.(WzQwIo(uN8ioO1U1');
define('SECURE_AUTH_KEY',  'Zx-S>.NQvLI5>~|e($6Q(j~lNy?OwwGBE{}vn{)EB:36!6A/[+$.B71esY500-`w');
define('LOGGED_IN_KEY',    '||7Gq^|~v,^.$<PJ<Xv|_b4HpY+I(GjgA4pq+rs8{:PRFq?uGm3GN&HF8cLxktPC');
define('NONCE_KEY',        '+j1^l97FRp oy[*jF?eR2L;l9oWgOGPRi_y[@Aty~]2e2IZ0cXu_ cI4>@8O)|!e');
define('AUTH_SALT',        '7=*:F_4|XGW1djZb{C@!C<hjmzG4%hpW9!~=0UQZ;_9s2~i1:-:iK^!+o8PW82:=');
define('SECURE_AUTH_SALT', '0T]s*rL2ejL+B [u%(+PD:5+UyZXl>$hO:{Yg3p|==sX-ZVgIDA;.jr92-hftEPx');
define('LOGGED_IN_SALT',   'omFK=-R|*$y/-ergzp#+7{>iV6rT%|(,A,A`+$t8QzDmCVaSt,JsGt9ZH1<)I:_N');
define('NONCE_SALT',       'LbKN9ZG7sH$NVn0H!`1q<TET*e#{i]WP<dUZHyR6O|99BIbeU6eIi.HoY4dV-SMr');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
