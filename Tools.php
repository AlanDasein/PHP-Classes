<?php

class Tools
{
	
	public function __construct() {}
	
	public function get_mac($_ip) {
		
		$mac = 'WAN Connection';
		$arp = `arp -a $_ip`;
		$lines = explode("\n", $arp);
		
		foreach($lines as $line) {
			$cols = preg_split('/\s+/', trim($line));
			if($cols[0] == $ip) {$mac = $cols[1];}
		}
		
		return $mac;
		
	}
	
	public function get_url($_url){
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $_url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec($ch);
		
		curl_close($ch);
		
		return $response;
		
	}
	
}