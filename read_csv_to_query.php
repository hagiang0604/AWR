<?php
$CSVfp = fopen("fruits.csv", "r");
if($CSVfp !== FALSE) {
print "<PRE>";
while(! feof($CSVfp)) {
	$data = fgetcsv($CSVfp, 1000, ",");
	echo "INSERT INTO fruits (`fruits_name`, `fruits_color`, `fruits_color_code`) VALUES ('" . $data[0] . "', '" . $data[1] . "', '" . $data[2] . "');\r\n\n";
}
}
fclose($CSVfp);
?>