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
        <table style="width:100%">
          <tr>
            <th>soutenance</th>
            <th>eleve</th> 
            <th>date</th>
          </tr>

          <?php 
				    $mysqli = new mysqli('localhost','gr08148dr9','Wv4u4rvC','bddgr0814');

				    //retirer les donnees de soutenance
				    $query = "SELECT soutenance.nom_soute,soutenance.date_soute,groupe.id_groupe, eleve.nom_eleve
				    FROM soutenance 
				    LEFT JOIN groupe
				    ON soutenance.id_soutenance = groupe.id_soutenance
                	LEFT JOIN eleve
                    ON eleve.id_groupe = groupe.id_groupe";

				    $result = mysqli_query($mysqli,$query);
            
				    if(!$result){
				    	echo "La requête a échouée:".$mysqli->error;
        				exit;
				    }elseif($result -> num_rows ==0){
				    	echo '<p>Aucun resultat :</p>';
				    }else{
				    	//$i=0;
				    	while($tuple=$result->fetch_assoc()){
				    		$i++;
                            echo " <tr>
                                        <td>".$tuple['nom_soute']."</td>
                                        <td>".$tuple['nom_eleve']."</td> 
                                        
                                        <td>".$tuple['date_soute']."</td>
                                   </tr>";
                           
				    		/*
                            <td>".$tuple['id_groupe']."</td>    
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
				    		}*/
				    	}
				    }

				    mysqli_close($mysqli);
			    				    	
			     ?>
        </table>  
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