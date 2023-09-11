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
$ins->bindValue( ":u", $sessid, PDO::PARAM_INT );
$ins->execute();
$dta = $ins->fetch();


if(isset($_SESSION['rat_username']) && $dta['sess']==$_SESSION['rat_username'])
{

require("includes/header.php");
require("includes/menu.php");

if($dta['level'] == 1 || $dta['level'] == 2)
{

$query = "select * from assigned";
$ins= $conn->prepare($query);
$ins->execute();
$data = $ins->fetchAll();
$conn=null;
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Dashboard</li>
			</ol>
</div>
<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><a href="admin.php?action=assignconsultant"><button name="assignconsultant" class="btn btn-primary">Assign Consultant</button></a></div>
					<div class="panel-body">
						<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="uid" data-sort-order="asc">
						    <thead>
						    <tr>
						        <th data-field="uid" data-sortable="true">ID</th>
						        <th data-field="name"  data-sortable="true">Consultant Name</th>
						        <th data-field="skill" data-sortable="true">Skill</th>
						        <th data-field="Manager" data-sortable="true">Assigned Manager</th>
						        <th data-field="Action" data-sortable="true">Actions</th>
						    </tr>
						    </thead>
						   <tbody>
<?php
$i=1;
foreach( $data as $row) { 
$cid=$row['cid'];
$uid=$row['uid'];
$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$query = "select * from users where `uid` = $uid AND `status` = 1";
$ins= $conn->prepare($query);
$ins->execute();
$udata = $ins->fetch();
$query2 = "select * from consultants where `cid` = $cid AND `status` = 1";
$ins2= $conn->prepare($query2);
$ins2->execute();
$cdata = $ins2->fetch();

if($cdata['cid']!== null && $udata['uid']!== null)
{
								$sid = $cdata['skill'];
								$q2 = "select * from skill where `sid` = $sid";
								$ins3= $conn->prepare($q2);
								$ins3->execute(); 
								$dta2 = $ins3->fetch(); 
								$conn=null; 
	?>
    <tr>
  		<td data-order="<?php echo $i; ?>"> <?php echo $i; $i=$i+1;  ?></td>
    	<td data-search="<?php echo $cdata['cfname']; ?>"> <?php echo $cdata['cfname']." ".$cdata['clname']; ?></td>
    	<td data-search="<?php echo $dta2['skillname']; ?>"> <?php echo $dta2['skillname']; ?></td>    	
    	<td data-search="<?php echo $udata['name']; ?>"> <?php echo $udata['name']; ?></td>  
    	<td> 
    		<a href="assigncmd.php?do=change&id=<?php echo $row['id']; ?>"><img src="images/b_edit.png" alt="Change" width="16" height="16" border="0" title="Change" /></a>
    				 &nbsp;&nbsp;&nbsp;
    				<a href ="assigncmd.php?do=delete&id=<?php  echo $row['id']; ?>" onClick="return confirm('Are you sure you want to delete ?')"><img src="images/b_drop.png" alt="Delete" width="16" height="16" border="0" title="Delete"/></a>
    				 &nbsp;&nbsp;&nbsp;    			
    	</td> 
    </tr>
    <?php  } //for if
} //foreach
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
alert('You Need to be Admin/Manager to view this page.');
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
