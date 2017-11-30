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

// echo $_SESSION['id'];

?>



<?php
$titre_page = "enseignant";
include './PHPfiles inc/header.inc.php';
?>


<body class="container">
<div class="row">
<div class="btn_group">
    <a class="col-xm-12 col-sm-12 btn btn-outline-primary btn-lg" href="enseignant_6.php">lister soutenance et l'éleve</a>
	<br><br><br><br>
	<a class="col-xm-12 col-sm-12 btn btn-outline-primary btn-lg" href="enseignant_1.php">créer soutenance</a>
	<br><br><br><br>
	<a class="col-xm-12 col-sm-12 btn btn-outline-primary btn-lg" href="enseignant_2.php">modifier soutenance status</a>
	<br><br><br><br>
	<a class="col-xm-12 col-sm-12 btn btn-outline-primary btn-lg" href="enseignant_3.php">supprimer soutenance</a>
	<br><br><br><br>
	<a class="col-xm-12 col-sm-12 btn btn-outline-primary btn-lg" href="enseignant_4.php">gérer groupe</a>
	<br><br><br><br>
	<a class="col-xm-12 col-sm-12 btn btn-outline-primary btn-lg" href="enseignant_5.php">import élève</a>
	<br><br><br><br>
	<a href="?logout=1" class="btn btn-outline-danger">Log out</a>
</div>

</div>





	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  
</body>
</html>