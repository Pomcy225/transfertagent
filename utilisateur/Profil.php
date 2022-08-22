<?php 
session_start();

$connete = new PDO('mysql:host=localhost;dbname=caisse','root','');
 $message=" ";

$nomprenom = "";
$login = "";
$passe = "";
$tel = "";
$role = "";



$req3 = $connete->prepare("SELECT * FROM  assure WHERE   id=:id " );
$req3->bindParam(':id', $_SESSION["id_assure"] );
$req3->execute();
$sol3 = $req3->fetchAll();
if(!empty($sol3)){
$nomprenom = $sol3[0]['nomprenom'];
$login = $sol3[0]['login'];
$passe =  $sol3[0]['passe'];
$tel = $sol3[0]['tel'];
$role = $sol3[0]['role'];
   
}else{
  $message= "Aucun resultat";
}


if ((isset($_POST['modifie_info']))){

$req = $connete->prepare("UPDATE assure SET nomprenom=:nomprenom,login=:login,passe=:passe,tel=:tel,role=:role WHERE id=:id");
$req->bindParam(':id', $_SESSION["id_assure"]);
$req->bindParam(':nomprenom',$_POST['sai_nomprenom']);
$req->bindParam(':login',$_POST['sai_login']); 
$req->bindParam(':passe',$passe);
$req->bindParam(':tel',$_POST['sai_tel']);
$req->bindParam(':role',$role);
$sol = $req->execute();
if(!empty($sol)){;
}else{
  $message= "Echec";
}
}



if ((isset($_POST['modifie']))){

$req = $connete->prepare("UPDATE assure SET nomprenom=:nomprenom,login=:login,passe=:passe,tel=:tel,role=:role WHERE id=:id");
$req->bindParam(':id', $_SESSION["id_assure"]);
$req->bindParam(':nomprenom',$nomprenom);
$req->bindParam(':login',$login); 
$req->bindParam(':passe',$_POST['sai_passe']);
$req->bindParam(':tel',$tel);
$req->bindParam(':role',$role);
$sol = $req->execute();
if(!empty($sol)){
   $message= "modifie avec succes";
}else{
  $message= "Echec";
}
}





 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | User Profile</title>

  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">



    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link href="../admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link href="../css/bootstrap.css" rel="stylesheet">
</head>
<body >
<div class="wrapper">
  <!-- Navbar -->



        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          
            <ul class="nav navbar-left top-nav">
              
                    <a href="http://stage.sam:9999/utilisateur/menu.php" >
              <li class="dropdown"> bienvenue <?php  echo $_SESSION["nomprenom"] ; ?>
               </li> 
           </a>
                <a href="profil.php"><input  class="btn btn-danger" type="submit"   value="profil"> </a>
               </ul>





   




                    <ul class="nav navbar-right top-nav">
                        
                        <li>
                            <a href="../deconexion.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                      
                    </ul>
               
        </nav>
        








  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item active">Profil de utilisateur</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                
            
                <h3 class="profile-username text-center"><?php  echo  $_SESSION["nomprenom"] ; ?></h3>




                <ul class="list-group list-group-unbordered mb-3">
                 
                  <li class="list-group-item">
                    <b>login</b> <a class="float-right"><?php  echo   $_SESSION["login"] ; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>mumero</b> <a class="float-right"><?php  echo $_SESSION["tel"]; ?></a>
                  </li>
                </ul>

                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col --><?php echo   $message; ?>
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">modifie mot de passe</a></li>
                 




                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">modified vos info</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">

                   <a href="http://stage.sam:9999/utilisateur/modi_pass.php?id=<?php echo $_SESSION["id_assure"];?>"> clique ici pour modifie votre mot de passe</a>
                   


                  </div>




                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" method="post">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">nom et prenom</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"  name="sai_nomprenom" value="<?php echo $nomprenom;?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">numero</label>
                        <div class="col-sm-10">
                          <input type="nember" class="form-control" name="sai_tel" value="<?php echo $tel;?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">login</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"  name="sai_login" value="<?php echo $login;?>">
                        </div>
                      </div>
                      
                     
                     
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger" name="modifie_info">modifier</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
