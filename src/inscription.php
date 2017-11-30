<?php 
	$nom = $_POST["nom"];
	$prenom = $_POST["prenom"];
	$passwd = $_POST["password"];
	$mail = $_POST["mail"];
	$identite = $_POST["identite"];
    $groupe = $_POST["groupe"];
	require_once('./PHPfiles inc/param.inc.php');
	$bdd = mysqli_connect($host, $login, $password, $dbname);

	$query="SELECT * FROM compte WHERE mail='".$mail."'";
	$sql=$bdd->query($query);
	$result= $sql->fetch_assoc();
	if($result != false){
		header('location:Page d\'inscription.html?compte_existe');
	} else {
		$req="INSERT INTO compte(mail, passwd, identity) VALUES ('".$mail."','".sha1($passwd)."','".$identite."' )";
		echo $req;
		$bdd->query($req);
		$query="SELECT * FROM compte WHERE mail='".$mail."' AND passwd = '".sha1($passwd)."'";
		$sql=$bdd->query($query);
        $result= $sql->fetch_assoc();
        $id=$result['id_compte'];
        if($identite == "enseignant") {
        	$req="INSERT INTO enseignant (nom_ensei, prenom_ensei, id_compte) VALUES ('".$nom."','".$prenom."','".$id."' )";
        } else {
        	$req="INSERT INTO eleve (nom_eleve, prenom_eleve, id_compte, id_groupe ) VALUES ('".$nom."','".$prenom."','".$id."','".$groupe."')";
        }
	    $bdd->query($req);
	    header('location:Page de validation.html');
	}
		

?>