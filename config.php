<?php
error_reporting(E_ALL ^ E_NOTICE);
# MYSQL CONNECTION INFO
define('DB_HOST', "localhost");
define('DB_USER', "");
define('DB_PASS', "");
define('DB_NAME', "");
# -----------------------------------------------------------------------------+
# CONSTANTS
define('BLOG_ENCODING', "UTF-8");
define('WEBSITE_KEYWORDS', "blog, site, about, news");
define('FOOTER_COPYRIGHT', "Copyright © 2012-2014. Powered by <a href='index.html'>SMVC v2014</a> with CleanTheme 1.0. | <a href='#'>Sitemap</a>");
define('NOREPLAY_EMAIL', "noreplay@smvc.bg");
define('NEWS_PER_PAGE', 1);
# -----------------------------------------------------------------------------+
# DATABASE TABLES
define('TABLE_PREFIX', 'smvc2014_');
define('NEWS_TABLE', TABLE_PREFIX . 'news');
define('USERS_TABLE', TABLE_PREFIX . 'users');
define('ABOUT_TABLE', TABLE_PREFIX . 'about');
define('CONFIG_TABLE', TABLE_PREFIX . 'config');
# -----------------------------------------------------------------------------+
# MENU 
$menu = array(
    'index.php' => 'Начало',
    'index.php?url=about&method=getAbout' => 'Информация',
    'index.php?url=user&method=membersList' => 'Потребители',
);
# -----------------------------------------------------------------------------+

header('Content-Type: text/html; charset=UTF-8');

# INCLUDES
require($blog_root_path . 'libs/Bootstrap.php');
require($blog_root_path . 'libs/Libs.php');
require($blog_root_path . 'libs/Model.php');
require($blog_root_path . 'libs/Session.php');
require($blog_root_path . 'libs/Database.php');
require($blog_root_path . 'libs/Controller.php');
require($blog_root_path . 'libs/View.php');
require($blog_root_path . 'libs/Pagination.php');
# -----------------------------------------------------------------------------+
# START SESSION
Session::startSess();
