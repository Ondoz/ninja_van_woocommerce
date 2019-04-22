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

    function save_option_setting()
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

    function save_option_sender()
    {
        update_option('sender_name', $_POST['name']);
        update_option('sender_phone', $_POST['phone']);
        update_option('sender_mail', $_POST['email']);
        update_option('sender_address_1', $_POST['address_1']);
        update_option('sender_address_2', $_POST['address_2']);
        update_option('sender_city', $_POST['city']);
        update_option('sender_country', $_POST['country']);
        update_option('sender_postal_code', $_POST['postcode']);
        update_option('sender_mon', $_POST['mon']);
        return true;
    }