<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RajaOngkir extends Controller
{
    //

	public function index(){
		return 'test api rajangoding';
	}

	public function getProvince(){
		$Client = new Client(); 

		try{
			$response = $Client->get('https://api.rajaongkir.com/starter/province', 
				array(
					'headers' => array(
						'key' => '985c4bb806eb47103b6d204bec3b1245',
					)
				)	
			);
		} catch(RequestException $e){
			var_dump($e->getResponse()->getBody()->getContents());
		}

		$json = $response->getBody()->getContents();

		$array_result	= json_decode($json, true);

		$dataProv = $array_result["rajaongkir"]["results"];

		return $dataProv;	
	}

	public function getCity(){
		$Client = new Client(); 

		try{
			$response = $Client->get('https://api.rajaongkir.com/starter/city', 
				array(
					'headers' => array(
						'key' => '985c4bb806eb47103b6d204bec3b1245',
					)
				)	
			);
		} catch(RequestException $e){
			var_dump($e->getResponse()->getBody()->getContents());
		}

		$json = $response->getBody()->getContents();

		$array_result	= json_decode($json, true);

		$dataCity = $array_result["rajaongkir"]["results"];

		return $dataCity;	
	}

	public function checkshipping(){
		$Client = new Client(); 

		try{
			$response = $Client->request('POST','https://api.rajaongkir.com/starter/cost', 
				[
					'body' => 'origin=501&destination=114&weight=1700&courier=jne',
					'headers' => [
						'key' => '985c4bb806eb47103b6d204bec3b1245',
						'content-type' => 'application/x-www-form-urlencoded',
					]
				]
			);
		} catch(RequestException $e){
			var_dump($e->getResponse()->getBody()->getContents());
		}

		$json = $response->getBody()->getContents();

		$array_result	= json_decode($json, true);		

		$dataOngkir = $array_result["rajaongkir"]["results"];

		return $dataOngkir;
	}

}
