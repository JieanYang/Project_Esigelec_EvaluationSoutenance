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

if($_SESSION['identity']!='eleve')
{
    header("Location:page_login.php");
    exit;
}

// echo $_SESSION['id'];

?>
<?php
$titre_page = "étudiant";
include './PHPfiles inc/header.inc.php';
?>

<?php  //afficher les informations de soutenance

				    //connect to mysql
				    require_once('./PHPfiles inc/param.inc.php');
				    $mysqli = new mysqli($host,$login,$password,$dbname);
?>
				    //retirer les donnees de soutenance

//liste déroulante tirée d'une base de données

<form class="list-group-item active" method="post" action="eleve1.php">
<h4>Pour quelle date voulez vous consulter une soutenance?</h4>
 
<p><select date="date_soute" id="date_soute" onchange="javascript:submit(this)"required >
    
 
<?php
$reponse = $bdd->query('SELECT * FROM soutenance WHERE date_soute ');
 
 
while ($choix = $reponse->fetch())
{
?>
 
<?php echo '<option value="'.$choix['date_soute'].'"></option><br />';
?>

</select>
</form>


<?php
//Récupération des données du formulaire
$_POST['date_soute'];
 
//Enregistrement des données dans des variables
$choix=$_POST['date_soute'];
?>
 
<?php

$req = $bdd->prepare('SELECT nom_soute, numsalle_soute, status_soute, id_groupe  FROM soutenance WHERE date_soute = ?');
$req->execute(array(
$_POST['date_soute']));

while ($donnees = $reponse->fetch())

?>	
    <div id="reponse">
	<h4>Fiche Soutenance</h4>
	<p><strong>Nom soutenance</strong> : <?php echo $donnees ['nom_soute']; ?></p>
	<p><strong>Salle</strong> : <?php echo $donnees['numsalle_soute']; ?></p>
    <p><strong>Statut</strong> : <?php echo $donnees['status_soute']; ?></p>
	<p><strong>Groupe</strong> : <?php echo $donnees['id_groupe']; ?></p>
	

<?php include('include/connect_fin.php');?>


<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Bootstrap CSS -->
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        
        <link rel="stylesheet" href="style.css">
        <body>
            <form action="" method="POST">
            
                <div class="container" >
                     <h1>Id éléve</h1>
                     <p> <input type="text" value=""><br/></p>
                </div>
                    
                <p>
                    <div class="container">
                      
            				<a class="btn btn-outline-primary" href="Page%20de%20validation.html">Positionner</a>
                            <a class="btn btn-outline-primary" href="index.php">RETOUR</a>

                    </div>
                </p>
            </form>
            
            <div class="container-fluid"></div>
         
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>-->
        </body>
    </head>
</html>


				