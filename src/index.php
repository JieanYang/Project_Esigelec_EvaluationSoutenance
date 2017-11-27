
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
			    <a class="btn btn-outline-success" href="Page d'inscription.html">register</a>
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
			    <div style="padding: 10px;"></div>
			    <?php  //afficher les informations de soutenance

				    //connect to mysql
				    require_once('./PHPfiles inc/param.inc.php');
				    $mysqli = new mysqli($host,$login,$password,$dbname);

				    //retirer les donnees de soutenance
				    $query = "SELECT soutenance.nom_soute,soutenance.date_soute,soutenance.numsalle_soute,soutenance.status_soute,groupe.id_groupe 
				    FROM soutenance 
				    LEFT JOIN groupe
				    ON soutenance.id_soutenance = groupe.id_soutenance
				    ORDER BY soutenance.date_soute";

				    $result = mysqli_query($mysqli,$query);
				    if(!$result){
				    	echo "La requête a échoué:".$mysqli->error;
        				exit;
				    }elseif($result -> num_rows ==0){
				    	echo '<p>Aucun resultat :</p>';
				    }else{
				    	$i=0;
				    	while($tuple=$result->fetch_assoc()){
				    		$i++;
				    		echo "
					    	<li class='list-group-item'>
								<div>
									<p>".$tuple['nom_soute']."</p>
									<p>".$tuple['date_soute']."</p>
									<p>salle ".$tuple['numsalle_soute']."</p>
									<p>status ".$tuple['status_soute']."</p>
									<p>groupe ".$tuple['id_groupe']."</p>
								</div>
					    	</li>";
				    		if($i==4){
				    			break;
				    		}
				    	}
				    }

				    mysqli_close($mysqli);
			    				    	
			     ?>
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