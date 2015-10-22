<?php
$fh = fopen($target_path, "r");

$i = 0;
while (!feof($fh) ) {

	$line = fgetcsv($fh, 1024);
	

	$code = '/^\d{2}\s\d{6}\s\d{3}/';
	$code = '/^\d{2}\s/';
	preg_match($code, trim($line[0]), $matches);
	
	if($matches){
		$i += 1;
		$params[$i]['code'] = $line[0];

		$line = fgetcsv($fh, 1024);
		$params[$i]['location'] = substr($line[0],10,strlen($line[0]));

		$line = fgetcsv($fh, 1024);
		$params[$i]['description'] = substr($line[0],21,strlen($line[0]));

		$line = fgetcsv($fh, 1024);
		$params[$i]['applicant'] = substr($line[0],10,strlen($line[0]));

	}
	
	$_SESSION['params'] = $params;
	
	print $line[0] . $line[1]. $line[2] . "<BR>";
	unset($matches);
	
}

fclose($fh);
?>