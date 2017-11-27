<?php
session_start();
$logout=@$_GET['logout'];
if($logout ==1)
    $_SESSION['loggedin']=0;

if($_SESSION['loggedin']!=1)
{
    header("Location:page_login.php");
    exit;
}
if($_SESSION['identity']!='enseignant')
{
    header("Location:page_login.php");
    exit;
}
?>

<?php
$titre_page = "management eleve";
include './PHPfiles inc/header.inc.php';
?>


<body class="container">
<div class="row">
	<div class="col-sm-12 col-xs-12" style="padding: 50px;"></div>
	<div class="col-sm-3 col-xs-12"></div>
	<div class="col-sm-6 col-xs-12">
		<form method="POST">
			<div class="form-group">
				<!-- check -->
				<div id="info" style="display:none"></div>
	  			<input name="change" value="1" type="hidden" />
				<label for="groupe">groupe</label>
				<input type="number" min="1" max="8" class="form-control" id="groupe" name="groupe" placeholder="num de groupe" required>
				<small class="form-text text-muted">we have 8 groups</small>
			</div>
			<div class="form-group">
				<label for="eleve">id_eleve</label>
				<input type="number" class="form-control" id="eleve" name="eleve" placeholder="id of eleve" required>
			</div>
			<div class="form-group">
				<button type="submit" name="gerer" value="Ajouter" class="btn btn-outline-success">Ajouter</button>
				<button type="submit" name="gerer" value="Supprimer" class="btn btn-outline-danger">Supprimer</button>
				<a class="btn btn-outline-primary" href="enseignant_0.php">retour</a>
			</div>
		</form>
	</div>
</div>

<?php
if(isset($_POST['change']))
{
	$groupe = $_POST['groupe'];
	$eleve = $_POST['eleve'];

	echo $groupe.'\n';
    echo $eleve.'\n';

	//connect to mysql
    require_once('./PHPfiles inc/param.inc.php');
    $mysqli = new mysqli($host,$login,$password,$dbname);


    //Deux situations
	if($_POST['gerer']=='Ajouter'){
		echo "ajouter";

		//verifier l'existance de l'eleve
		$query = "SELECT count(*),id_groupe FROM eleve where id_eleve = '".$eleve."'";
		$result = mysqli_query($mysqli,$query);
	    if(!$result){
	        echo "La requête a échoué:".$mysqli->error;
	        exit;
	    }

	    $row = mysqli_fetch_row($result);
	    $count = $row[0];
	    if($count == 0){
	    	echo "Doesn't exist this id of eleve: ".$eleve;
	    	exit;
	    }else{
	    	echo " l'eleve ".$eleve." est dans le groupe: ".$row[1]."\n";
	    	echo "on va l'ajouter dans le groupe: ".$groupe;
	    }

		//update(ajouter) un eleve dans un groupe
	    $query = "UPDATE eleve SET id_groupe = '".$groupe."' where id_eleve = '".$eleve."'";
	    $result = mysqli_query($mysqli,$query);
	    if(!$result)
	    {
	        echo "La requête a échoué:".$mysqli->error;
	        exit;
	    }else{
	    	echo "Ajouter l'eleve ".$eleve." dans le groupe: ".$groupe;
	    }

	}elseif ($_POST['gerer']=='Supprimer') {
		echo "supprimer";

		//virifier l'existance de l'eleve dans le groupe $groupe
		$query = "SELECT id_groupe FROM eleve where id_eleve = '".$eleve."'";
		$result = mysqli_query($mysqli,$query);
	    if(!$result){
	        echo "La requête a échoué:".$mysqli->error;
	        exit;
	    }

	    $row = mysqli_fetch_row($result);
	    $count = $row[0];
	    if($count != $groupe){
	    	echo "le groupe ".$groupe." n'a pas l'eleve : ".$eleve;
	    	echo " l'eleve ".$eleve." est dans le groupe: ".$row[0];
	    	exit;
	    }

	    //update(supprimer) un eleve dans un groupe
	    $query = "UPDATE eleve SET id_groupe = null where id_eleve = '".$eleve."'";
	    $result = mysqli_query($mysqli,$query);
	    if(!$result)
	    {
	        echo "La requête a échoué:".$mysqli->error;
	        exit;
	    }else{
	    	echo "Supprimer l'eleve ".$eleve." dans le groupe: ".$groupe;
	    }
	}


    mysqli_close($mysqli);
}
?>


<?php include'./PHPfiles inc/scripts.inc.php';?>
  
</body>
</html>