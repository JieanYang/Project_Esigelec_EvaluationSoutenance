<!-- pas fini -->

<!DOCTYPE html>
<html>

<head>
	<title>Clients à spammer</title>
	<meta charset="utf-8">
</head>

<body>
	<h1>Liste des clients à spammer</h1>
	
	<?php
	//require_once('param.inc.php');
	$mysqli = new mysqli('127.0.0.1','root','','project_esi');

	if ($mysqli->connect_errno) {
		echo "Echec lors de la connexion à MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}else{
		$res=$mysqli->query("SELECT * FROM clients");
		if(!$res){
			echo ('Echec de la requête SQL :'.$mysqli->error);
			// die('Echec de la requête SQL :'.$mysqli->error);
		}elseif($res->num_rows == 0){
			echo '<p>Aucun resultat :</p>';
		}else{
			while($tuple=$res->fetch_assoc()){
			echo '<p>'.htmlentities($tuple['nom']).'</p>';
			}
		}
	}
	?>

</body>

</html>