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

    function insert_db($order_id, $track_number)
    {
      global $wpdb;
      $table_name = $wpdb->prefix . 'ninja_van';
      $data = [
        'order_id'      => $order_id,
        'status'        => 'created',
        'tracking_id'   => $track_number,
        'created_date'  => date('Y-m-d H:i:s'),
        'modify_date'  => date('Y-m-d H:i:s')
      ];
      if ($wpdb->insert($table_name, $data)) {
        return true;
      } else {
        return false;
      }
    }

    function delete_order($order_id)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'ninja_van';
        $data = [
            'order_id' => $order_id
        ];
        $wpdb->delete($table_name, $data);
        return true;
    }

    function update_order($post)
    {
      $status = get_option('status_after', 'shipment');
      $order = new WC_Order($post['ord_id']);
      $message = 'Order has been shipped by Ninja Van with Tracking Number : '.$post['track_number'];
      $status = $order->update_status($status, $message);
      if ($status) {
        if (insert_db($post['ord_id'], $post['track_number'])) {
          $data = [
            'status'  => 200,
            'message' => $message
          ];
        } else {
          $data = [
            'status'  => 200,
            'message' => 'Order has been created but not recorded in database'
          ];
        }
      } else {
        $data = [
          'status'  => 500,
          'message' => 'Fail to update the order! But the order has been created!'
        ];
      }
      return $data;
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
        $data = [
            'service_type'              => 'Parcel',
            'service_level'             => $post['service_level'],
            'requested_tracking_number' => $post['rtn'],
            'reference'                 => [
                'merchant_order_number' => 'SHIP-1234-56789'
            ],
            'from'                      => [
                'name'          => get_option('sender_name'),
                'phone_number'  => get_option('sender_phone'),
                'email'         => get_option('sender_mail'),
                'address'       => [
                    'address1'  => get_option('sender_address_1'),
                    'address2'  => get_option('sender_address_2'),
                    'country'   => get_option('sender_country'),
                    'postcode'  => get_option('sender_postal_code')
                ]
            ],
            'to'                        => [
                'name'          => $cust['first_name'].' '.$cust['last_name'],
                'phone'         => $cust_bill['phone'],
                'email'         => $cust_bill['email'],
                'address'       => [
                    'address1'  => $cust['address_1'],
                    'address2'  => $cust['address_2'],
                    'country'   => $cust['country'],
                    'postcode'  => $cust['postcode']
                ]
            ],
            'parcel_job'    => [
                'is_pickup_required'    => $pk_req,
                'pickup_address'        => [
                    'name'              => get_option('sender_name'),
                    'phone_number'      => '+'.get_option('sender_phone'),
                    'email'             => get_option('sender_mail'),
                    'address'       => [
                        'address1'  => get_option('sender_address_1'),
                        'address2'  => get_option('sender_address_2'),
                        'country'   => get_option('sender_country'),
                        'postcode'  => get_option('sender_postal_code')
                    ]
                ],
                'pickup_service_type'   => $post['pk_st'],
                'pickup_service_level'  => $post['pk_slv'],
                'pickup_date'           => date('Y-m-d', strtotime($post['pk_date'])),
                'pickup_timeslot'       => [
                    'start_time'        => parsing_time($post['pk_start']),
                    'end_time'          => parsing_time($post['pk_end']),
                    'timezone'          => 'Asia/Singapore'
                ],
                'pickup_approx_volume'  => 'Less than 3 Parcels',
                'pickup_instruction'    => $post['pk_inst'],
                'delivery_instruction'  => $post['dl_inst'],
                'delivery_start_date'   => date('Y-m-d', strtotime($post['dl_date'])),
                'delivery_timeslot'     => [
                    'start_time'        => parsing_time($post['dl_start']),
                    'end_time'          => parsing_time($post['dl_end']),
                    'timezone'          => 'Asia/Singapore'
                ],
                'dimensions'            => [
                    'size'      => $post['size'],
                    'weight'    => $post['weight'],
                    'length'    => $post['length'],
                    'width'     => $post['width'],
                    'height'    => $post['height']
                ]
            ]
        ];
        
        $result = json_encode($data);
        $response = curl_create_order($url, $data, $post['access_tokn']);
        if (isset($response->error)) {
          $resp = [
            'status'  => 500,
            'title'   => $response->error->title,
            'message' => 'Please check your Billing address and Shipping, make sure it has correct field like postcode and country.',
          ];
        } else {
          $resp = [
            'status'          => 200,
            'order_id'        => $post['order_id'],
            'tracking_number' => $response->tracking_number,
            'service_type'    => $response->service_type,
            'service_level'   => $response->service_level,
          ];
        }
       
        return $resp;
    }
