<?php

use ijhc\functions\admin\AdminBar;
use ijhc\functions\admin\Comments;
use ijhc\functions\admin\Dashboard;

defined('ABSPATH') or exit;

/**
 * Appel des classes
 * **************************************************
 */
$admin_files = [
    'functions/admin/AdminBar.php',
    'functions/admin/Comments.php',
    'functions/admin/Dashboard.php',
];

foreach ($admin_files as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion'), $file), E_USER_ERROR);
    }

    require_once $filepath;
}


/**
 * Déclarations
 * **************************************************
 */
new AdminBar();
new Comments();
new Dashboard();
