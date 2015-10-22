<?php
$fh = fopen($target_path, "r");

$filename = basename($target_path);         // $file is set to "index.php"
$filename = basename($target_path, ".csv"); // $file is set to "index"

$i = 0;
while (!feof($fh) ) {

	$line = fgetcsv($fh, 1024);

	$code = '/^\d{2}\s\d{6}\s\d{3}/';
	
	preg_match($code, trim($line[0]), $matches);
	
	if($matches){
		$i += 1;
		$leads[$i]['code'] = $line[0];

		$line = fgetcsv($fh, 1024);
		$leads[$i]['location'] = substr($line[0],10,strlen($line[0]));

		$line = fgetcsv($fh, 1024);
		$leads[$i]['description'] = substr($line[0],21,strlen($line[0]));

		$line = fgetcsv($fh, 1024);
		$leads[$i]['applicant'] = substr($line[0],10,strlen($line[0]));

	}
	
	$_SESSION['leads'] = $leads;
	
	// print $line[0] . $line[1]. $line[2] . "<BR>";
	unset($matches);
	
}

fclose($fh);
$num_imported = 0;
$num_failed = 0;
foreach($_SESSION['leads'] as $param){
		$param['location'] = str_replace("Unit 0000", " ", $param['location']);
		$param['location'] = str_replace("Unit", " Unit", $param['location']);
		$location = explode(",", $param['location']);
		$applicant = explode(",", $param['applicant']);

		$params = array(
			"status" => "New Lead",
			"type" => false,
			"company" => $applicant[0],
			"company_id" => 5,
			"created_by" => $_SESSION['user_id'],
			"rep_id" => false,
			"address" => addslashes($applicant[1]),
			"city" => addslashes($applicant[2]),
			"province" => addslashes($applicant[3]),
			"lead_source" => "Permit",
			"lead_quality" => 3,
			"location" => $param['location'],
			"notes" => $param['description'] . "<br />" . $source,
			"timestamp" => time()
		);
echo "<div id='lead_stream'>";

		try{
			$lead = new EcoLeadStream;
			(int)$lead_id = $lead->insert($params);
			$num_imported += 1;
		}catch(Exception $e){
			echo "<p>" . $e->getMessage() . "</p>";
			$num_failed += 1;
		}
echo "</div>";		
	}
	unset($_SESSION['leads']);
echo "<p class='ok'>Successfully imported: {$num_imported} leads.</p>";

if($num_failed){
	echo "<p class='error'>Failed to import: {$num_imported} leads.</p>";
}
?>