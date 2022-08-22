<?php 
$connete = new PDO('mysql:host=localhost;dbname=caisse','root','');
 $message=" ";

$nomprenom = "";
$login = "";
$passe = "";
$tel = "";
$role = "";




if ((isset($_GET['id']))){

$req3 = $connete->prepare("SELECT * FROM  assure WHERE   id=:id " );
$req3->bindParam(':id',$_GET['id']);
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
}

if ((isset($_POST['sai_edite']))){

$req = $connete->prepare("UPDATE assure SET nomprenom=:nomprenom,login=:login,passe=:passe,tel=:tel,role=:role WHERE id=:id");
$req->bindParam(':id', $_GET['id']);
$req->bindParam(':nomprenom',$_POST['sai_nomprenom']);
$req->bindParam(':login',$_POST['sai_login']); 
$req->bindParam(':passe',$_POST['sai_passe']);
$req->bindParam(':tel',$_POST['sai_tel']);
$req->bindParam(':role',$_POST['sai_role']);
$sol = $req->execute();
if(!empty($sol)){
   $message= "succes";
}else{
  $message= "Echec";
}
}





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

        <div id="page-wrapper">

            <div class="container-fluid">







<div class="col-md-12">
  <?php echo $message; ?>

<div class="row">
<h1 class="page-header">
   edite assure    

</h1>
</div>
               


<form action="" method="post" >


<div class="col-md-8">

<div class="form-group">
    <label for="sai_nomprenom">nom et premon </label>
        <input type="text" name="sai_nomprenom" class="form-control" value= "<?php echo $nomprenom;?>" >
       
    </div>


<div class="form-group">
    <label for="sai_login">login </label>
        <input type="text" name="sai_login" class="form-control" value= "<?php echo $login;?>">
       
    </div>

<div class="form-group">
    <label for="sai_passe">mot de passe </label>
        <input type="password" name="sai_passe" class="form-control" value="<?php echo $passe;?>">
       
    </div>

<div class="form-group">
    <label for="sai_tel">telephone </label>
        <input type="text" name="sai_tel" class="form-control" value= "<?php echo $tel;?>">
       
    </div>
    </div>

     <div class="form-group">
        <input type="submit" name="sai_edite" class="btn btn-primary btn-lg" value="edite">
        <button> <a href="http://stage.sam:9999/admin/">annuel</a></button>  
    </div>

    <div>
        selection le role
        <select name="sai_role" id="" class="form-control">
         <option > <?php echo $role;?> </option>
           <option value="utilisateur">utilisateur</option>
              <option value="admin">admin</option>
      
        </select>


</div>



<!-- SIDEBAR-->


                    

    
</form>

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
