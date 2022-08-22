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
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php echo   $message; ?>
            <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">

                    <form class="form-horizontal" method="post">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" name="sai_passe">mot de passe</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="inputName" placeholder="mot de passe" name="sai_passe">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger" name="modifie">modifier</button>
                          <a href="Profil.php">retoune au menu</a>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




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
