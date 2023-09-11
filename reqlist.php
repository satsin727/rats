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

if($dta['level'] == 1 ||$dta['level'] == 2 || $dta['level'] == 3)
{

	$olddate = 0;
	if(isset($_GET['status']))
	{
		$status = $_GET['status'];
	}
	else { $status = 1; } //1 = open , 2 = reqs closed, 3 reqs deleted 
	if(isset($_POST['date']))
	{
		$cdate = $_POST['date'];
		$olddate = 1;
		$cdate = strtotime($cdate);
		$curdate =date('Y-m-d',$cdate);
	}
	else
	{
		$curdate =date('Y-m-d');
	}
	
    $showweekly=0;
	if(isset($_GET['showweekly']))
	{
		$showweekly=1;
	}

$query = "select * from req where status = $status";
$ins= $conn->prepare($query);
$ins->execute();
$data = $ins->fetchAll();
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Requirements</li>
			</ol>
</div>
<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<?php if($dta['level'] == 1 ||$dta['level'] == 2)
{  ?>
					<div class="panel-heading"><a href="admin.php?action=addreq&type=1"><button name="addauser" class="btn btn-primary">Add a C2C Requirement</button></a></div>


				<?php } ?>
					<div class="panel-body">
						<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="uid" data-sort-order="asc">
						    <thead>
						    <tr>
						        <th data-field="id" data-sortable="true">ID</th>
								<th data-field="Datetime"  data-sortable="true">Datetime</th>
						        <th data-field="Subject"  data-sortable="true">Subject</th>								
								<th data-field="Client" data-sortable="true">Client</th>
								<th data-field="Rate" data-sortable="true">Buy Rate</th>								
								<th data-field="Req type" data-sortable="true">Type</th>
						        <th data-field="SM" data-sortable="true">SM</th>
						        <th data-field="Submissions" >Submissions</th>
						        <th data-field="Status" >Status</th>
						        <th data-field="cmd" >Actions</th>
						    </tr>
						    </thead>
						   <tbody>
<?php
$i=1;
foreach( $data as $row) { 
	
	$sm_id = $row['sm'];
	$sm_name = $conn->query("select name from users where uid = $sm_id")->fetchColumn(); 
	
	if($row['contract_type']== 1 && $row['needonw2'] == 1) 
	{
		$req_type = "C2C";
	}
	else if($row['contract_type']== 1 && $row['needonw2'] == 2) 
	{
		$req_type = "C2C/need on W2";
	}
	else if($row['contract_type']== 2 && $row['needonw2'] == 1) 
	{
		$req_type = "C2H";
	}
	else if($row['contract_type']== 2 && $row['needonw2'] == 2) 
	{
		$req_type = "C2H/need on W2";
	}
	else if($row['contract_type']== 3) 
	{
		if($row['needonw2'] == 2) { $req_type = "Referral"; } else { $req_type = "FTE"; }
		$referral = "$".$row['referral']."/hr";
		$salary = "$".$row['salary']."/annually";
	}
	?>
    <tr>
  		<td data-order="<?php echo $i; ?>"> <?php echo $i; $i=$i+1;  ?></td>
		<td data-search="<?php echo $row['date']; ?>"> <?php $time = strtotime($row['date']); $myFormatForView = date("m/d/y g:i A", $time); echo $myFormatForView; ?></td>
    	<td data-search="<?php echo $row['title']." - ".$row['location']." - ".$row['duration']; ?>"> <a href="leads/view.php?id=<?php echo $row['id']; ?>" target="_blank"><?php echo $row['title']." - ".$row['location']." - ".$row['duration']; ?> </a> </td>
    	<td data-search="<?php echo $row['end_client']; ?>"> <?php echo $row['end_client']; ?></td>
    	
		<td> <?php if($row['contract_type']== 3)
		{
			if($row['needonw2'] == 2) { echo $referral; }
			else { echo $salary; }
		}
		else {
		echo "$".$row['min_buy_rate']."-"."$".$row['max_buy_rate']."/hr"; } ?></td>		
    	<td data-search="<?php echo $req_type; ?>"> <?php echo $req_type; ?></td>
    	<td data-search="<?php echo $sm_name; ?>"> <?php echo $sm_name; ?></td>
    	<td data-search="<?php echo $row['number_of_subs']; ?>"> <?php echo $row['number_of_subs']; ?></td>

    	<td> <?php if($row['status']==1) { echo "Active"; } else if($row['status']==3) { echo "Deleted"; } else { echo "closed"; } ?></td>
    	<td> 
		<a href ="reqcmd.php?do=assign&id=<?php echo $row['id']; ?>" onclick="window.open(this.href,'popupwindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,height=400,width=400,addressbar=no'); return false;"><button name="assignrecruiter" class="btn btn-primary">Assign</button></a>
    		<a href="reqcmd.php?do=edit&id=<?php echo $row['id']; ?>"><img src="images/b_edit.png" alt="Edit" width="16" height="16" border="0" title="Edit" /></a>
    				 &nbsp;&nbsp;&nbsp;
    	<?php if($dta['level'] == 1) {  ?>	<a href ="reqcmd.php?do=delete&id=<?php echo $row['id']; ?>" onClick="return confirm('Are you sure you want to delete ?')"><img src="images/b_drop.png" alt="Delete" width="16" height="16" border="0" title="Delete"/></a> &nbsp;&nbsp;&nbsp; <?php } ?>
    				 
    		<a href="reqcmd.php?do=changestatus&id=<?php echo $row['id']; ?>"><?php if($row['status']==1) { echo "Deactivate"; } else echo "Activate"; ?></a>
    		
    	</td>
    </tr>
    <?php
}
?>
						   </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

</div>
<?php

}
else
{
	echo "<script>
alert('You Need to be Authorised User to view this page.');
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
