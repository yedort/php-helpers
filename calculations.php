<?php

function calculate_currency($amount, $from, $to = null){
  /*
  // keep the rates only for one currency
  $currency_rates = [
    'usd_try' => 7.37,
    'eur_try' => 8.78,
    'jpy_try' => 0.070,
  ];
  */

	$from_rate = $current_rates[$from.'_try'];
	$to_rate = $current_rates[$to.'_try'];

	if($from_rate){
		$amount = $amount * $from_rate;
	}

	if($to_rate){
		$amount = $amount / $to_rate;
	}

	return $amount.' '.strtoupper($to);
}

// to be continued...
