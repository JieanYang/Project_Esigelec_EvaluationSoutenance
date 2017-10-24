
<?php
$titre_page = "Home";
include './PHPfiles inc/header.inc.php';
?>

<body>

<div class="container">
	<!-- navbar -->
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<nav class="navbar navbar-light bg-light justify-content-between">
			  <a class="navbar-brand">ESIG'Soutenais</a>
			  <form class="form-inline">
			    <a class="btn btn-outline-success" href="page_login.php" style="margin: 0 4px;">login</a>
			    <a class="btn btn-outline-success" href="#">register</a>
			  </form>
			</nav>
		</div>
		
	</div>

	<div class="row">
		<!-- calendrier -->
		<div class="col-sm-6 col-xs-12">
		  <img class="image" id="image_calendar" src="./images/calendar.png">
		</div>

		<!-- soutenance a venir -->
		<div class="col-sm-6 col-xs-12">
		  <ul class="list-group">
			    <li class="list-group-item active"><h4>soutenance à venir</h4>
			    </li>
			    <li class="list-group-item">
					<div>
						<p>nom de soutenance</p>
						<p>15h</p>
						<p>groupe</p>
						<p>status</p>
					</div>
			    </li>
			    <li class="list-group-item">
					<div>
						<p>nom de soutenance</p>
						<p>15h</p>
						<p>groupe</p>
						<p>status</p>
					</div>
			    </li>
			    <li class="list-group-item">
					<div>
						<p>nom de soutenance</p>
						<p>15h</p>
						<p>groupe</p>
						<p>status</p>
					</div>
			    </li>
			    <li class="list-group-item">
					<div>
						<p>nom de soutenance</p>
						<p>15h</p>
						<p>groupe</p>
						<p>status</p>
					</div>
			    </li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<img class="image" src="./images/logo esigelec.jpg" height="30">
	</div>	
</div>

<?php include'./PHPfiles inc/scripts.inc.php';?>
  
</body>
</html>