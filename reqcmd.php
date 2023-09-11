<?php
require( "config.php" );
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

//require("includes/header.php");
$selected = "reqlist";
//require("includes/menu.php");




if(isset($_POST['assignrecruiter']))
		{	
			if($dta['level'] == 1 || $dta['level'] == 2 || $dta['level'] == 3)
		{
			$req_id = $_POST['req_id'];
			$rec_id = $_POST['rec_id'];			
			$assignedby = $_POST['uid'];
			$currentdatetime =date('Y-m-d H:i:s');

			$inquery = "INSERT INTO `assigned` (`id`, `req_id`, `rec_id`, `assignedby`, `datetime`) 
VALUES (NULL, '$req_id', '$rec_id', '$assignedby', '$currentdatetime');";
		$ins= $conn->prepare($inquery);
		$ins->execute();
			echo "<script>alert('Recruiter assigned to this role.');window.close();</script>"; 
		}
		echo "<script>alert('You need permission to assign recruiters.');window.close();</script>";
	}

if($dta['level'] == 1 || $dta['level'] == 2 || $dta['level'] == 3)
{

	if(isset($_POST['editreqsave']))
	{	
		$sub_rate = "0";
		$min_buy_rate = "0";
		$max_buy_rate = "0";
		$referral = "0";
		$salary = "0";
		$req_id = $_POST['req_id'];
		$reqtype = $_POST['reqtype'];
		$currentdatetime =date('Y-m-d H:i:s');

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


		$inquery = "Update `req` set `title` = $title, `location` = $location, `duration` = $duration, `req_type` = $reqtype,`contract_type` = $contract_type, `visa` = $visa, `local` = $local, `interview` = $interview, `sub_rate` = $sub_rate, `min_buy_rate` = $min_buy_rate, `max_buy_rate` = $max_buy_rate,`referral` = $referral, `salary` = $salary, `end_client` = $end_client, `tier1_ip` = $tier1_ip, `needonw2` = $needonw2, `description` = $description, `add_notes` = $add_notes, `date`= $currentdatetime where id = $req_id";
		$ins= $conn->prepare($inquery);
		$ins->execute();
		echo "<script>alert('Requirement updated');window.location.href='admin.php?action=reqlist';</script>"; 

}
if(isset($_GET['do']))
{
	$do="foobar";
	$do=$_GET['do'];	
	$id=$_GET['id'];
	?>
	
		<?php
	if($do=='changestatus')
	{
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$query ="Select * FROM req where id = $id";
		$ins= $conn->prepare($query);
		$ins->execute();
		$udata = $ins->fetch();
		$status = $udata['status'];

		if($status==1) 
			{ 
				$inquery = "UPDATE `req` SET `status` = '0' WHERE `id` = $id";
				$ins= $conn->prepare($inquery);
				$ins->execute();
				echo "<script>
						alert(' Requirement has been Disabled.');
						window.location.href='admin.php?action=reqlist';
						</script>"; 

			}

		if($status==0 || $status==3) 
			{ 
				$inquery = "UPDATE `req` SET `status` = '1' WHERE `id` = $id";
				$ins= $conn->prepare($inquery);
				$ins->execute();
				echo "<script>
						alert(' Requirement has been Enabled.');
						window.location.href='admin.php?action=reqlist';
						</script>"; 

			}
	
	}
	else if($do=='assign')
	{
		if($dta['level'] == 1 || $dta['level'] == 2 || $dta['level'] == 3)
		{
			$qcid = "select * from users where level = 4 or level = 2";
			$cq= $conn->prepare($qcid);
			$cq->execute();
			$cdta = $cq->fetchAll();
	?>
		<form action="#" method="post">
			<br><br>
			<tr> <td><label>Recruiter:</label> </td>
				<td> 
				<select name="rec_id" >
									<?php
								foreach( $cdta as $row) { ?>
										<option value="<?php echo $row['uid']; ?>"><?php echo $row['name']."<".$row['email'].">"; ?></option>
									<?php } ?></select>
				</td> 
			</tr> 
            	<br> <input type="hidden" name="uid" value="<?php echo $dta['uid']; ?>">
				<br> <input type="hidden" name="req_id" value="<?php echo $id; ?>">
		
			<tr> 				
			<td class="button">
			<button type="submit" name="assignrecruiter">Assign</button> </td>
			</tr>
		</form>

	<?php
		}
		else {
		echo "<script>
				alert(' Assigning permission is not set.');
				window.close();
				</script>"; }

	}
	else if($do=='delete')
	{
		$inquery = "UPDATE `req` SET `status` = '3' WHERE `id` = $id";
		$ins= $conn->prepare($inquery);
		$ins->execute();
		echo "<script>
				alert(' Requirement has been deleted.');
				window.location.href='admin.php?action=reqlist';
				</script>"; 
	}

	else if($do=='edit')
	{

require("includes/header.php");
$selected = "reqlist";
require("includes/menu.php");

$qcid = "select * from req where id = $id";
$cq= $conn->prepare($qcid);
$cq->execute();
$cdta = $cq->fetch();
		?>

				<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
				<div class="row">
					<ol class="breadcrumb">
						<li><a href=""><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
						<li class="active">Edit Requirement</li>
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
										<td width="90%" align="left" valign="top"><input name="title" class="form-control-in" value="<?php echo $cdta['title']; ?>" ></td>
		</div> </tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
		<div class="form-group">
											<td width="15%" align="left" valign="top"><label>Location:&nbsp;&nbsp;&nbsp;</label></td>
										<td width="90%" align="left" valign="top">	<input name="location" class="form-control-in" value="<?php echo $cdta['location']; ?>" ></td>
		</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
		<div class="form-group">
											<td width="15%" align="left" valign="top"><label>Duration:&nbsp;&nbsp;&nbsp;</label></td>
										<td width="90%" align="left" valign="top">	<input name="duration" class="form-control-in" value="<?php echo $cdta['duration']; ?>" ></td>
		</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
		<div class="form-group">
											<td width="15%" align="left" valign="top"><label>CTH Role?:&nbsp;&nbsp;&nbsp;</label></td>
										<td width="90%" align="left" valign="top">										<select name="contract_type" class="form-control-in">
										<option value="1" <?php if($cdta['contract_type']==1) { echo "selected";} ?>> No </option>		
										<option value="2" <?php if($cdta['contract_type']==2) { echo "selected";} ?>> Yes </option>
										<option value="3" <?php if($cdta['contract_type']==3) { echo "selected";} ?>> No, Referral/FTE Role </option>
											</select></td>
		</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>

		<div class="form-group">
											<td width="15%" align="left" valign="top"><label>Visa:&nbsp;&nbsp;&nbsp;</label></td>
										<td width="90%" align="left" valign="top">	<input name="visa" class="form-control-in" value="<?php echo $cdta['visa']; ?>"></td>
		</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>

		<div class="form-group">
											<td width="15%" align="left" valign="top"><label>Consultant Location:&nbsp;&nbsp;&nbsp;</label></td>
										<td width="90%" align="left" valign="top">	
											<select name="local" class="form-control-in">
												<option value="1" <?php if($cdta['local']==1) { echo "selected";} ?>> Only Locals Needed </option>
												<option value="2" <?php if($cdta['local']==2) { echo "selected";} ?>> Only Locals Needed, F2F Needed</option>
												<option value="3" <?php if($cdta['local']==3) { echo "selected";} ?>> Local Preferred, F2F Mandatory</option>
												<option value="4" <?php if($cdta['local']==4) { echo "selected";} ?>> Non Local Fine</option>
												<option value="5" <?php if($cdta['local']==5) { echo "selected";} ?>> Consultant should be in same timezone.</option>
											</select></td>
		</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>

		<div class="form-group">
											<td width="15%" align="left" valign="top"><label>Interview:&nbsp;&nbsp;&nbsp;</label></td>
										<td width="90%" align="left" valign="top">	<input name="interview" class="form-control-in" value="<?php echo $cdta['interview']; ?>"></td>
		</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
		<?php if($cdta['req_type'] == 1) { ?>
		<div class="form-group">
											<td width="15%" align="left" valign="top"><label>Submission Rate:&nbsp;&nbsp;&nbsp;</label></td>	
										<td width="90%" align="left" valign="top">	<input name="sub_rate" class="form-control-in" value="<?php echo $cdta['sub_rate']; ?>"></td>
		</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>

		<?php } ?>
		<?php if($cdta['req_type'] == 2) { ?>
		<div class="form-group">

											<td width="15%" align="left" valign="top"><label>Referral fee:&nbsp;&nbsp;&nbsp;</label></td>
										<td width="90%" align="left" valign="top">	<input name="referral" class="form-control-in" value="<?php echo $cdta['referral']; ?>"></td>
		</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
		<?php } ?>
		<?php if($cdta['req_type'] == 3) { ?>
		<div class="form-group">

											<td width="15%" align="left" valign="top"><label>FTE Salary:&nbsp;&nbsp;&nbsp;</label></td>
										<td width="90%" align="left" valign="top">	<input name="salary" class="form-control-in" value="<?php echo $cdta['salary']; ?>"></td>
		</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
		<?php } ?>


		<div class="form-group">
											<td width="15%" align="left" valign="top"><label>End Client Name:&nbsp;&nbsp;&nbsp;</label></td>
										<td width="90%" align="left" valign="top">	<input name="end_client" class="form-control-in" value="<?php echo $cdta['end_client']; ?>"></td>
		</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
		<div class="form-group">
											<td width="15%" align="left" valign="top"><label>Tier 1/IP Name:&nbsp;&nbsp;&nbsp;</label></td>
										<td width="90%" align="left" valign="top">	<input name="tier1_ip" class="form-control-in" value="<?php echo $cdta['tier1_ip']; ?>"></td>
		</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>

		<div class="form-group">
											<td width="15%" align="left" valign="top"><label>Need on W2?:&nbsp;&nbsp;&nbsp;</label></td>
										<td width="90%" align="left" valign="top">
											<select name="needonw2" class="form-control-in">
												<option value="1" <?php if($cdta['needonw2']==1) { echo "selected";} ?>> No </option>
												<option value="2" <?php if($cdta['needonw2']==2) { echo "selected";} ?>> Yes </option>
											</select></td>
		</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>


		<div class="form-group">
											<td width="15%" align="left" valign="top"><label>Job Description:&nbsp;&nbsp;&nbsp;</label></td>
										<td width="90%" align="left" valign="top"><textarea class="ckeditor" name="description" ><?php echo base64_decode($cdta['description']); ?></textarea></td>
		</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
		<div class="form-group">
											<td width="15%" align="left" valign="top"><label>Additional notes:&nbsp;&nbsp;&nbsp;</label></td>
										<td width="90%" align="left" valign="top">	<input name="add_notes" class="form-control-in" value="<?php echo $cdta['add_notes']; ?>"></td>
		</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>

		<input type="hidden" name="reqtype" value="<?php echo $cdta['req_type']; ?>">
		<input type="hidden" name="req_id" value="<?php echo $cdta['id']; ?>">

									<td  align="left" ><button type="submit" name="editreqsave" class="btn btn-primary">Save</button> </td>					
						</tr>
						</table>

		</form>
								
						</div></div>
					</div><!-- /.col-->
				</div><!-- /.row -->
				
			</div>




	<?php

	}
	
	else
	{
				echo "<script>
		alert('Not a valid command.');
		window.location.href='admin.php?action=reqlist';
		</script>";
	} 


} //for $do

} //for admin
else
{
	echo "<script>
alert('You Need to be Admin to view this page.');
window.location.href='admin.php';
</script>"; 
}

?>
</div>

<?php
require("includes/footer.php"); 
}
else
{ echo "<script>
alert('Not Authorised to view this page, Not a valid session. Your IP address has been recorded for review. Please Log-in again to view this page !!!');
window.location.href='login.php';
</script>";   }

?>