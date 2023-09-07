	<?php if(isset($_SESSION['username'])) { 	?>
	
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
	<br> <br>
		<?php 

 $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
 $query = "select * from users where `sess` = :sess";
 $ins= $conn->prepare($query);
 $ins->bindValue( ":sess", $_SESSION['username'], PDO::PARAM_STR );
 $ins->execute();
 $dta = $ins->fetch();

		?>
		<ul class="nav menu">
			<li class="<?php if($selected=="reqlist") { echo "active"; } else { echo "parent"; } ?>"><a href="admin.php?action=reqlist"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Requirement list</a></li>

<?php if($dta['level'] == 1 || $dta['level'] == 2)
{ ?>
			<li class="<?php if($selected=="postreq") { echo "active"; } else { echo "parent"; } ?>"><a href="admin.php?action=postreq"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Post Requirement</a></li>

			<li class="<?php if($selected=="assignreq") { echo "active"; } else { echo "parent"; } ?>"><a href="admin.php?action=assignreq"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Assign Requirement</a></li>
<?php } ?>
			<li class="<?php if($selected=="submissions") { echo "active"; } else { echo "parent"; } ?>"><a href="admin.php?action=submissions"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Submissions</a></li>

<li class="<?php if($selected=="reports") { echo "active"; } else { echo "parent"; } ?>">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></svg>Reports       </use></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="#">
							<svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg>Daily Reports
						</a>
					</li>
					
					<li>
						<a class="" href="#">
							<svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg>Weekly Reports
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg>Monthly Reports
						</a>
					</li>

				</ul>
			</li> 
<?php if($dta['level'] == 1)
{ ?>
			<li class="<?php if($selected=="listusers") { echo "active"; } else { echo "parent"; } ?>"><a href="admin.php?action=listusers"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>List Users</a></li> <?php } ?>

			<!-- <li class="<?php if($selected=="updatedhotlist") { echo "active"; } else { echo "parent"; } ?>"><a href="admin.php?action=updatedhotlist"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Updated Hotlist</a></li>
			<li class="<?php if($selected=="assigned") { echo "active"; } else { echo "parent"; } ?>"><a href="admin.php?action=assigned"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Assigned Consultants</a></li>
<?php if($dta['level'] == 1)
{ ?>
			<li class="<?php if($selected=="listusers") { echo "active"; } else { echo "parent"; } ?>"><a href="admin.php?action=listusers"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>List Users</a></li> <?php } ?>
<?php if($dta['level'] == 1 || $dta['level'] == 2)
{ ?>
			<li class="<?php if($selected=="assign") { echo "active"; } else { echo "parent"; } ?>"><a href="admin.php?action=assign"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>Assign Consultants</a></li> 

			<li class="<?php if($selected=="listconsultants") { echo "active"; } else { echo "parent"; } ?>">
				<a href="admin.php?action=listconsultants">
				-->	<!--<span data-toggle="collapse" href="admin.php?action=listconsultants"> --> <!-- <svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></svg>Consultant Lists</use></span>
				</a> -->
				<!-- <ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Marketing Details
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Original Details
						</a>
					</li>
					<li>
						<a class="" href="admin.php?action=listconsultants">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Add Consultants
						</a>
					</li>  
				</ul> --> <!--
			</li> <?php } ?> -->
<!--<li class="<?php if($selected=="hotlist") { echo "active"; } else { echo "parent"; } ?>"><a href="admin.php?action=compose"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg>Rate Confirmations</a></li>

<li class="<?php if($selected=="hotlist") { echo "active"; } else { echo "parent"; } ?>"><a href="admin.php?action=compose"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg>End Client Submissions</a></li>

			<li class="<?php if($selected=="hotlist") { echo "active"; } else { echo "parent"; } ?>"><a href="admin.php?action=sentmails"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg>Interview List</a></li>  

<li class="<?php if($selected=="hotlist") { echo "active"; } else { echo "parent"; } ?>">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></svg>Reports       </use></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="#">
							<svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg>Daily Reports
						</a>
					</li>
					
					<li>
						<a class="" href="#">
							<svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg>Weekly Reports
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg>Monthly Reports
						</a>
					</li>

				</ul>
			</li> -->
			<!--
<?php if($dta['level'] == 1 || $dta['level'] == 2 || $dta['level'] == 3)
{ ?> <li class="<?php if($selected=="listall") { echo "active"; } else { echo "parent"; } ?>"><a href="admin.php?action=listall"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>All Lists</a></li> <?php } ?>
			
			<li class="<?php if($selected=="clientslist") { echo "active"; } else { echo "parent"; } ?>"><a href="admin.php?action=clientslist"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Clients List</a></li> -->
	
		</ul>

	</div><!--/.sidebar-->
		
	<?php
}
else
{ echo "<script>
alert('Not Authorised to view this page. !!!');
window.location.href='../login.php';
</script>";  } ?>