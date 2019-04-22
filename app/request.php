<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); 
    session_start();
    include $_SERVER['DOCUMENT_ROOT'].'/wp-load.php';   
    include 'req_proccess.php';

    if (isset($_POST['method'])) {
        $method = $_POST['method'];
        if ($method === 'get_data_billing') {
            $data = get_order_billing($_POST['id']);
            echo json_encode($data);
        } elseif ($method === 'get_data_shipping') {
            $data = get_order_shipping($_POST['id']);
            echo json_encode($data);
        } elseif ($method === 'rtn') {
            $data = random_rtn($_POST['id']);
            echo json_encode($data);
        } elseif ($method === 'ship_order') {
            $data = requestApiToken();
            echo json_encode($data);
        } elseif ($method === 'create_order') {
            $data = create_order($_POST);
            echo json_encode($data);
        } elseif ($method === 'update_status') {
            $data = update_order($_POST);
            echo json_encode($data);
        }
    }

