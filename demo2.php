<?php

include("simple_html_dom.php");

ini_set('max_execution_time', 0);

for ($i=1; $i<=2; $i++){
$html = file_get_html('https://gravuretube.com/page/'.$i );
foreach($html->find('.clip-link') as $element) 
        $links[]=$element->href . '<br>';

		
}

foreach($links as $link )
		echo $link;

?>