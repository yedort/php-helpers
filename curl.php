<?php

function curl($url, $post = [], $headers = [], $cookies = false, $proxy = null, $force_w_proxies = false, $timeout = 0){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	if(!empty($proxy)){
		if(is_array($proxy)){
			$proxy1 = $proxy[array_rand($proxy)];
		}
		list($proxy_auth, $proxy1) = @explode('@', $proxy1);
		list($proxy1, $proxy_port) = @explode(':', $proxy1);
		curl_setopt($ch, CURLOPT_PROXY, $proxy1);
		if(!empty($proxy_port)){
			curl_setopt($ch, CURLOPT_PROXYPORT, $proxy_port);
		}
	}
	if(!empty($proxy_auth)){
		curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy_auth);
	}
	if(empty($headers)){
		curl_setopt($ch, CURLOPT_REFERER, parse_url($url, PHP_URL_SCHEME).parse_url($url, PHP_URL_HOST));
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36');
	}
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	if(!empty($post)){
		curl_setopt($ch, CURLOPT_POST, true);
		$post = (is_array($post) ? http_build_query($post) : $post);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	if(!empty($headers)){
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	}
	if($cookies){
		curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . DIRECTORY_SEPARATOR . 'cookies.txt');
		curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . DIRECTORY_SEPARATOR . 'cookies.txt');
	}
	if($timeout > 0){
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	}
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec($ch);
	curl_close($ch);
	if($force_w_proxies && empty($output) && is_array($proxy)){
		$output = curl($url, $post, $headers, $cookies, $proxy, true, $timeout);
	}
	return $output;
}

// multi curl function is coming soon...
