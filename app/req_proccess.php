<?php 
    function get_order_billing($id)
    {
        $get_order = wc_get_order($id);
        $order = $get_order->get_data();
        return $order['billing'];
    }

    function get_order_shipping($id)
    {
        $get_order = wc_get_order($id);
        $order = $get_order->get_data();
        return $order['shipping'];
    }

    function random_rtn($order_id)
    {
        $random = rand(1000, 9999);
        $numb = $random.$order_id;
        return $numb;
    }
