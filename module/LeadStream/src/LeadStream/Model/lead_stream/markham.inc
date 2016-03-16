<?php
$fh = fopen($target_path, "r");

$i = 0;
while (!feof($fh) ) {

	$line = fgetcsv($fh, 1024);
	
	$code = '/\d{2,3}$/';
	
	preg_match($code, trim($line[0]), $matches);
	
	if($matches){
		$new_leads[] = $line;
	}
	
	
	foreach($new_leads as $new_lead){
		
		echo "<p>" . $new_lead[0] . " | " . $new_lead[1]. " | " . $new_lead[2] . " | " . $new_lead[3] .  " | " . $new_lead[4] . "</p>";
	}
	unset($matches);
	
}

fclose($fh);
$num_imported = 0;
$num_failed = 0;
foreach($new_leads as $new_lead){
	
	$location = $new_lead[3];

	$location = str_replace("PLAN", " ", $location);

	// Separate out Markham for city
	$city_pattern = '/Markham ON/';
	if(preg_match($city_pattern, $new_lead[3])){
		$location = str_replace("Markham ON", " ", $location);
		$city = "Markham";
		$province = "ON";
	}

	// Separate out Markham for city
	$city_pattern = '/Markham/';
	if(preg_match($city_pattern, $new_lead[3])){
		$location = str_replace("Markham", " ", $location);
		$city = "Markham";
		$province = "ON";
	}

	// Separate out Thornhill for city
	$city_pattern = '/Thornhill ON/';
	if(preg_match($city_pattern, $new_lead[3])){
		$location = str_replace("Thornhill ON", " ", $location);
		$city = "Markham";
		$province = "ON";
	}

	// Separate out Thornhill for city
	$city_pattern = '/Thornhill/';
	if(preg_match($city_pattern, $new_lead[3])){
		$location = str_replace("Thornhill", " ", $location);
		$city = "Markham";
		$province = "ON";
	}

	$location .= "<br />{$city}, {$province}";

		if(empty($new_lead[1]))$new_lead[1] = "Unknown";
		$applicant = $new_lead[1];
		

		$notes = "{$new_lead[4]}  {$new_lead[5]}<br />Est value: {$new_lead[6]}";

		// Figure out the city


		$params = array(
			"status" => "New Lead",
			"type" => false,
			"company" => $applicant,
			"company_id" => 4,
			"created_by" => $_SESSION['user_id'],
			"rep_id" => false,
			"address" => "Unknown",
			"city" => addslashes($city),
			"province" => addslashes($province),
			"lead_source" => "Permit",
			"lead_quality" => 3,
			"location" => $location,
			"notes" => $notes,
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
	unset($leads);
echo "<p class='ok'>Successfully imported: {$num_imported} leads.</p>";

if($num_failed){
	echo "<p class='error'>Failed to import: {$num_imported} leads.</p>";
}
?>
