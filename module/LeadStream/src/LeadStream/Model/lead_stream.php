<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/initialize.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/library/Authenticate.php"); ?>
<?php require_once("lead_stream.inc"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Eco Enterprise - Customers</title>
<?php include_once('../../template/includes.php'); ?>

<style>
.current{background-color: #ccffcc;}
#customer_search{margin-bottom:10px;top: 0px;}
.submit{float: left;}
</style>
</head>

<body id="customers">


<?php include_once('../../template/header.php'); ?>
    

<div id="content" class="container-fluid">


<h1><span>ECO</span> Lead Stream</h1>
<?php if(isset($_SESSION['message'])){echo $_SESSION['message']; unset($_SESSION['message']);} ?>
<br/>
<table width="100%" border="0" cellspacing="0" cellpadding="7" id="customers_table">
  <tr>
    <td class="tdgreen1" width='10%'>CUSTOMER</td>
    <td class='tdgreen1' width='8%'>PROJECT LOCATION</td>
    <td class='tdgreen1' width='10%'>DESCRIPTION</td>
    <td align="center" class="tdgreen1" width='9%'>ACTIONS</td>
  </tr>

<?php 
/* Get data for table */
//$customers = $data['customers'];

if($leads){

foreach($leads as $lead){
?>

<tr onmouseover="this.className='current';" onmouseout="this.className='';" class='click-here'>
	<td><?= stripslashes($lead->company); ?><br /><?= stripslashes($lead->address); ?><br /><?= stripslashes($lead->city); ?>, <?= stripslashes($lead->province); ?></td>
	<td><?= stripslashes($lead->location); ?></td>
	<td><?= stripslashes($lead->notes); ?></td>
	<td>




	<form name='generate-customer' action='lead_stream.php' method='post'>
		<input type='hidden' name='id' value='<?=$lead->id; ?>' />
		<input type='hidden' name='company' value='<?=$lead->company; ?>' />
		<input type='hidden' name='form-name' value='accept-lead' />
		<input type='submit' name='submit' value='Accept' class='submit'/>
	</form>




	<form name='generate-customer' action='lead_stream.php' method='post'>
		<input type='hidden' name='id' value='<?=$lead->id; ?>' />
		<input type='hidden' name='company' value='<?=$lead->company; ?>' />
		<input type='hidden' name='form-name' value='reject-lead' />
		<input type='submit' name='submit' value='Reject' class='submit'/>
	</form>



	</td>
</tr>


<?php }

}?>

</table>
<input type='hidden' name='form_name' value='customers_selection' />
</form>
  <?php //include($cust_list); 
  ?>
<div id="pager">
<div id='page_controls_2'>

</div>
<!-- end #page_controls_2 -->
  
</div><!-- end #pager-->


</div>


<?php include_once('../../template/footer.php'); ?>

</body>
</html>
