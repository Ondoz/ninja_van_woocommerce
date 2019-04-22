<?php 
/**
 * Plugin Name: Ninja-Van Shipping WooCommerce
 * Plugin URI: https://fixxdigital.com
 * Description: NinjaVan Shipping Method for WooCommerce
 * Version: 1.0.0
 * Author: RBH
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: FixxDigital
 */
include dirname(__FILE__) . '/vendor/autoload.php';
include dirname(__FILE__) . '/app/activation.php';
include dirname(__FILE__) . '/app/init_menu.php';
include dirname(__FILE__) . '/app/proccess.php';

register_activation_hook( __FILE__, 'create_db_ninja' );
register_deactivation_hook( __FILE__, 'delete_db_ninja' );

add_action('admin_menu', 'ninja_admin');
add_action( 'init', 'register_shipment_order_status' );
add_filter( 'wc_order_statuses', 'add_shipment_to_order_statuses' );

use \Curl\Curl;

if ( ! defined( 'WPINC' ) ) {
    die;
}

function LoadView($name, $data = array()) 
{
    extract($data);
    include "views/$name.php";
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
 	
    function ninjavan_shipping_method() {
        if ( ! class_exists( 'NinjaVan_Shipping_Method' ) ) {
            class NinjaVan_Shipping_Method extends WC_Shipping_Method {
  
                public function __construct() {
                    $this->id                 = 'ninjavan'; 
                    $this->method_title       = __( 'NinjaVan Shipping', 'ninjavan' );  
                    $this->method_description = __( 'Custom Shipping Method for NinjaVan', 'ninjavan' ); 
 					$this->availability = 'including';
 					$this->countries = array(
					    'SG',
				    );

                    $this->init();
                    $this->enabled = isset( $this->settings['enabled'] ) ? $this->settings['enabled'] : 'yes';
                    $this->title = isset( $this->settings['title'] ) ? $this->settings['title'] : __( 'NinjaVan Shipping', 'ninjavan' );

                }
 
                function init() {
                    // Load the settings API
                    $this->init_form_fields(); 
                    $this->init_settings(); 
 
                    // Save settings in admin if you have any defined
                    add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
                }
 
                function init_form_fields() { 
                	$this->form_fields = array(
			         	'enabled' => array(
			              'title' => __( 'Enable', 'ninjavan' ),
			              'type' => 'checkbox',
			              'description' => __( 'Enable this shipping.', 'ninjavan' ),
			              'default' => 'yes'
			            ),
			        );
 
                }
 
                public function calculate_shipping( $package = array() ) {
                	
                	$weight = 0;
				   	$cost = 0;
				   	$country = $package["destination"]["country"];

				   	foreach ( $package['contents'] as $item_id => $values ) 
				   	{ 
				       $_product = $values['data']; 
				       if (!empty($_product->get_weight())) {
				       		$weight = $weight + $_product->get_weight() * $values['quantity']; 
				       }
				       
				   	}

				   	$weight = wc_get_weight( $weight, 'kg' );
				   	if( $weight <= 10 ) {
				       $cost = 0;
				   	} elseif( $weight <= 30 ) {
				       $cost = 0;
				   	} elseif( $weight <= 50 ) {
				       $cost = 0;
				   	} else {
				       $cost = 0;
				   	}

				   	$countryZones = array(
				        'SG' => 0,
			        );
			        $zonePrices = array(
				        0 => 0,
			        );

			        $zoneFromCountry = $countryZones[ $country ];
    				$priceFromZone = $zonePrices[ $zoneFromCountry ];
    				$cost += $priceFromZone;

    				$rate = array(
				        'id' => $this->id,
				        'label' => $this->title,
				        'cost' => $cost
				    );
				    $this->add_rate($rate);

                }
            }
        }
    }

    add_action( 'woocommerce_shipping_init', 'ninjavan_shipping_method' );
 
    function add_ninjavan_shipping_method( $methods ) {
        $methods[] = 'NinjaVan_Shipping_Method';
        return $methods;
    }
 
    add_filter( 'woocommerce_shipping_methods', 'add_ninjavan_shipping_method' );

    function ninjavan_validate_order( $posted )   {
        $packages = WC()->shipping->get_packages();
        $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
        if( is_array( $chosen_methods ) && in_array( 'ninjavan', $chosen_methods ) ) {
        	// $data = json_encode($packages[0]["destination"]);
        	$user_id = $packages[0]['user']['ID'];
			$data = [
				'first_name'		=> get_user_meta( $user_id, 'billing_first_name', true ),
				'last_name'			=> get_user_meta( $user_id, 'billing_last_name', true ),
				'phone'			=> get_user_meta( $user_id, 'billing_phone', true ),
				'address' => [
					'address_1' 	=> get_user_meta( $user_id, 'billing_address_1', true ),
					'address_2' 	=> get_user_meta( $user_id, 'billing_address_2', true ),
					'city'			=> get_user_meta( $user_id, 'billing_city', true ),
					'country'		=> get_user_meta( $user_id, 'billing_country', true ),
					'postal_code'	=> get_user_meta( $user_id, 'billing_postcode', true )
				]
			];
        	echo "<pre>";
        	print_r($data);
        	// var_dump();
        } 
    }

    function requestApiToken()
    {
	    $data = request_access_token();
        return $data;
    }

    function api_url()
    {
        if (get_option('ninja_sandbox') == 1) {
            return 'https://api-sandbox.ninjavan.co';
        } else {
            return 'https://api.ninjavan.co';
        }
    }

    function request_access_token()
    {
    	$url = api_url().'/SG/2.0/oauth/access_token';
        $data = json_encode([
            'client_id' => get_option('ninja_client_id'),
            'client_secret'=> get_option('ninja_client_secret'),
            'grant_type'=> 'client_credentials'
        ]);
    	$response = curl_post($url, $data);
    	if ($response != false) {
            $data = [
                'status'            => 200,
                'access_token'      => $response->access_token,
                'exp_token'         => $response->expires,
                'client_id'         => get_option('ninja_client_id'),
                'client_secret'     => get_option('ninja_client_secret'),
            ];
    	} else {
            $data = [
                'status'            => 500,
                'access_token'      => null,
                'exp_token'         => null,
                'client_id'         => get_option('ninja_client_id'),
                'client_secret'     => get_option('ninja_client_secret'),
            ];
    	}
        return $data;
    }

    function curl_post($url, $data)
    {
    	$curl = new Curl;
    	$curl->setHeader('Content-Type', 'application/json');
    	$curl->setHeader('Accept', 'application/json');
    	$curl->post($url, $data);
    	if ($curl->error) {
		    return false;
		} else {
		    return $curl->response;
		}
    }

    function curl_create_order($url, $data, $token)
    {
        $curl = new Curl;
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('Authorization', 'Bearer '.$token);
        $curl->setHeader('Accept', 'application/json');
        $curl->post($url, $data);
        return $curl->response;
    }

    function afterCheckout()
    {
    	$packages = WC()->shipping->get_packages();
        $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
        if( is_array( $chosen_methods ) && in_array( 'ninjavan', $chosen_methods ) ) {
        	$data = json_encode($packages[0]["destination"]);
        	echo "<pre>";
        	print_r($data);
        	// var_dump();
        }
    }

    function getData()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "ninja_van";
        $sql = "SELECT * FROM $table_name";
        return $wpdb->get_results($sql);
    }

    function get_status_order($id)
    {
      $order = wc_get_order($id);
      return $order->get_status();
    }
 	
 	add_action( 'woocommerce_review_order_before_cart_contents', 'ninjavan_validate_order' , 10 );
    add_action( 'woocommerce_after_checkout_validation', 'ninjavan_validate_order' , 10 );


}






