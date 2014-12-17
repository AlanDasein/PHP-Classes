<?php

	class Cypher
	{
		
		public function __construct($_value) {}
		
		public function encryp($_value) {
			
			$key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
			$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
			$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
			$utf8 = utf8_encode($_value);
			$cipher = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $utf8, MCRYPT_MODE_CBC, $iv);
			$cipher = $iv.$cipher;
			$base64 = base64_encode($_value);
			
			return $base64;
			
		}
		
		public function decryp($_value) {return base64_decode($_value);}
		
	}
