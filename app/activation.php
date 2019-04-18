<?php 
    function create_db_ninja()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'ninja_van';
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $sql = "CREATE TABLE " . $table_name . "(
                    id INT unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    order_id varchar(255) NOT NULL,
                    tracking_id varchar(255) NULL
                    )";
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            add_option('competition_database_version', '1.0');
        }
    }

    function delete_db_ninja()
    {
         global $wpdb;
         $table_name = $wpdb->prefix . "pwvaldUser";
         $sql = "DROP TABLE IF EXISTS $table_name;";
         $wpdb->query($sql);
    }