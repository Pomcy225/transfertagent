 <?php

session_start(); 
if (empty($_SESSION["nomprenom"] )) {
    $_SESSION["nomprenom"] ='';
    # code...
}
 $nmbtrans=' ';
 $nomcarte=' ';

 $nmbassure=' ';


   $connete = new PDO('mysql:host=localhost;dbname=caisse','root','');

  
$req3 = $connete->prepare("SELECT * FROM  transaction ORDER BY code DESC " );

$req3->execute();
$sol3 = $req3->fetchAll();

$req= $connete->prepare("SELECT count(id) FROM assure");
$req->execute();
$req= $req->fetchAll();
$nmbassure=$req[0]['count(id)'];



$req= $connete->prepare("SELECT count(code) FROM transaction");
$req->execute();
$req= $req->fetchAll();
$nmbtrans=$req[0]['count(code)'];

$req= $connete->prepare("SELECT count(numc) FROM carte");
$req->execute();
$req= $req->fetchAll();
$nomcarte=$req[0]['count(numc)'];







?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"> Admin  <?php  echo  $_SESSION["nomprenom"] ; ?></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
              <li class="dropdown">
                    <a href="index.php" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user">
                        
                    </i> bienvenue <?php  echo  $_SESSION["nomprenom"] ; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                       
                        <li class="divider"></li>
                        <li>
                            <a href="../deconexion.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                   
                    <li>
                        <a href="index.php? p=carte"><i class="fa fa-fw fa-table"></i> carte</a>
                    </li>
                    
                    <li>
                        <a href="index.php? p=transaction"><i class="fa fa-money fa-fw"></i> transaction </a>
                    </li>
                    <li>
                        <a href="index.php? p=users"><i class="fa fa-fw fa-wrench"></i>Users</a>
                    </li>
                
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>de <?php  echo  $_SESSION["nomprenom"] ; ?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                 <!-- FIRST ROW WITH PANELS -->

                <!-- /.row -->
                <div class="row">

                            <div class="col-lg-4 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3"><i class="fa fa-fw fa-table"></i>
                                        
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $nomcarte; ?></div>
                                        <div>nombre de carte!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php? p=carte">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $nmbtrans; ?></div>
                                        <div>nombre transaction!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php? p=transaction">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


          
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $nmbassure; ?></div>
                                        <div>nombre user!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php? p=users">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
            
              
                </div>
        
                <!-- /.row -->


                <!-- SECOND ROW WITH TABLES-->


                    <?php 



                     if(isset($_GET["p"]) and (!empty($_GET["p"])) and ($_GET["p"]=="users")){

                        include("users.php");

                               } 
                               if(isset($_GET["p"]) and (!empty($_GET["p"])) and ($_GET["p"]=="transaction")){
                                   include("alltransaction.php");

                                             
                             }

                               if(isset($_GET["p"]) and (!empty($_GET["p"])) and ($_GET["p"]=="alltransaction")){
                                   include("alltransaction.php");

                                             
                             }


                               if(isset($_GET["p"]) and (!empty($_GET["p"])) and ($_GET["p"]=="ajouteruser")){
                                   include("ajouteuser.php");

                                             
                             }

                               if(isset($_GET["p"]) and (!empty($_GET["p"])) and ($_GET["p"]=="edituser" )){
                                   include("edituser.php");

                                             
                             }

                               if(isset($_GET["p"]) and (!empty($_GET["p"])) and ($_GET["p"]=="carte" )){
                                   include("liste_carte.php");

                                             
                             }







                 






                    ?>


</div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
