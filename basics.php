function convert_non_english($str){
	return iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $str);
}

function get_summary($content, $length = 30){
	$content = trim(str_replace("\n", ' ', strip_tags(htmlspecialchars_decode($content))));
	return (strlen($content) > $length ? trim(trim(mb_substr($content, 0, $length), '.')).'...' : $content);
}

function format_date($date, $db_format = false){
	$format = ($db_format ? 'Y-m-d' : 'd F Y');

	return date($format, strtotime($date));
}

// to be continued...
