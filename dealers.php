<?php
/*
 * Plugin Name: Дилеры
 * Description: TestWork Plugin
 * Author URI: https://t.me/omelson
 * Author: Melson
 * Version: 1.0
 *
 * Requires PHP: 7.2
 */

define( 'PLUGIN_DIR', plugin_dir_url(__FILE__ ) );

require_once __DIR__ . '/classes/class-core.php';

/**
 * Returns instance of plugin's main class.
 *
 * @return \Dealers\Core
 */
function TC() : \Dealers\Core {
    return \Dealers\Core::instance();
}
TC();
