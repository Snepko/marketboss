<?php
	$leads = new EcoLeadStream;
	$leads = $leads->fetchAll();

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['form-name']=="accept-lead"){
	try{

		$lead = new EcoLeadStream;
		$lead = $lead->fetch($_POST['id']);
		$lead_id = $lead->id;

		$params = array(
			"status" => addslashes($lead->status),
			"type" => '',
			"company" => addslashes($lead->company),
			"company_id" => $lead->company_id,
			"created_by" => $_SESSION['user_id'],
			"rep_id" => addslashes($lead->rep_id),
			"contractor" => addslashes($lead->company),
			"account" => addslashes($lead->account),
			"fname" => addslashes($lead->fname),
			"mname" => addslashes($lead->mname),
			"lname" => addslashes($lead->lname),
			"address" => addslashes($lead->address),
			"address2" => addslashes($lead->address2),
			"city" => addslashes($lead->city),
			"province" => addslashes($lead->province),
			"postal" => addslashes($lead->postal),
			"phone_day" => addslashes($lead->phone_day),
			"phone_day_ext" => addslashes($lead->phone_day_ext),
			"phone_evening" => addslashes($lead->phone_evening),
			"phone_cell" => addslashes($lead->phone_cell),
			"phone_fax" => addslashes($lead->phone_fax),
			"email" => addslashes($lead->email),
			"website" => addslashes($lead->website),
			"lead_source" => addslashes($lead->lead_source),
			"lead_quality" => addslashes($lead->lead_quality),
			"timestamp" => time(),
			"hotspot" => "Testing"
		);

			
			// We won't include "Unknown" so it is easier to keep different company permits separate
			if($lead->company != "Unknown"){
				$customer = new EcoLeadStream;
				$customer = $customer->matchCompany($params['company']);

			}else{
				$customer = false;
			}


			// If customer doesn't already exist
			if($customer){

				try{
					$customer_params = array(
						"hotspot" => $lead->location
					);
					$where = "id = {$customer->id}";
					$customer->update($customer_params, $where);
				}catch(Exception $e){
					echo $e->getMessage(); 
				}
				



				/* 
				 *  Add a note to the company and update the lead status and quality
				 */
		
				$journal_params = array(
				  company_id => $params['company_id'],
				  user_id => $_SESSION['user_id'],
				  customer_id => $customer->id,
				  activity => "<span style='color:green'>New Permit</span>",
				  notes => $lead->notes . "<br />" . $lead->location,
				  timestamp => time()
				);


				try{
					$journal = new EcoJournal;
					$journal = $journal->insert($journal_params);

					$lead = new EcoLeadStream;
					$lead = $lead->fetch($lead_id);

					$lead->delete($lead_id);

				}catch(Exception $e){

				}
				

			}else{


				/* 
				 *  Create a new customer
				 */
				try{
					$customer = new EcoCustomer;
					(int)$customer_id = $customer->insert($params);
					$customer = $customer->fetch($customer_id);

					if($customer){

						$customer_params = array(
							"hotspot" => $lead->location
						);
						$where = "id = {$customer->id}";
						$customer->update($customer_params, $where);
						/* 
						 *  Add a note to the company and update the lead status and quality
						 */
				
						$journal_params = array(
						  company_id => $params['company_id'],
						  user_id => $_SESSION['user_id'],
						  customer_id => $customer->id,
						  activity => "<span style='color:green'>New Permit</span>",
						  notes => $lead->notes . "<br />" . $lead->location,
						  timestamp => time()
						);

						try{
							$journal = new EcoJournal;
							$journal = $journal->insert($journal_params);

							$lead = new EcoLeadStream;
							$lead = $lead->fetch($lead_id);

							$lead->delete($lead_id);
						}catch(Exception $e){

						}
						//header("Location: lead_stream.php");
					}
					
				}catch(Exception $e){
					$_SESSION['message'] = "<p class='error'>{$e->getMessage()}</p>";
				}
			
			}	
		
	header("Location: lead_stream.php");

	} catch(Exception $e){
		$_SESSION['message'] = "<p class='error'>{$e->getMessage()}</p>";
		exit;
		header("Location: lead_stream.php");
	}
}


if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['form-name']=="reject-lead"){
	try{
		$lead = new EcoLeadStream;
		$lead->delete($_POST['id']);
		header("Location: lead_stream.php");
	}catch(Exception $e){

	}
	
}
?>