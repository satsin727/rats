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
$uid = $_GET['id'];
 $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD);
 $q4 = "UPDATE `users` set `sess` = \"0\" where `uid` = :id ";
 $lout= $conn->prepare($q4);
 $lout->bindValue( ":id", $uid, PDO::PARAM_INT );
 $lout->execute();
 unset( $_SESSION['rat_username'] );
  unset ($_SESSION['rat_id']);
  //unset ($_SESSION['date']); 
  header( "Location: admin.php" );

?>