<!DOCTYPE html>
<html class="fa-events-icons-ready"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Recruitment ATS - Metahorizon</title>
  
  <link rel="stylesheet" media="screen" href="application.css">

  <style>
    .breadcrumb{
      margin-left: 30px;
      margin-right: 30px;
    }
    .alert{
      margin-left: 28px;
    }
    .container{
      margin-left:10px;
      margin-left:20px;
      width: auto !important;
    }
  </style>
  
</head>
<body>

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container" style="padding-left: 20px;">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="index.php">Bench ATS</a>

    </div>
  </div>
</div>


<div class="container">
 
  <div class="row">
  <ul class="breadcrumb">
        <li>
      <a href="index.php">Home</a> <span class="divider">&gt;</span>
    </li>
    <li class="active">Jobs</li>
  </ul>
  <div class="span12"><style>
.search_jobs{
float:left;
padding-left:10px;
}
</style>
<?php

if(isset($_GET['id']))
{

require("../config.php");
$reqid=$_GET['id'];

$conn=null;
$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$query = "select * from req where `id` = :reqid";
$ins= $conn->prepare($query);
$ins->bindValue( ":reqid", $reqid, PDO::PARAM_INT );
$ins->execute();
$data = $ins->fetch();


echo "<h2>".$data['title']." - ".$data['location']." - ".$data['duration']."</h2><br>";
echo base64_decode($data['description']);
}
else
{
echo "<script>
alert('Please select the requirement to view from the list !!!');
window.location.href='index.php';
</script>"; 	
}
?>
<!-- span16 --> 
    <div class="span12">
<h2></h2>
<br>
</div>
  </div>
</div>

 
</body></html>