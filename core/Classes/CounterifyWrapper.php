<?php
/**
 * Package Name: Stripe Pad <> Counterify
 * File Description: This file handles connection with counterify.com server. Counterify is a service to track and count everything from anything.
 * 
 * @author Beto Ayesa <beto.phpninja@gmail.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/natzar/stripe-pad
 * 
 */

class Counterify {

	private static $instance = null;

	public static function singleton()
	{
		if( self::$instance == null )
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function push($key,$value = 1){

		$url = 'https://api.counterify.com/counter';

		$params = array(
		  'label' => $key,
		  'count' => $value
		);

		$headers = array(
		  'Authorization: Bearer ' . COUNTERIFY_TOKEN,
		  'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT_MS, 1000);
		curl_exec($ch);
		curl_close($ch);


	}
		
	
}
