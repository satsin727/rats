<?php
if($_SESSION['rat_id'])
{
$sessid = $_SESSION['rat_id'];
}
else
{
	header( "Location: admin.php" ); 

}
$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$query = "select * from users where `uid` = :u";
$ins= $conn->prepare($query);
$ins->bindValue( ":u", $sessid, PDO::PARAM_STR );
$ins->execute();
$dta = $ins->fetch();


if(isset($_SESSION['rat_username']) && $dta['sess']==$_SESSION['rat_username'])
{

require("includes/header.php");
require("includes/menu.php");

if($dta['level'] == 1 || $dta['level'] == 2)
{

$reqtype = $_GET['type'];


if(isset($_POST['save']))
		{
		$sub_rate = "0";
		$min_buy_rate = "0";
		$max_buy_rate = "0";
		$referral = "0";
		$salary = "0";
		$end_client = "Confidential";
		$description = "";
		$add_notes = "";

		$reqtype = $_POST['reqtype'];
		$title = $_POST['title'];
		$location = $_POST['location'];
		$duration = $_POST['duration'];
		$contract_type = $_POST['contract_type'];
		$visa = $_POST['visa'];
		$local = $_POST['local'];
		$interview = $_POST['interview'];
		if(isset($_POST['sub_rate']))
			{		$sub_rate = $_POST['sub_rate'];		
					if($sub_rate<50)
			{ $min_buy_rate = $sub_rate - 10;
			  $max_buy_rate = $sub_rate -5; }
		else if($sub_rate<85)
			{ $min_buy_rate = $sub_rate - 20;
			  $max_buy_rate = $sub_rate - 10; }
	    else if($sub_rate<100)
			{ $min_buy_rate = $sub_rate - 25;
			  $max_buy_rate = $sub_rate - 10; }
		else if($sub_rate>100)
			{ $min_buy_rate = $sub_rate - 25;
			  $max_buy_rate = $sub_rate - 15; }
		$buy_rate = "$".$min_buy_rate."-".$max_buy_rate."/hr"; }
		if(isset($_POST['referral']))
			{		$referral = $_POST['referral']; 	}
		if(isset($_POST['salary']))
			{		$salary = $_POST['salary'];	}
		$end_client = $_POST['end_client'];
		$tier1_ip= $_POST['tier1_ip'];
		$needonw2 = $_POST['needonw2'];
		$description = base64_encode($_POST['description']);
		$add_notes= $_POST['add_notes'];

		$sm = $sessid;
		$number_of_subs = "0";
		$status = "1";
		$date = date("Y-m-d H:i:s");


		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$inquery = "INSERT INTO `req` (`id`, `title`, `location`, `duration`, `req_type`,`contract_type`, `visa`, `local`, `interview`, `sub_rate`, `min_buy_rate`, `max_buy_rate`,`referral`, `salary`, `end_client`, `tier1_ip`, `needonw2`, `description`, `add_notes`, `sm`, `number_of_subs`, `status`, `date`) 
VALUES (NULL, '$title', '$location', '$duration', '$reqtype', '$contract_type', '$visa', '$local', '$interview', '$sub_rate', '$min_buy_rate','$max_buy_rate', '$referral', '$salary', '$end_client', '$tier1_ip', '$needonw2', '$description', '$add_notes', '$sm', '$number_of_subs', '$status', '$date');";
		$ins= $conn->prepare($inquery);
		$ins->execute();
		header( "Location: admin.php?action=reqlist" );

		}

		else { ?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href=""><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Add Requirement</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">&nbsp;
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">

					<form action="#" method="post">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
<div class="form-group">
								<td width="15%" align="left" valign="top">	<label>Job Title:&nbsp;&nbsp;&nbsp;</label></td>
								<td width="90%" align="left" valign="top"><input name="title" class="form-control-in" placeholder="Job Title"></td>
</div> </tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
<div class="form-group">
									<td width="15%" align="left" valign="top"><label>Location:&nbsp;&nbsp;&nbsp;</label></td>
								<td width="90%" align="left" valign="top">	<input name="location" class="form-control-in" placeholder="Job Location"></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
<div class="form-group">
									<td width="15%" align="left" valign="top"><label>Duration:&nbsp;&nbsp;&nbsp;</label></td>
								<td width="90%" align="left" valign="top">	<input name="duration" class="form-control-in" placeholder="Duration in Months"></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
<div class="form-group">
									<td width="15%" align="left" valign="top"><label>CTH Role?:&nbsp;&nbsp;&nbsp;</label></td>
								<td width="90%" align="left" valign="top">										<select name="contract_type" class="form-control-in">
								<option value="1"> No </option>		
								<option value="2"> Yes </option>
           						<option value="3"> No, Referral/FTE Role </option>
									</select></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>

<div class="form-group">
									<td width="15%" align="left" valign="top"><label>Visa:&nbsp;&nbsp;&nbsp;</label></td>
								<td width="90%" align="left" valign="top">	<input name="visa" class="form-control-in" placeholder="Mention Visa Status Needed"></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>

<div class="form-group">
									<td width="15%" align="left" valign="top"><label>Consultant Location:&nbsp;&nbsp;&nbsp;</label></td>
								<td width="90%" align="left" valign="top">	
									<select name="local" class="form-control-in">
										<option value="1"> Only Locals Needed </option>
										<option value="2"> Only Locals Needed, F2F Needed</option>
           								<option value="3"> Local Preferred, F2F Mandatory</option>
           								<option value="4"> Non Local Fine</option>
           								<option value="5"> Consultant should be in same timezone.</option>
									</select></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>

<div class="form-group">
									<td width="15%" align="left" valign="top"><label>Interview:&nbsp;&nbsp;&nbsp;</label></td>
								<td width="90%" align="left" valign="top">	<input name="interview" class="form-control-in" placeholder="Mode of Interview"></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
<?php if($reqtype == 1) { ?>
<div class="form-group">
									<td width="15%" align="left" valign="top"><label>Submission Rate:&nbsp;&nbsp;&nbsp;</label></td>	
								<td width="90%" align="left" valign="top">	<input name="sub_rate" class="form-control-in" placeholder="Rate from Client"></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>

<?php } ?>
<?php if($reqtype == 2) { ?>
<div class="form-group">

									<td width="15%" align="left" valign="top"><label>Referral fee:&nbsp;&nbsp;&nbsp;</label></td>
								<td width="90%" align="left" valign="top">	<input name="referral" class="form-control-in" placeholder="Referral fee per hour"></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
<?php } ?>
<?php if($reqtype == 3) { ?>
<div class="form-group">

									<td width="15%" align="left" valign="top"><label>FTE Salary:&nbsp;&nbsp;&nbsp;</label></td>
								<td width="90%" align="left" valign="top">	<input name="salary" class="form-control-in" placeholder="Annual Salary"></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
<?php } ?>


<div class="form-group">
									<td width="15%" align="left" valign="top"><label>End Client Name:&nbsp;&nbsp;&nbsp;</label></td>
								<td width="90%" align="left" valign="top">	<input name="end_client" class="form-control-in" placeholder="End Client"></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
<div class="form-group">
									<td width="15%" align="left" valign="top"><label>Tier 1/IP Name:&nbsp;&nbsp;&nbsp;</label></td>
								<td width="90%" align="left" valign="top">	<input name="tier1_ip" class="form-control-in" placeholder="Tier 1/IP"></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>

<div class="form-group">
									<td width="15%" align="left" valign="top"><label>Need on W2?:&nbsp;&nbsp;&nbsp;</label></td>
								<td width="90%" align="left" valign="top">
									<select name="needonw2" class="form-control-in">
										<option value="1"> No </option>
           								<option value="2"> Yes </option>
									</select></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>


<div class="form-group">
									<td width="15%" align="left" valign="top"><label>Job Description:&nbsp;&nbsp;&nbsp;</label></td>
								<td width="90%" align="left" valign="top"><textarea class="ckeditor" name="description" ></textarea></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
<div class="form-group">
									<td width="15%" align="left" valign="top"><label>Additional notes:&nbsp;&nbsp;&nbsp;</label></td>
								<td width="90%" align="left" valign="top">	<input name="add_notes" class="form-control-in" placeholder="Backfill/Urgent Hire/Immediate Interview"></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>

<input type="hidden" name="reqtype" value="<?php echo $reqtype; ?>">

   							<td  align="left" ><button type="submit" name="save" class="btn btn-primary">Save</button> </td>					
                 </tr>
                 </table>

</form>
						
				</div></div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div>
<?php
}

}
else
{
	echo "<script>
alert('You Need to be Admin to view this page.');
window.location.href='admin.php';
</script>"; 
}
require("includes/footer.php"); 
}
else
{ echo "<script>
alert('Not Authorised to view this page, Not a valid session. Your IP address has been recorded for review. Please Log-in again to view this page !!!');
window.location.href='login.php';
</script>";   }

?>
