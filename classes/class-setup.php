<?php
/**
 * Setup plugin features and core functions.
 *
 * @package Dealers\Core
 */

namespace Dealers;

/**
 * Setup plugin main features
 *
 * @package Dealers
 */
class Setup {

    /**
     * Constructor.
     */
    public function __construct() {

        define( 'PLUGIN_VSN', 'v1.0.0' );

        add_theme_support('post-thumbnails');

        add_action('admin_menu', [$this, 'wpExplorerRemoveMenus']);
    }

    public function wpExplorerRemoveMenus() {
        remove_menu_page( 'edit.php' );
    }

}
