<!DOCTYPE html>
<html class="fa-events-icons-ready"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Recruitment ATS - Metahorizon</title>
  
  <link rel="stylesheet" media="screen" href="application.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap.min.js"></script>
<link href="../css/bootstrap.min.css" rel="stylesheet">

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
      <a class="brand" href="index.php">Recruitment ATS</a>

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

<!-- span16 --> 
    <div class="span12"><style>
.search_jobs{
float:left;
padding-left:10px;
}
</style>
<h1>Jobs</h1>

<input type="hidden" name="direction" id="direction">
<input type="hidden" name="sort" id="sort">

<div id="list" style="clear:both;">
<div style="width:100%;">
  <div style="clear:both;float:left;"></div>
</div>
<div style="clear:both;"></div>
<?php

require("../config.php");

$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$query = "select * from req where status =1 order by date desc";
$ins= $conn->prepare($query);
$ins->execute();
$data = $ins->fetchAll();
?>
<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="uid" data-sort-order="asc">
						    <thead>
						    <tr>
						        <th data-field="id" data-sortable="true">ID</th>
						        <th data-field="Datetime"  data-sortable="true">Datetime</th> 
						        <th data-field="Role"  data-sortable="true">Job Role</th>
						        <th data-field="SM" data-sortable="true">SM</th>
						        <th data-field="action" data-sortable="true">Action</th>
						    </tr>
						    </thead>
						   <tbody>
<?php

$i=1;

foreach( $data as $row) { 	

						
$uid = $row['sm'];
								$q3 = "select * from users where `uid` = $uid";
								$ins4= $conn->prepare($q3);
								$ins4->execute(); 
								$dta3 = $ins4->fetch();
						
	?>
    <tr>
  		<td data-order="<?php echo $i; ?>"> <?php echo $i; $i=$i+1;  ?></td>
		<td data-search="<?php echo $row['date']; ?>"> <?php $time = strtotime($row['date']); $myFormatForView = date("m/d/y g:i A", $time); echo $myFormatForView; ?></td>
    	<td data-search="<?php echo $row['title']." ".$row['location']; ?>"> <a href="view.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']." - ".$row['location']." - ".$row['duration']; ?></a></td>  	
    	<td data-search="<?php echo $dta3['name']; ?>"> <?php echo $dta3['name']; ?></td> 	
    	<td> <a class="btn btn-small btn_very_small btn-primary" href="#">Submit</a></td>       	

    </tr>
    <?php  //for if
} //foreach
$conn=null; 
?>
						   </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>


</div>

<br>
</div>
  </div>
</div>

<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/chart.min.js"></script>
	<script src="../js/bootstrap-table.js"></script>
 
</body></html>