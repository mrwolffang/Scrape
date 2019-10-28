<?php

include("simple_html_dom.php");

ini_set('max_execution_time', 0);

// $fp = fopen('ivhunter.txt', "r");
// $urls = array();
  
// // Kiểm tra file mở thành công không
// if (!$fp) {
    // echo 'Mở file không thành công';
// }
// else
// {
    // // Lặp qua từng dòng để đọc
    // while(!feof($fp))
    // {
		// array_push($urls,fgets($fp));
        
    // }

	
// }
// //print_r ($urls);

							//--------------------------------------------

// function get_pages(){
	// //$links=array();
	// for ($i=21; $i<=34; $i++){
	// $html = file_get_html('https://gravuretube.com/page/'.$i );
	// foreach($html->find('.clip-link') as $element) 
			// $links[]=$element->href;
			// //array_push($links,$element->href . '<br>');

			
	// }

	  // // foreach($links as $link )
			  // // echo $link;
	// return $links;
// }


					//------------------------------------------------
					
function get_pages(){
	
	$doc = new DOMDocument();
	libxml_use_internal_errors(true);
	
	
	for ($i=5; $i<=5; $i++){
	 //$html = file_get_html('https://gravuretube.com/page/'.$i );
	 $doc->loadHTMLFile('https://javdos.com/page/'.$i);
	 $xpath = new DOMXpath($doc);
	 $elements = $xpath ->query("//*[@id='content']/div[2]/div/div/div[1]/a/@href");
	 if (!is_null($elements)) {
		  foreach ($elements as $element) {
			

			$nodes = $element->childNodes;
			foreach ($nodes as $node) {
			   $links[]=$node->nodeValue. "\n";
			   
			}
		  }
		}	
	
	}
	
	return $links;
	
}


			//---------------------------------
							
$links = get_pages();

							
foreach ($links as $link){
	 
$link=trim($link,"\t\n\r\0\x0B");
$doc = new DOMDocument();
//$html = file_get_html($url);
libxml_use_internal_errors(true);
$doc->loadHTMLFile($link);
 //echo $link; 
// var_dump ($doc);
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




?>