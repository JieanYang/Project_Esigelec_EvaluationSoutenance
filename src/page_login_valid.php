
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
		<small style="font-size: 0.3em;">3 seconds</small><br>
		<!-- get method for pass the parameter log out-->
		<a href="?logout=1" class="btn btn-outline-danger">Log out</a>
	</div>
	<?php
		if ($_SESSION['identity'] == 'enseignant'){
			
			echo "<script>
				    document.onreadystatechange = function(){
				        if(document.readyState == 'complete'){
				        	setTimeout(function () {
				        		self.location='enseignant_0.php';
				        	}, 3000);
				            
				        }
				    }
				 </script>";
	
			exit;
		}
		if ($_SESSION['identity'] == 'eleve'){
			echo "<script>
				    document.onreadystatechange = function(){
				        if(document.readyState == 'complete'){
				        	setTimeout(function () {
				        		alert('skip to the page eleve!');
				        	}, 3000);
				            
				        }
				    }
				 </script>";
			
			exit;
		}
	?>


	<?php include'./PHPfiles inc/scripts.inc.php';?>
</body>

<html>