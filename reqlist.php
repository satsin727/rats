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

$query = "select * from req";
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
					<div class="panel-heading"><a href="admin.php?action=addreq&type=1"><button name="addauser" class="btn btn-primary">Add a Requirement</button></a></div>


				<?php } ?>
					<div class="panel-body">
						<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="uid" data-sort-order="asc">
						    <thead>
						    <tr>
						        <th data-field="id" data-sortable="true">ID</th>
						        <th data-field="Subject"  data-sortable="true">Subject</th>
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
	
	?>
    <tr>
  		<td data-order="<?php echo $i; ?>"> <?php echo $i; $i=$i+1;  ?></td>
    	<td data-search="<?php echo $row['title']." - ".$row['location']." - ".$row['duration']; ?>"> <a href="leads/view.php?id=<?php echo $row['id']; ?>" target="_blank"><?php echo $row['title']." - ".$row['location']." - ".$row['duration']; ?> </a> </td>
    	<td data-search="<?php echo $sm_name; ?>"> <?php echo $sm_name; ?></td>
    	<td data-search="<?php echo $row['number_of_subs']; ?>"> <?php echo $row['number_of_subs']; ?></td>

    	<td> <?php if($row['status']==1) { echo "Active"; } else echo "closed"; ?></td>
    	<td> 
    		<a href="reqcmd.php?do=edit&id=<?php echo $row['id']; ?>"><img src="images/b_edit.png" alt="Edit" width="16" height="16" border="0" title="Edit" /></a>
    				 &nbsp;&nbsp;&nbsp;
    				<a href ="reqcmd.php?do=delete&id=<?php echo $row['id']; ?>" onClick="return confirm('Are you sure you want to delete ?')"><img src="images/b_drop.png" alt="Delete" width="16" height="16" border="0" title="Delete"/></a>
    				 &nbsp;&nbsp;&nbsp;
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
