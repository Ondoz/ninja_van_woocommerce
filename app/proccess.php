<?php 
    function get_all_order()
    {
        $query = new WC_Order_Query( 
            array(
                'limit' => 10,
                'orderby' => 'date',
                'order' => 'DESC',
                'return' => 'ids',
            ) 
        );
        $orders = $query->get_orders();
        return $orders;
    }

    function get_order($id)
    {
        $data = wc_get_order($id);
        return $data;
    }