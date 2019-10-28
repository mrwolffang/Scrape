<?php 
ini_set('max_execution_time', 0);
$path = 'E:\youtubed\ivhunter\1000giri';
$url="https://1000giribest.com/wp-content/uploads/2018/08/bbwbloomers035006.jpg";
 $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_URL, $url);

    $fp = fopen($path . '/' . basename($url), 'w');

    //Set CURL to write to disk
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 1000);

    //Execute download
    curl_exec ($ch);
    curl_close ($ch);

    fclose($fp);
	
?>