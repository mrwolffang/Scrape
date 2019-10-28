<?php
include("simple_html_dom.php");

ini_set('max_execution_time', 0);
?>
<html>
<h3>Mrcong</h3>
<form style="text-align:center;" action="" method="post">
  URL:<br>
  <input style="width:100%; height:100px;" type="text" name="url1" value="<?php echo isset($_POST['url1']) ? $_POST['url1'] : ''; ?>">
  <br><br>
  <input type="submit" value="Submit">
</form> 


<?php
if(!empty($_POST['url1'])) {
	$demo_url=$_POST['url1'];
	// $regex_backup = "/([^\/]+)(?=\.\w+$)/";
	$regex = "#(?<=\mrcong.com\/).*[^/]#";
	preg_match ($regex,$demo_url, $match);
	// if(empty($match)){
	// 	preg_match ($regex_backup,$demo_url, $match);
	// }
	
	$path = 'D:\abc\mrcong\\'.$match[0];

	// if (!file_exists('D:\abc\mrcong\/'.$match[0])) {
		// mkdir($path, 0777, true);
		// echo "";
	// }
	
	// else{
		// echo "$demo_url da duoc down";
		// exit();
	// }
	

	$doc = new DOMDocument();
	//$html = file_get_html($url);
	libxml_use_internal_errors(true);
	$doc->loadHTMLFile($demo_url);
	$xpath = new DOMXpath($doc);
	$elements = $xpath ->query('//*[@id="fukie2"]/p/img/@src');

	if (!is_null($elements)) 
		{
			$ch = curl_init();
	  foreach ($elements as $element) {
		// echo "<br/>[". $element->nodeName. "]";

		$nodes = $element->childNodes;
		
		foreach ($nodes as $node) {
			echo $node->nodeValue. "\n";
			
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
			curl_setopt($ch, CURLOPT_URL, trim($node->nodeValue,"\r\n\t"));
			preg_match('#^(.*?)\.jpg#', basename($node->nodeValue), $file_name);
			$fp = fopen($path . '\\' . $file_name[0], 'w');
			// var_dump($fp);
			// die();

			// Set CURL to write to disk
			curl_setopt($ch, CURLOPT_FILE, $fp);

			// Execute download
			curl_exec ($ch);
			

			fclose($fp);
		}
		echo "<br/>";

	  
	  }
	  
		curl_close ($ch);
	}
}
else{
	echo "nhap url";
}



// foreach ($nodes as $node)
// {
    // $ch = curl_init();

    // curl_setopt($ch, CURLOPT_URL, $node->nodeValue);

    // $fp = fopen($path . '/' . basename($node->nodeValue), 'w');

    // // Set CURL to write to disk
    // curl_setopt($ch, CURLOPT_FILE, $fp);

    // // Execute download
    // curl_exec ($ch);
    // curl_close ($ch);

    // fclose($fp);
// }

?>

</html>

