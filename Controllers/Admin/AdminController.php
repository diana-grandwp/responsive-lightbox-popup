<?php

namespace GDLightbox\Controllers\Admin;

/**
 * Class AdminController
 * @package GDLightbox\Controllers\Admin
 */
class AdminController
{
    /**
     * @var string[]
     */
    public $pages = array();

    public function __construct()
    {
        new AdminAssetsController();
        add_action('admin_menu', array($this,'adminMenu'));
        $this->actionHandling();
    }

    public function adminMenu()
    {
        $this->pages['settings'] = add_menu_page(
            __('Grand Lightbox', 'gd_lightbox'),
            __('Grand Lightbox', 'gd_lightbox'),
            'manage_options',
            'gd_lightbox',
            array('GDLightbox\Controllers\Admin\SettingsController','index'),
            \GDLightbox()->pluginUrl().'/resources/assets/images/logo/logo1.png'
        );
        $this->pages['design_settings'] = add_submenu_page(
            'gd_lightbox',
            __('Design customization', 'gd_lightbox'),
            __('Design customization', 'gd_lightbox'),
            'manage_options',
            'gd_lightbox_design',
            array('GDLightbox\Controllers\Admin\DesignSettingsController','index')
        );
    }

    public function actionHandling()
    {
        add_action('wp_ajax_save_gd_lightbox_settings', array('GDLightbox\Controllers\Admin\SettingsController','save'));
    }

}