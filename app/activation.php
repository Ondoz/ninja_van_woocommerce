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

    function register_shipment_order_status() {
        register_post_status( 'wc-awaiting-shipment', array(
            'label'                     => 'Shipment',
            'public'                    => true,
            'exclude_from_search'       => false,
            'show_in_admin_all_list'    => true,
            'show_in_admin_status_list' => true,
            'label_count'               => _n_noop( 'Shipment <span class="count">(%s)</span>', 'Shipment <span class="count">(%s)</span>' )
        ) );
    }

    function add_shipment_to_order_statuses( $order_statuses ) {
        $new_order_statuses = array();
        foreach ( $order_statuses as $key => $status ) {
            $new_order_statuses[ $key ] = $status;
            if ( 'wc-processing' === $key ) {
                $new_order_statuses['wc-shipment'] = 'Shipment';
            }
        }
        return $new_order_statuses;
    }