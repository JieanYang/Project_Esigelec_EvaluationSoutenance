
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
$titre_page = "valid";
include './PHPfiles inc/header.inc.php';
?>

<body>
	
	<div id="login_valid">
		valid
		<!-- get method for pass the parameter log out-->
		<a href="?logout=1" class="btn btn-outline-danger">Log out</a>
	</div>


	<?php include'./PHPfiles inc/scripts.inc.php';?>
</body>

<html>