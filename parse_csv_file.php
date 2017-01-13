<HTML>
<HEAD>
	<STYLE>

		table{
			width:800px;
			border: #CCCCCC 1px solid;
			background-color: #555555;
			color:#FFFFFF;
			font-family: "Century Gothic",CenturyGothic,AppleGothic,sans-serif;
		}
		td{
			padding: 5px 2px;
		}
		tr.data {
			background-color: #FAFFFF;
			color:#000000;
		}
	</STYLE>
</HEAD>
<BODY>
<?php

	$path = "public/libs/input";    
	//get all files files with a .html extension.
	$files = scandir($path);
	$files = array_diff(scandir($path), array('.', '..'));
	//print each file name
	foreach($files as $filename)
	{
	echo $filename;
	echo "<br>";
	}

	die;


	//****************remove unnecessary column 'resolution'*****************
	$read = fopen('public/libs/input/issues.csv', 'r');
	$write = fopen('public/libs/output/output.csv', 'w');
	if ($write && $read) {
	    while (($data = fgetcsv($read)) !== FALSE) {
	        unset($data[5]);
	        fputcsv($write, $data);
	    }
	}
	fclose($write);
	fclose($read);

	//***************remove the firsl line in csv file*********************

	// Read the file
	$file = fopen('public/libs/output/output.csv', 'r');

	// Iterate over it to get every line 
	while (($line = fgetcsv($file)) !== FALSE) {
	  // Store every line in an array
	  $data[] = $line;
	}
	fclose($file);

	// Remove the first element from the stored array / first line of file being read
	array_shift($data);

	// Open file for writing
	$file = fopen('public/libs/output/output.csv', 'w');

	// Write remaining lines to file
	foreach ($data as $fields) {
	    fputcsv($file, $fields);
	}
	fclose($file);

	//**************read and display file output.csv ***********************
	$CSVfp = fopen("public/libs/output/output.csv", "r");

	if($CSVfp !== FALSE) {
	?>
	<table cellspacing="1">
		<tr>
			<td align="center">Key</td>
			<td align="center">Summary</td>
			<td align="center">Issue Type</td>
			<td align="center">Status</td>
			<td align="center">Priority</td>
			<td align="center">Created</td>
			<td align="center">Fix Version/s</td>
		</tr>
		<?php

		while(! feof($CSVfp)) {
		$data = fgetcsv($CSVfp, 1000, ",");
			if (empty($data)) {
				continue;
			}
		?>
		<tr class="data">
			<td align="center"><?php echo $data[0]; ?></td>
			<td align="left"><?php echo $data[1]; ?></td>
			<td align="center"><?php echo $data[2]; ?></td>
			<td align="center"><?php echo $data[3]; ?></td>
			<td align="center"><?php echo $data[4]; ?></td>
			<td align="center"><?php echo $data[5]; ?></td>
			<td align="center"><?php echo $data[6]; ?></td>
		</tr>
		<?php
		}
		?>
	</table>
	<?php
	}
	fclose($CSVfp);
	//****************** merge 3 file csv ************************
?>
</BODY>
</HTML>