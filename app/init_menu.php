<?php 
    function ninja_admin()
    {
        add_menu_page('Ninja Van', 'Ninja Van', 'manage_options', 'ninjavan_opt', 'main_view_ninja', 'dashicons-admin-site');
        add_submenu_page('ninjavan_opt', 'Settings', 'Settings', 'manage_options', 'ninjavan_setting', 'setting_view_ninja');
    }

    function main_view_ninja()
    {
        LoadView('option');
    }
    function setting_view_ninja()
    {
        LoadView('setting');
    }

    function save_option()
    {
        update_option('ninja_client_id', $_POST['client_id']);
        update_option('ninja_client_secret', $_POST['client_key']);
        if ($_POST['sandbox'] === 'on') {
            update_option('ninja_sandbox', 1);
        } else {
            update_option('ninja_sandbox', 0);
        }
        return true;
    }