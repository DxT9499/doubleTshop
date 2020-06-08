<?php
namespace DxT\Weather\Block;
class Index extends \Magento\Framework\View\Element\Template
{
	public function __construct(\Magento\Framework\View\Element\Template\Context $context)
	{
		parent::__construct($context);
	}
	
	function getUserIP() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP')) {
			$ipaddress = getenv('HTTP_CLIENT_IP');
		} else if (getenv('HTTP_X_FORWARDED_FOR')) {
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		} else if (getenv('HTTP_X_FORWARDED')) {
			$ipaddress = getenv('HTTP_X_FORWARDED');
		} else if (getenv('HTTP_FORWARDED_FOR')) {
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		} else if (getenv('HTTP_FORWARDED')) {
			$ipaddress = getenv('HTTP_FORWARDED');
		} else if (getenv('REMOTE_ADDR')) {
			$ipaddress = getenv('REMOTE_ADDR');
		} else {
			$ipaddress = 'UNKNOWN';
		}
		return $ipaddress;
	}
	
	//get Json from server
	function sendJsontoServer() {
		//$userIP = getUserIP();
		$userIP = "27.79.169.9";
		$access_key = "?access_key=b6e81fb55ecfd7b9b46dd48905427952";
		$array_json = "http://api.ipstack.com/" . $userIP . $access_key;
		$json = file_get_contents($array_json);
		$obj = json_decode($json);
		return $obj;
	}
	
	function getCurrentData($region, $coutry_name, $access_key) {
		$location = $region . "," . $coutry_name . "&units=metric";
		$array_json = "http://api.openweathermap.org/data/2.5/weather?q=" . $location . $access_key;
		$json = file_get_contents($array_json);
		$obj = json_decode($json);
		return $obj;
	}
	
	function getForcast($city_id, $access_key) {
		$array_json = "http://api.openweathermap.org/data/2.5/forecast?id=" . $city_id . "&units=metric" . $access_key;
		$json = file_get_contents($array_json);
		$obj = json_decode($json);
		return $obj;
	}

	// function getdata(){
	// 	//https://samples.openweathermap.org/data/2.5/group?id=524901,703448,2643743&units=metric&appid=439d4b804bc8187953eb36d2a8c26a02
	// 	$array_json = "https://openweathermap.org/data/2.5/group?id=524901,703448,2643743&units=metric&appid=98d3fcae917b425f2cd2d1f77835dc5c";
	// 	$json = file_get_contents($array_json);
	// 	$obj = json_decode($json);
	// 	return $obj;
	// }
}