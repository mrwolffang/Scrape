<?php

include("simple_html_dom.php");

ini_set('max_execution_time', 0);

$fp = fopen('ivhunter.txt', "r");
$urls = array();
  
// Kiểm tra file mở thành công không
if (!$fp) {
    echo 'Mở file không thành công';
}
else
{
    // Lặp qua từng dòng để đọc
    while(!feof($fp))
    {
		array_push($urls,fgets($fp));
        
    }

	
}

//----------------------------------------------------

foreach ($urls as $link){
$url=trim($link,"\r\n");



$doc = new DOMDocument();
//$html = file_get_html($url);
libxml_use_internal_errors(true);
$doc->loadHTMLFile($url);
$xpath = new DOMXpath($doc);
$elements = $xpath ->query("//*[@id='video']/div[2]/iframe/@src");

if (!is_null($elements)) {
  foreach ($elements as $element) {
    // echo "<br/>[". $element->nodeName. "]";

    $nodes = $element->childNodes;
    foreach ($nodes as $node) {
      echo $node->nodeValue. "\n";
    }
  }
}
echo "<br/>";

}

//--------------------------------------

// echo file_get_contents_curl($urls[1]);


// function file_get_contents_curl($url) {
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_HEADER, 0);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
// curl_setopt($ch, CURLOPT_URL, $url);
// $data = curl_exec($ch);
// curl_close($ch);
// return $data;
// }


//-----------------------------------------

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch,CURLOPT_URL,"http://ivhunter.com/mbr-aa063-%e3%82%b8%e3%82%a7%e3%83%9e-gemma-nude/");
// curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
// curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
// $data = curl_exec($ch);
// curl_close($ch);
// var_dump ($data);




?>