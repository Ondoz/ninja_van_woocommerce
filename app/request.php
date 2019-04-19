<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); 

    include $_SERVER['DOCUMENT_ROOT'].'/wp-load.php';   

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

    if (isset($_POST['method'])) {
        $method = $_POST['method'];
        if ($method === 'get_data_billing') {
            $data = get_order_billing($_POST['id']);
            echo json_encode($data);
        } elseif ($method === 'get_data_shipping') {
            $data = get_order_shipping($_POST['id']);
            echo json_encode($data);
        }
    }

