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
$titre_page = "inscription";
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
	  			<input name="creer" value="1" type="hidden" />
				<label for="soutenance">nom de soutenance</label>
				<input type="text" class="form-control" id="soutenance" name="soutenance" placeholder="nom de soutenance" required>
			</div>
			<div class="form-group">
				<label for="numsalle">num de salle</label>
				<input type="text" class="form-control" id="numsalle" name="numsalle" placeholder="num de salle" required>
			</div>
			<div class="form-group">
				<label for="date">date</label>
				<input type="datetime-local" class="form-control" id="date" name="date" required>
				<small class="form-text text-muted">Please entrer day/month/year/hour/minute</small>
			</div>
			<div class="form-group">
				<label for="status">status</label>	
			    <select class="form-control"  id="status" name="status">
			      <option>disponible</option>
			      <option>occupe</option>
			      <option>complete</option>
			    </select>
			</div>
			<div class="form-group">
				<label for="groupe">groupe</label>
				<input type="number" min="1" max="8" class="form-control" id="groupe" name="groupe" placeholder="num de groupe" required>
				<small class="form-text text-muted">we have 8 groups</small>
			</div>
			
			
			<div class="form-group">
				<button type="submit" class="btn btn-outline-primary">creer</button>
				<a class="btn btn-outline-primary" href="enseignant_0.php">retour</a>
			</div>
		</form>
	</div>
</div>

<?php
if(isset($_POST['creer']))
{
    $nomSoutenance =$_POST['soutenance'];
    $numSalle = $_POST['numsalle'];
    $dateTime = $_POST['date'];
    $status = $_POST['status'];
    $groupe = $_POST['groupe'];


    echo $nomSoutenance.'\n';
    echo $numSalle.'\n';
    echo $dateTime.'\n';
    echo $status.'\n';
    echo $groupe.'\n';

    //connect to mysql
    require_once('./PHPfiles inc/param.inc.php');
    $mysqli = new mysqli($host,$login,$password,$dbname);
    //inserer les donnes dans le tableau soutenance
    $query = "INSERT INTO soutenance (nom_soute, date_soute, status_soute, numsalle_soute) VALUES ('".$nomSoutenance."', '".$dateTime."', '".$status."', '".$numSalle."')";
    $result = mysqli_query($mysqli,$query);
    if(!$result)
    {
        echo "La requête a échoué:".$mysqli->error;
        exit;
    }else{
    	echo "Bien creer un soutenance";
    }
    //retirer id de soutenance
    $query= "SELECT id_soutenance FROM soutenance where nom_soute = '".$nomSoutenance."' and date_soute = '".$dateTime."' and numsalle_soute = '".$numSalle."'";
    $result = mysqli_query($mysqli,$query);
    if(!$result)
    {
        echo "La requête a échoué:".$mysqli->error;
        exit;
    }else{
    	$tuple = $result->fetch_assoc();
    	$id_soutenance = $tuple['id_soutenance'];
    	echo $id_soutenance;
    }

    //inserer les donnes dans le tableau groupe
    $query = "INSERT INTO groupe (id_groupe, id_soutenance) VALUES ('".$groupe."', '".$id_soutenance."')";
    $result = mysqli_query($mysqli,$query);
    if(!$result)
    {
        echo "La requête a échoué:".$mysqli->error;
        exit;
    }else{
    	echo 'Bien creer une groupe';
    }

    mysqli_close($mysqli);


}
?>



<?php include'./PHPfiles inc/scripts.inc.php';?>
  
</body>
</html>