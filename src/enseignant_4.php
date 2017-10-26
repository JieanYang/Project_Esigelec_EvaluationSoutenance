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
?>

<?php
$titre_page = "management groupe";
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
				<label for="soutenance">nom de soutenance</label>
				<input type="text" class="form-control" id="soutenance" name="soutenance" placeholder="nom de soutenance" required>
			</div>
			<div class="form-group">
				<label for="groupe">groupe</label>
				<input type="number" min="1" max="8" class="form-control" id="groupe" name="groupe" placeholder="num de groupe" required>
				<small class="form-text text-muted">we have 8 groups</small>
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
	$nomSoutenance =$_POST['soutenance'];
	$groupe = $_POST['groupe'];

	echo $nomSoutenance.'\n';
    echo $groupe.'\n';

	//connect to mysql
    require_once('./PHPfiles inc/param.inc.php');
    $mysqli = new mysqli($host,$login,$password,$dbname);


    //verifier existance de nomSoutenance et reitrer id de soutenance
    $query = "SELECT count(*),id_soutenance FROM soutenance where nom_soute = '".$nomSoutenance."'";
    $result = mysqli_query($mysqli,$query);
    if(!$result)
    {
        echo "La requête a échoué:".$mysqli->error;
        exit;
    }
    $row = mysqli_fetch_row($result);
    
    $count = $row[0];
    if($count == 0){
    	echo "Doesn't have this soutenance:".$nomSoutenance;
    	exit;
    }else{
    	$tuple = $result->fetch_assoc();
    	$id_soutenance = $row[1];
    	echo 'id of '.$nomSoutenance.' est '.$id_soutenance;
    }

    //Deux situations
	if($_POST['gerer']=='Ajouter'){
		echo "ajouter";

		//verifier le groupe dans le soutenance
		$query = "SELECT count(*) FROM groupe where id_groupe = '".$groupe."' and id_soutenance = '".$id_soutenance."'";
		$result = mysqli_query($mysqli,$query);
	    if(!$result){
	        echo "La requête a échoué:".$mysqli->error;
	        exit;
	    }

	    $row = mysqli_fetch_row($result);
	    $count = $row[0];
	    if($count != 0){
	    	echo "le groupe ".$groupe." est deja dans le soutenance ".$nomSoutenance;
	    	exit;
	    }

		 //inserer les donnes dans le tableau groupe
	    $query = "INSERT INTO groupe (id_groupe, id_soutenance) VALUES ('".$groupe."', '".$id_soutenance."')";
	    $result = mysqli_query($mysqli,$query);
	    if(!$result)
	    {
	        echo "La requête a échoué:".$mysqli->error;
	        exit;
	    }else{
	    	echo "Ajouter le  groupe ".$groupe." dans le soutenance: ".$nomSoutenance;
	    }

	}elseif ($_POST['gerer']=='Supprimer') {
		echo "supprimer";

	    //delete les donnes dans groupe
	    $query = "DELETE FROM groupe WHERE id_soutenance = '".$id_soutenance."'";
	    $result = mysqli_query($mysqli,$query);
	    if(!$result)
	    {
	        echo "La requête a échoué:".$mysqli->error;
	        exit;
	    }else{
	    	echo "Supprimer le  groupe ".$groupe." dans le soutenance: ".$nomSoutenance;
	    }
	}


    mysqli_close($mysqli);
}
?>

<?php include'./PHPfiles inc/scripts.inc.php';?>
  
</body>
</html>