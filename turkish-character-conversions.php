<?php

function turkish_uppercase($str){
	$characters = ['ğ' => 'Ğ', 'ş' => 'Ş', 'i' => 'İ', 'ı' => 'I', 'ü' => 'Ü', 'ö' => 'Ö', 'ç' => 'Ç'];
	return strtoupper(str_replace(array_keys($characters), array_values($characters), $str));
}

function turkish_lowercase($str){
	$characters = ['ğ' => 'Ğ', 'ş' => 'Ş', 'i' => 'İ', 'ı' => 'I', 'ü' => 'Ü', 'ö' => 'Ö', 'ç' => 'Ç'];
	return strtolower(str_replace(array_values($characters), array_keys($characters), $str));
}

function turkish_capitalize($str){
	return turkish_uppercase(mb_substr($str, 0, 1)).mb_substr($str, 1);
}

function turkish_uppercase_words($str){
	$words = explode(' ', $str);
	$str = [];

	foreach($words as $word){
		$str[] = turkish_capitalize($word);
	}

	return implode(' ', $str);
}
