<?php

function get_current_url($clean_get_requests = false){
	$request_uri = $_SERVER['REQUEST_URI'];

	if($clean_get_requests && strpos($request_uri, '?') !== false){
		$request_uri = explode('?', $request_uri);
		$request_uri = $request_uri[0];
	}

	return trim((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://'. $_SERVER['HTTP_HOST'] . $request_uri, '/');
}

function convert_non_english($str){
	return iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $str);
}

function get_summary($content, $length = 30){
	$content = trim(str_replace("\n", ' ', strip_tags(htmlspecialchars_decode($content))));
	return (strlen($content) > $length ? trim(trim(mb_substr($content, 0, $length), '.')).'...' : $content);
}

function format_date($date, $db_format = false){
	$format = ($db_format ? 'Y-m-d H:i:s' : 'd F Y');

	return date($format, strtotime($date));
}

function check_html_validity($html){
	$html = str_replace('//>', '/>', preg_replace('#<(img|br|input)(.*?)>#si', '<$1$2/>', $html));
	preg_match_all('#<([a-zA-Z0-9]+)(.*?)!/>#si', $html, $start_tags);

	foreach($start_tags[1] as $start_tag){
		preg_match_all('#<'.preg_quote($start_tag).'#si', $html, $start_tag_occurences);
		preg_match_all('#</'.preg_quote($start_tag).'>#si', $html, $end_tag_occurences);
		if(count($start_tag_occurences[0]) != count($end_tag_occurences[0])){
			return false;
		}
	}

	return true;
}

function get_ip(){
	foreach(['HTTP_CF_CONNECTING_IP', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'] as $key){
		if(isset($_SERVER[$key])){
			return $_SERVER[$key];
		}
	}
}

// to be continued...
