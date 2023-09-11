<?php

require( "config.php" );

$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['rat_username'] ) ? $_SESSION['rat_username'] : "";

if ( $action != "login" && $action != "logout" && !$username ) {
  login();
  exit;
}

switch ( $action ) {
  case 'login':
    login();
    break;
  case 'logout':
    logout();
    break;
  case 'adduser':
    adduser();
    break;
  case 'addreq':
    addreq();
    break;
  case 'addskill':
    addskill();
    break;
  case 'listusers':
    listusers();
    break;
  case 'listconsultants':
    listconsultants();
    break;
  case 'addconsultant':
    addconsultant();
    break;
  case 'assignreq':
    assignreq();
    break;
  case 'assigned':
    assigned();
    break;
  case 'assignconsultant':
    assignconsultant();
    break;
  case 'listall':
    listall();
    break;
  case 'addlist':
    addlist();
    break; 
  case 'clientslist':
    clientslist();
    break;
  case 'reqlist':
    reqlist();
    break;
  case 'updatedhotlist':
    updatedhotlist();
    break;
  case 'clientlistdownload':
    clientlistdownload();
    break;
  case 'postreq':
    postreq();
    break;
  default:
    dashboard();
}


function login() {

  if ( isset( $_POST['login'] ) ) {

    // User has posted the login form: attempt to log the user in
    $u = $_POST['username'];
    $p= $_POST['password']; 
    $mdemail = md5($p); 
    $baseemail = base64_encode($p);
    $code = base64_encode($baseemail); 
    $phash = md5($mdemail.$code); 
    $uhash = md5($u);
  $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
 $query = "select * from users where `username` = :u";
 $ins= $conn->prepare($query);
 $ins->bindValue( ":u", $u, PDO::PARAM_STR );
 $ins->execute();
 $dta = $ins->fetch();
 
 $rid =$dta['uid'];
if($dta['sess']!= 0 )

{
   echo "<script>
alert('Another session is going on !!! Logging in will destroy all remaining sessions.');
window.location.href='lout.php?id="."$rid"."';
</script>";
   
 } else {
    if ( $uhash == $dta['uhash'] && $phash == $dta['password'] ) {

      if($dta['status']==1)
      {

      // Login successful: Create a session and redirect to the admin homepage
      $date = date("Y-m-d H:i:s");
      $day = date("Y-m-d");
      $_SESSION['rat_username'] = md5(md5($u).$day);
      $_SESSION['rat_id']= $dta['uid'];
      //$_SESSION['rat_date'] = $date ; 
      $ip= $_SERVER['REMOTE_ADDR'];
      $q2 = "UPDATE `users` SET `sess` = \"".$_SESSION['rat_username']."\", `date` = \"".$date."\", `lastloginip` = \"".$ip."\" WHERE `users`.`uid` = \"".$dta['uid']."\" ";
      $inssess= $conn->prepare($q2);
      $inssess->execute();
      header( "Location: admin.php" );
}

else {

    echo "<script>
alert('Your account is disabled. !!!');
window.location.href='login.php';
</script>";
}
    } else {

      // Login failed: display an error message to the user
      echo "<script>
alert('Wrong Login Credentials !!!');
window.location.href='login.php';
</script>";


    }


  }

  } else {

    // User has not posted the login form yet: display the form
    require( "login.php" );
  }

}


function logout() {
  unset( $_SESSION['rat_username'] );
  $uid = $_SESSION['rat_id'];
  unset ($_SESSION['rat_id']);
  //unset ($_SESSION['date']);  
  $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD);
 $q4 = "UPDATE `users` set `sess` = \"0\" where `uid` = :id ";
 $lout= $conn->prepare($q4);
 $lout->bindValue( ":id", $uid, PDO::PARAM_INT );
 $lout->execute();
  header( "Location: admin.php" );
}
function dashboard() { $selected = "dashboard"; require( "dashboard.php" ); }
function adduser() { $selected = "listusers"; require( "add_user.php" ); }
function addreq() { $selected = "postreq"; require( "add_req.php" ); }
function listusers() {  $selected = "listusers"; require( "list_users.php" );  }
function reqlist() {  $selected = "reqlist"; require( "reqlist.php" );  }
function postreq() {  $selected = "postreq"; require( "postreq.php" );  }
function addconsultant() {  $selected = "listconsultants";  require( "add_consultant.php" );  }
function listconsultants() {  $selected = "listconsultants"; require( "list_consultants.php" );  }
function addskill() {  $selected = "listconsultants";  require( "add_skill.php" ); }
function assignreq() {  $selected = "assign"; require( "assign.php" );  }
function assignconsultant() {  $selected = "assign"; require( "assignconsultant.php" ); }
function assigned() {  $selected = "assigned"; require( "assigned.php" ); }
function listall() {  $selected = "listall"; require( "listall.php" ); }
function addlist() {  $selected = "listall"; require( "add_list.php" ); }
function clientslist() {  $selected = "clientslist"; require( "viewcombined.php" ); }
function updatedhotlist() {  $selected = "updatedhotlist"; require( "updatedhotlist.php" ); }
function clientlistdownload()
{
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
if($dta['level'] == 1 || $dta['level'] == 2 )
{
  $dsql="SELECT Distinct `companyname`, `rname`, `rfname`, `remail`, `rphone`, `rlocation`, `rtimezon`, `tier` FROM `clients` group by `remail`";
}
else
{
  $dsql="SELECT Distinct `companyname`, `rname`, `rfname`, `remail`, `rphone`, `rlocation`, `rtimezon`, `tier` FROM `clients` where `uid` = $uid AND `status` = 1 group by `remail`";
}
  $connd = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
  $dins= $connd->prepare($dsql);
  $dins->execute();

  $date = date("Y-m-d H:i:s");
  $filename = "tmp/"."Client_list_".$sessid."-".date("m-d-Y", strtotime($date) ).".csv";
  $fp = fopen("$filename", 'w');
  $txt = "Company Name,Full Name,First Name,Email ID,Phone Number,Location,Timezone,Tier 1/2/IP\n";
  fwrite($fp, $txt);
  while ($row = $dins->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($fp, $row);
}// whilw
fclose($fp);
      header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            ob_clean();
            flush();
readfile($filename);
header( "Location: admin.php?action=clientslist" ); 

}

?>
