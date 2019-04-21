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
        $random = rand(10000, 99999);
        $numb = $random.$order_id;
        return $numb;
    }

    function parsing_time($time)
    {
        return date( 'g:i', strtotime($time) );

    }


    function create_order($post)
    {
        $url = api_url().'/SG/4.1/orders';
        $cust = get_order_shipping($post['order_id']);
        $cust_bill = get_order_billing($post['order_id']);
        if ($post['pk_req'] === 'on') {
            $pk_req = true;
        } else {
            $pk_req = false;
        }
        // $data = [
        //     'service_type'              => 'Parcel',
        //     'service_level'             => $post['service_level'],
        //     'requested_tracking_number' => $post['rtn'],
        //     'reference'                 => [
        //         'merchant_order_number' => 'SHIP-1234-56789'
        //     ],
        //     'from'                      => [
        //         'name'          => get_option('sender_name'),
        //         'phone_number'  => '+'.get_option('sender_phone'),
        //         'email'         => get_option('sender_mail'),
        //         'address'       => [
        //             'address1'  => get_option('sender_address_1'),
        //             'address2'  => get_option('sender_address_2'),
        //             'country'   => get_option('sender_country'),
        //             'postcode'  => get_option('sender_postal_code')
        //         ]
        //     ],
        //     'to'                        => [
        //         'name'          => $cust['first_name'].' '.$cust['last_name'],
        //         'phone'         => '+'.$cust_bill['phone'],
        //         'email'         => $cust_bill['email'],
        //         'address'       => [
        //             'address1'  => $cust['address_1'],
        //             'address2'  => $cust['address_2'],
        //             'country'   => $cust['country'],
        //             'postcode'  => $cust['postcode']
        //         ]
        //     ],
        //     'parcel_job'    => [
        //         'is_pickup_required'    => $pk_req,
        //         'pickup_address'        => [
        //             'name'              => get_option('sender_name'),
        //             'phone_number'      => '+'.get_option('sender_phone'),
        //             'email'             => get_option('sender_mail'),
        //             'address'       => [
        //                 'address1'  => get_option('sender_address_1'),
        //                 'address2'  => get_option('sender_address_2'),
        //                 'country'   => get_option('sender_country'),
        //                 'postcode'  => get_option('sender_postal_code')
        //             ]
        //         ],
        //         'pickup_service_type'   => $post['pk_st'],
        //         'pickup_service_level'  => $post['pk_slv'],
        //         'pickup_date'           => date('Y-m-d', strtotime($post['pk_date'])),
        //         'pickup_timeslot'       => [
        //             'start_time'        => parsing_time($post['pk_start']),
        //             'end_time'          => parsing_time($post['pk_end']),
        //             'timezone'          => 'Asia/Singapore'
        //         ],
        //         'pickup_approx_volume'  => 'Less than 3 Parcels',
        //         'pickup_instruction'    => $post['pk_inst'],
        //         'delivery_instruction'  => $post['dl_inst'],
        //         'delivery_start_date'   => date('Y-m-d', strtotime($post['dl_date'])),
        //         'delivery_timeslot'     => [
        //             'start_time'        => parsing_time($post['dl_start']),
        //             'end_time'          => parsing_time($post['dl_end']),
        //             'timezone'          => 'Asia/Singapore'
        //         ]
        //     ]
        // ];
        
        $data = '{
  "service_type": "Parcel",
  "service_level": "Standard",
  "requested_tracking_number": "123456789",
  "reference": {
    "merchant_order_number": "SHIP-1234-56789"
  },
  "from": {
    "name": "John Doe",
    "phone_number": "+60122222222",
    "email": "john.doe@gmail.com",
    "address": {
      "address1":"Perumnas nikan",
      "address2":"Blok A5",
      "country":"SG",
      "postcode":"31626"
    }
  },
  "to": {
    "name": "Jane Doe",
    "phone_number": "+6212222222222",
    "email": "jane.doe@gmail.com",
    "address": {
        "address1":"Perumnas nikan",
        "address2":"Blok A5",
        "country":"SG",
        "postcode":"31626"
    }
  },
  "parcel_job": {
    "is_pickup_required": true,
    "pickup_service_type": "Scheduled",
    "pickup_date": "2019-06-18T00:00:00.000Z",
    "pickup_timeslot": {
      "start_time": "09:00",
      "end_time": "12:00",
      "timezone": "Asia/Singapore"
    },
    "pickup_instruction": "Pickup with care!",
    "delivery_instruction": "If recipient is not around, leave parcel in power riser.",
    "delivery_start_date": "2019-06-19",
    "delivery_timeslot": {
      "start_time": "09:00",
      "end_time": "22:00",
      "timezone": "Asia/Singapore"
    }
  }
}';
        // $result = json_encode($data);
        $response = curl_create_order($url, $data, $post['access_tokn']);
        // return $data;
        return $response;
    }
