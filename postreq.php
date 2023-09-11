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

?> 

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Post Requirment</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
			<a href="admin.php?action=addreq&type=1"><button class="btn">Post Contract Requirment</button></a>
			<a href="admin.php?action=addreq&type=2"><button class="btn">Post Referral Requirment</button></a>
			<a href="admin.php?action=addreq&type=3"><button class="btn">Post FTE Requirement</button></a>
			</div>
		</div><!--/.row-->
		
	</div>	<!--/.main-->

<?php
require("includes/footer.php"); 
}
else
{ echo "<script>
alert('Not Authorised to view this page, Not a valid session. Your IP address has been recorded for review. Please Log-in again to view this page !!!');
window.location.href='login.php';
</script>";   }

?>