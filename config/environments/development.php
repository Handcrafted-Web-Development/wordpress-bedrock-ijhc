<?php
/**
 * Configuration overrides for WP_ENV === 'development'
 */

use Roots\WPConfig\Config;
use function Env\env;

/**
 * Debugging Settings
 */
Config::define('WP_DEBUG_DISPLAY', false);
Config::define('SCRIPT_DEBUG', false);

/**
 * Debugging Settings
 */
$dir_logs = dirname(__DIR__, 2) . '/web/_logs/';

if (!file_exists($dir_logs)) :
    mkdir($dir_logs, 0775, true);
    ini_set('log_errors', 1);
    ini_set('display_errors', 0);
    date_default_timezone_set("Europe/Paris");
    ini_set('error_log', $dir_logs . 'debug-' . date('Ymd') . '.log');
    ini_set('error_reporting', E_ALL ^ E_NOTICE);
endif;

$files = scandir($dir_logs, SCANDIR_SORT_DESCENDING);
if (count($files) > 5) :
    for ($i = 5; $i < count($files); $i++) :
        if (stripos($files[$i], '.') != 0) :
            unlink($dir_logs . $files[$i]);
        endif;
    endfor;
endif;

ini_set('display_errors', '0');

// Enable plugin and theme updates and installation from the admin
Config::define('DISALLOW_FILE_MODS', false);
