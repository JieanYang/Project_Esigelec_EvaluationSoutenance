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
				<label for="soutenance">nom de soutenance</label>
				<input type="text" class="form-control" id="soutenance" name="soutenance" placeholder="nom de soutenance" required>
			</div>
			<div class="form-group">
				<label for="groupe">groupe</label>
				<input type="number" min="1" max="8" class="form-control" id="groupe" name="groupe" placeholder="num de groupe" required>
				<small class="form-text text-muted">we have 8 groups</small>
			</div>
			<div class="form-group">
				<button type="submit" value="Ajouter" class="btn btn-outline-success">Ajouter</button>
				<button type="submit" value="Supprimer" class="btn btn-outline-danger">Supprimer</button>
				<a class="btn btn-outline-primary" href="enseignant_0.php">retour</a>
			</div>
		</form>
	</div>
</div>


<?php include'./PHPfiles inc/scripts.inc.php';?>
  
</body>
</html>