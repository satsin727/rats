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

require("includes/header.php");
$selected = "reqlist";
require("includes/menu.php");




if(isset($_POST['assignrecruiter']))
		{	
			if($dta['level'] == 1 || $dta['level'] == 2)
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


if(isset($_GET['do']))
{
	$do="foobar";
	$do=$_GET['do'];	
	$id=$_GET['id'];
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><?php echo $do; ?> User Details</li>
			</ol>
		</div>
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
	if($do=='assign')
	{
		if($dta['level'] == 1 || $dta['level'] == 2)
		{
			$qcid = "select * from users where ulevel = 4 or ulevel = 2";
			$cq= $conn->prepare($qcid);
			$cq->execute();
			$cdta = $cq->fetchAll();
	?>
		<form action="#" method="post">
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
		echo "<script>
				alert(' Assigning permission is not set.');
				window.location.href='admin.php?action=reqlist';
				</script>";

	}
	if($do=='delete')
	{
		$inquery = "UPDATE `req` SET `status` = '3' WHERE `id` = $id";
		$ins= $conn->prepare($inquery);
		$ins->execute();
		echo "<script>
				alert(' Requirement has been deleted.');
				window.location.href='admin.php?action=reqlist';
				</script>"; 
	}
	if($do=='edit')
	{ 
/*
$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$query = "select * from users where `uid` = :u";
$ins= $conn->prepare($query);
$ins->bindValue( ":u", $uid, PDO::PARAM_INT );
$ins->execute();
$udata = $ins->fetch();


		?>
		
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
								<td width="15%" align="left" valign="top">	<label>Name:&nbsp;&nbsp;&nbsp;</label></td>
								<td width="90%" align="left" valign="top"><input name="name" value="<?php echo $udata['name']; ?>" class="form-control-in" placeholder="Name"></td>
</div> </tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
<div class="form-group">
									<td width="15%" align="left" valign="top"><label>Username/Email:&nbsp;&nbsp;&nbsp;</label>
								<td width="90%" align="left" valign="top">	<input name="email" value="<?php echo $udata['email']; ?>" class="form-control-in" placeholder="Email Address"></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
<div class="form-group">
									<td width="15%" align="left" valign="top"><label>Password:&nbsp;&nbsp;&nbsp;</label>
								<td width="90%" align="left" valign="top">	<input type="password" value="<?php echo $udata['password']; ?>" name="password" class="form-control-in" placeholder="Type a Password"></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>
<div class="form-group">
									<td width="15%" align="left" valign="top"><label>Company Name:&nbsp;&nbsp;&nbsp;</label>
								<td width="90%" align="left" valign="top">	<input name="companyname" value="<?php echo $udata['companyname']; ?>" class="form-control-in" placeholder="Company Name"></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>

<div class="form-group">
									<td width="15%" align="left" valign="top"><label>Access level</label>
								<td width="90%" align="left" valign="top">	<select name="level" value="<?php echo $udata['level']; ?>" class="form-control-in">
										<option value="1"> Admin</option>
           								<option value="2"> Manager/Lead</option>
            							<option value="3"> Recuiter</option>
									</select></td>
</div></tr> <tr><td><label>&nbsp;&nbsp;&nbsp;</label></td></tr> <tr>

   							<td  align="left" ><button type="submit" name="update" class="btn btn-primary">Update</button> </td>
							
                 </tr>
</form>
						
				</div></div>
			</div><!-- /.col-->
		</div><!-- /.row -->


<?php	
if(isset($_POST['update']))

{

	{
		$username = $_POST['email'];
		$name=$_POST['name'];		
		 $u = $username;
	   	 $p= $_POST['password'];
	   	 	$mdemail = md5($p); 
	    	$baseemail = base64_encode($p);
	    	$code = base64_encode($baseemail); 
	    $uhash = md5($u);
	    $companyname=$_POST['companyname'];
	    $email=$_POST['email'];
	    $password = md5($mdemail.$code);
	    $level=$_POST['level'];
	    $status=1;
		$ptext = $code;
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		 
		 $inquery = "UPDATE `users` SET `username` = '$username', `name` = '$name', `uhash` = '$uhash', `companyname` = '$companyname', `email` = '$email', `password` = '$password', `level` = '$level', `status` = '$status', `ptext` = '$ptext' WHERE `users`.`uid` = $uid";
		
		$ins= $conn->prepare($inquery);
		$ins->execute();
		header( "Location: admin.php?action=reqlist" );

	}
}
*/

} //do edit
	
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