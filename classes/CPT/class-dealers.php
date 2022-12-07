<?php
/**
 * Init and control CPT Dealers
 *
 * @package Dealers\Core
 */

namespace Dealers\CPT;

class Dealers {

    /**
     * Constructor. Initializes class autoload.
     */
    public function __construct() {

        add_action('init', [$this, 'createTaxonomies'], 90);
        add_action('init', [$this, 'register']);
    }

    /**
     * Register custom post type.
     */
    public function register() {

        $labels = [
            'name'                  => 'Каталог дилеров',
            'singular_name'         => 'Дилер',
            'menu_name'             => 'Каталог дилеров',
            'name_admin_bar'        => 'Каталог дилеров',
            'archives'              => 'Дилеры',
            'label'                 => 'Дилеры',
            'description'           => 'Дилеры',
            'attributes'            => 'Атрибуты дилера',
            'parent_item_colon'     => 'Родительская запись:',
            'all_items'             => 'Все дилеры',
            'add_new_item'          => 'Добавить нового дилера',
            'add_new'               => 'Добавить дилера',
            'new_item'              => 'Новый дилер',
            'edit_item'             => 'Редактировать дилера',
            'update_item'           => 'Обновить дилера',
            'view_item'             => 'Посмотреть дилера',
            'view_items'            => 'Посмотреть дилера',
            'search_items'          => 'Поиск дилеров',
            'not_found'             => 'Не найдено',
            'not_found_in_trash'    => 'Не найдено в корзине',
            'featured_image'        => 'Изображение',
            'set_featured_image'    => 'Установить изображение',
            'remove_featured_image' => 'Удалить изображение',
            'use_featured_image'    => 'Использовать как изображение записи',
            'insert_into_item'      => 'Вставить в запись',
            'uploaded_to_this_item' => 'Загрузить в запись',
            'items_list'            => 'Список докторов',
            'items_list_navigation' => 'Навигация по докторам',
        ];

        $args = [
            'public'                => true,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => false,
            'query_var'             => true,
            'rewrite'               => true,
            'capability_type'       => 'page',
            'has_archive'           => true,
            'hierarchical'          => false,
            'menu_position'         => 10,
            'supports'              => array('title', 'editor'),
            'menu_icon'             => 'dashicons-admin-users',
            'publicly_queryable'    => true,
            'show_in_admin_bar'     => true,
            'can_export'            => true,
            'taxonomies'            => array('cities'),
            'show_in_rest'          => true,
        ];

        register_post_type('dealers', $args);
    }

    /**
     * Register taxonomies.
     */
    public function createTaxonomies() {

        register_taxonomy( 'cities', ['dealers'], [
            'label'                 => '',
            'labels'                => [
                'name'              => 'Города',
                'singular_name'     => 'Город',
                'search_items'      => 'Поиск городов',
                'all_items'         => 'Все города',
                'view_item '        => 'Просмотр города',
                'parent_item'       => 'Родительский город',
                'parent_item_colon' => 'Родительский город:',
                'edit_item'         => 'Изменить город',
                'update_item'       => 'Обновить город',
                'add_new_item'      => 'Добавить новый город',
                'new_item_name'     => 'Название новый город',
                'menu_name'         => 'Города',
            ],
            'description'           => '',
            'public'                => true,
            'hierarchical'          => false,
            'rewrite'               => false,
            'query_var'             => 'cities',
            'capabilities'          => array(),
            'meta_box_cb'           => 'post_tags_meta_box',
            'show_admin_column'     => true,
            'show_in_rest'          => false,
            'rest_base'             => null,
        ]);
    }
}
