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
	require_once('./PHPfiles inc/param.inc.php');


	$mysqli = new mysqli($host,$login,$password,$dbname);

	if ($mysqli->connect_errno) {
		echo "Echec lors de la connexion à MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}else{
		$res=$mysqli->query("SELECT * FROM compte");
		if(!$res){
			echo ('Echec de la requête SQL :'.$mysqli->error);
			// die('Echec de la requête SQL :'.$mysqli->error);
		}elseif($res->num_rows == 0){
			echo '<p>Aucun resultat :</p>';
		}else{
			while($tuple=$res->fetch_assoc()){
			echo '<p>'.htmlentities($tuple['id_compte']).'</p>';
			echo '<p>'.htmlentities($tuple['mail']).'</p>';
			echo '<p>'.htmlentities($tuple['passwd']).'</p>';
			// echo '<p>'.$tuple['id_compte'].'</p>';
			// echo '<p>'.$tuple['adresse_mail'].'</p>';
			// echo '<p>'.$tuple['mdp_perso'].'</p>';
			}
		}
	}
	?>




<!-- 插入数据 -->
	<?php


	require_once('../PHPfiles inc/param.inc.php');


	$conn = new mysqli($host,$login,$password,$dbname);
	if ($conn->connect_error) {
	    die("连接失败: " . $conn->connect_error);
	}

	// $sql = "INSERT INTO soutenance (nom_soute, date_soute, status_soute, numsalle_soute) VALUES ('math', '2017-10-26T15:00', 'disponible', 'b233')";

	// if ($conn->query($sql) === TRUE) {
	//     echo "新记录插入成功";
	// } else {
	//     echo "Error: " . $sql . "<br>" . $conn->error;
	// }

	// $conn->close();
	?>

</body>

</html>