<?php
session_start();
// need to ues isset() for checking variable, otherwise PHP will report errors
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==1)
{
    header("Location:page_login_valid.php");
    exit;
}
?>

<?php
$titre_page = "login";
include './PHPfiles inc/header.inc.php';
?>
<body class="container">

<div class="row">
<div class="col-sm-3 col-xs-12"></div>
<div class="col-sm-6 col-xs-12">
	<form method="POST">
	  <div class="form-group">
	  	<!-- une parameter for judge the entry of mail and passwd -->
	  	<div id="info" style="display:none"></div>
	  	<input name="login" value="1" type="hidden" />
	    <label for="mail">Email address</label>
	    <input type="email" class="form-control" id="mail" name="mail" aria-describedby="emailHelp" placeholder="Enter email" required>
	    <small class="form-text text-muted">We'll never share your email with anyone else.</small>
	  </div>
	  <div class="form-group">
	    <label for="passwd">Password</label>
	    <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Password" required>
	  </div>
	  <!-- <div class="form-check">
	    <label class="form-check-label">
	      <input type="checkbox" class="form-check-input">
	      Check me out
	    </label>
	  </div> -->
      <div class="form-group">
          <button type="submit" class="btn btn-outline-primary">Submit</button>
          <a class="btn btn-outline-primary"  href="index.php">cancel</a>
      </div>  
	</form>
</div>
</div>


<?php
if(isset($_POST['login']))
{
    $user =$_POST['mail'];
    $passwd = $_POST['passwd'];
    //connect to mysql
    require_once('./PHPfiles inc/param.inc.php');
    $mysqli = new mysqli($host,$login,$password,$dbname);
    $query = "SELECT count(*),identity FROM compte where mail ='".$user."' and passwd = '".sha1($passwd)."'";
    // use sha1() for encryption password
    $result = mysqli_query($mysqli,$query);
    if(!$result)
    {
        echo "La requête a échoué！";
        exit;
    }
    $row = mysqli_fetch_row($result);
    $count = $row[0];
    $identity = $row[1];
    // the database doesn't have different users, so the result is 1 or 0
    if($count >0 )
    {
        $_SESSION['loggedin']=1;
        $_SESSION['identity']=$identity;
        header("Location:page_login_valid.php");
        exit;
    }
    else
    {
        //print information errors
        echo
        " <script > 
        document.getElementById(\"info\").style.display='block';
        document.getElementById(\"info\").innerHTML='Do you think the user name is wrong or the password is wrong? ';
        </script > ";
    }
}
?>


<?php include'./PHPfiles inc/scripts.inc.php';?>
  
</body>
</html>