<?php
/**
 * Content control.
 *
 * @package Dealers\Core
 */

namespace Dealers\Content;

class Control {

    const PLUGIN_ID = 'Dealers';

    /**
     * Constructor. Initializes class autoload.
     */
    public function __construct() {

        add_shortcode('dealer-dir', [$this, 'dealerDir']);
        add_filter('the_posts', [$this, 'enqueueScriptStylesWithShortcode']);
    }

    /**
     * Shortcode content.
     *
     * @return string
     */
    public function dealerDir(): string
    {
        global $cities,
               $posts_query;

        ob_start();

        $cities = get_terms('cities');

        $args = array(
            'post_type'         => 'dealers',
            'post_status'       => 'publish',
            'posts_per_page'    => -1,
        );

        $posts_query = new \WP_Query( $args );

        if ($posts_query->have_posts()) {
            require_once __DIR__ . '/../../templates/dealers-section.php';
        }

        return ob_get_clean();
    }

    /**
     * Get info single dealer by post id.
     *
     * @param $post_id
     * @return array
     */
    public function getDealerSingleInfo($post_id): array
    {
        $post_info = [];
        $cities = [];

        $post_cities = wp_get_post_terms($post_id, 'cities');

        foreach ($post_cities as $city) {
            $cities[] = $city->term_id;
        }

        $post_info['cities'] = !empty($cities)
            ? json_encode($cities)
            : '';

        $post_info['title'] = get_the_title($post_id);
        $post_info['content'] = apply_filters('the_content', get_the_content($post_id));

        return $post_info;
    }

    /**
     * Enqueue styles and scripts by isset shortcode in post.
     *
     * @param $posts
     * @return mixed
     */
    public function enqueueScriptStylesWithShortcode($posts) {

        $shortcode_name = 'dealer-dir';

        foreach( $posts as $post ){

            if( has_shortcode( $post->post_content, $shortcode_name ) ){

                add_action('wp_enqueue_scripts', [$this, 'pluginStyles']);
                add_action('wp_enqueue_scripts', [$this, 'pluginScripts']);
                break;
            }
        }

        return $posts;
    }

    /**
     * Register plugin styles.
     *
     * @return void
     */
    public function pluginStyles() {

        wp_enqueue_style(
            self::PLUGIN_ID . '-grid-css',
            PLUGIN_DIR . 'assets/css/grid.css',
            [],
            PLUGIN_VSN,
            'all' );

        wp_enqueue_style(
            self::PLUGIN_ID . '-elements-css',
            PLUGIN_DIR . 'assets/css/elements.css',
            [],
            PLUGIN_VSN,
            'all' );
    }

    /**
     * Register plugin scripts.
     *
     * @return void
     */
    public function pluginScripts() {

        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', false, null, true);
        wp_enqueue_script('jquery');

        wp_enqueue_script(
            self::PLUGIN_ID . '-main.js',
            PLUGIN_DIR . 'assets/js/main.js',
            [],
            PLUGIN_VSN,
            true);
    }
}
