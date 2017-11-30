<?php  
require_once('./PHPfiles inc/param.inc.php');
$bdd = mysqli_connect($host, $login, $password, $dbname);
session_start();

$id_compte = $_SESSION['id'];
$id_soutenance = $_GET['id'];
$query="SELECT * FROM eleve WHERE id_compte='".$id_compte."'";
$sql=$bdd->query($query);
$result= $sql->fetch_assoc();
$query = "INSERT INTO positionnement SET id_soutenance='".$id_soutenance."',id_eleve='".$result['id_eleve']."'";
echo $query;
$bdd->query($query);
header('location:home_eleve.php?reussi');


?>