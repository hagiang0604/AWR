<?php

$today = date("Y-m-d");

$links = array('143','144','145');
// $links = array('145');
foreach ($links as $link) {
	
	// $output_filename = __DIR__ . "/download/test_{$link}.csv";
	$host = "https://redmine.dirox.net/projects/bit-webscraper/issues.csv?query_id={$link}";
	$ch = curl_init();

	$curl_config = [
	    CURLOPT_URL => $host,
	    CURLOPT_VERBOSE => 1,
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_AUTOREFERER => false,
	    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    CURLOPT_HEADER => 0,
	    CURLOPT_SSL_VERIFYHOST => 0, //do not verify that host matches one in certifica
	    CURLOPT_SSL_VERIFYPEER => 0, //do not verify certificate's meta
	];

	curl_setopt_array($ch, $curl_config); //apply config
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	    'Content-Type: application/json',
	    'X-Redmine-API-Key: e2332f101a08a865f970a8753cc6196130c4fc6f '
	    ));
	$result = curl_exec($ch);

	if (empty($result)){
	    echo  curl_error($ch); //show possible error if answer if empty and exit script
	    exit;
	}
	curl_close($ch);

	//print_r($result); // prints the contents of the collected file before writing..

	// the following lines write the contents to a file in the same directory (provided permissions etc)
	// file_put_contents($output_filename, $result);

	$lines = explode(PHP_EOL, $result);
	$array = array();
	foreach ($lines as $line) {
		$array[] = str_getcsv($line);
		if (($data = fgetcsv($line)) !== FALSE) {
	        unset($data[5]);
	        // fputcsv($write, $data);
    	}
	}
	echo "<pre>";
	print_r($array); 	 	 


}

?>
