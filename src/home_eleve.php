<?php
session_start();
// need to ues isset() for checking variable, otherwise PHP will report errors
if(!(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==1))
{
    header("Location:page_login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ESIG'Soutenais! | </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <link href="build/css/style.css" rel="stylesheet">
    <link href="vendors/Ionicons/css/ionicons.min.css" rel="stylesheet">
    <script src="sweetalert/dist/sweetalert2.all.min.js"></script>

    <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
    <script src="sweetalert/core.js"></script>
    <script src="sweetalert/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert/dist/sweetalert2.min.css">

  </head>

  <body class="nav-md">
    <?php 
      if(isset($_GET['reussi'])){
        ?>
          <script type="text/javascript">
            swal({
              position: 'center',
              type: 'success',
              title: 'Créneau choisi',
              showConfirmButton: false,
              timer: 1500
            });
          </script>
          
        <?php

      }
     ?>
    <div class="container body">
      <div class="main_container">


        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="navbar nav_title" style="border: 0;">
                <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>ESIG'Soutenais!</span></a>
              </div>
              <div style="position : absolute; right: 10px; color: red;"> 
                   <a href="page_login_valid?logout=1" class="btn btn-outline-danger">Log out</a>
              </div>
             
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
         
          <br />

          <div class="row">


            <div class="col-md-12 col-sm-12 col-xs-12">
              <ol class="breadcrumb">
                  <li>
                      <a href="#"><i class="fa fa-dashboard"></i> SOUTENANCES</a>
                  </li>
                  <li class="active">
                      <i class="fa fa-dashboard"></i> Les soutenances disponibles
                  </li>
              </ol>

              
              

              

              <div class="x_panel">
                <div class="x_title">
                  <h2>SOUTENANCES</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
        
                  <table id="datatable-responsive4" class="table projet table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="name">NOM</th>
                        <th class="salle">SALLE</th>
                        <th class="date">Date</th>
                        <th class="statut">Statut</th>
                        <th class="action"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                          
                          require_once('./PHPfiles inc/param.inc.php');
                          $bdd = mysqli_connect($host, $login, $password, $dbname);
                          $id_compte = $_SESSION['id'];
                          $query = "SELECT * FROM soutenance WHERE id_soutenance IN(SELECT id_soutenance FROM groupe WHERE id_groupe IN(SELECT id_groupe FROM eleve WHERE id_compte='".$id_compte."') )";
                          $sql = $bdd->query($query);
                          while($result = $sql->fetch_assoc()){
                            echo "<tr>";
                            echo "<td class='title_cours'>".$result["nom_soute"]."</td>";
                            echo "<td><div>".$result["numsalle_soute"]."</div></td>";
                            echo "<td><div>".$result["date_soute"]."</div></td>";
                            echo "<td><div>".$result["status_soute"]."</div></td>";
                            $link = "positionner.php?id=".$result["id_soutenance"];
                            echo "<td class='bouton_action'> <a href='".$link."' class='btn btn-round btn-info'>Se Positionner</a> </td>";
                            echo "</tr>";
                          }
                      ?>
                  
                     
                    </tbody>
                  </table>
        
        
                </div>
              </div>

            
            </div>



            

          </div>



        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/datatables.net/js/jquery.dataTables.js"></script>
    <script>
   
    jQuery( document ).ready(function() {
        $('#datatable-responsive4').DataTable();
        
    });
    // Code that uses other library's $ can follow here.
    </script>
   
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.time.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- DataTable -->

    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
	
  </body>
</html>
