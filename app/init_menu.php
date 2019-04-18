<?php 
    function ninja_admin()
    {
        add_menu_page('Ninja Van', 'Ninja Van', 'manage_options', 'ninjavan_opt', 'main_view_pwavald', 'dashicons-admin-site');
    }