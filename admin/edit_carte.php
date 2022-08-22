<?php 
$connete = new PDO('mysql:host=localhost;dbname=caisse','root','');
 $message=" ";

$nom = '';
$tel =  '';

$solde = "";
$etat = "";
$numc = "";




if ((isset($_GET['id']))){


$req3= $connete->prepare(" SELECT * FROM `assure`,`carte` WHERE assure.numc=carte.numc AND carte.numc=:numc" );
$req3->bindParam(':numc',$_GET['id']);
$req3->execute();
$sol3 = $req3->fetchAll();
if(!empty($sol3)){
$numc = $sol3[0]['numc'];
$solde = $sol3[0]['solde'];
$etat =  $sol3[0]['etat'];
$nom = $sol3[0]['nomprenom'];
$tel =  $sol3[0]['tel'];
$id =  $sol3[0]['id'];
}
 if (empty($sol3)) {

$req3 = $connete->prepare("SELECT * FROM  carte WHERE   numc=:numc " );
$req3->bindParam(':numc',$_GET['id']);
$req3->execute();
$sol3 = $req3->fetchAll();
if(!empty($sol3)){
$numc = $sol3[0]['numc'];
$solde = $sol3[0]['solde'];
$etat =  $sol3[0]['etat'];
        
    }

   
}

}







if ((isset($_POST['sai_edite']))){

$req = $connete->prepare("UPDATE carte SET solde=:solde,etat=:etat WHERE numc=:numc");
$req->bindParam(':numc',$_GET['id']);
$req->bindParam(':solde',$_POST['sai_solde']); 
$req->bindParam(':etat',$_POST['sai_etat']);
$sol = $req->execute();

if(!empty($sol)){
    if (!empty($_POST['sai_tel'])) {
        

$req = $connete->prepare("UPDATE assure SET  numc=:numc WHERE tel=:tel ");
$req->bindParam(':numc',$_GET['id']);
$req->bindParam(':tel',$_POST['sai_tel']); 
$sol = $req->execute();

$num='0';

$req = $connete->prepare("UPDATE assure SET  numc=:numc WHERE id=:id ");
$req->bindParam(':id',$id);
$req->bindParam(':numc' ,$num); 
$sol = $req->execute();


header("location: http://stage.sam:9999/admin/index.php?%20p=carte");






    }else{

header("location: http://stage.sam:9999/admin/index.php?%20p=carte");

    }
  
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
    <label for="sai_numc">code carte </label>
        <input type="text" name="sai_numc" class="form-control" value= "<?php echo $numc;?>" >
       
    </div>


<div class="form-group">
    <label for="sai_solde">solde </label>
        <input type="text" name="sai_solde" class="form-control" value= "<?php echo $solde;?>">
       
    </div>
    <div class="form-group">

    <label for="nomprenom"> cette carte appantient a-- <?php echo $nom;?></label>

    <label for="tel"> de numero de telephne -- <?php echo $tel;?> </label>
    
    </div>
<div class="form-group">
    <label for="sai_solde">entre le  numero de telephne assure au quel vous voulez donne la carte  </label>
        <input type="text" name="sai_tel" class="form-control" >
       
    </div>



<div class="form-group">
         <label for="product-title">etat</label>
          <hr>
        <select name="sai_etat" id="" class="form-control">
           <option value="actif"><?php echo $etat;?></option>
           <option value="actif">actif</option>
              <option value="inactif">inactif</option>
      
        </select>


</div>
</div>
     
     <div class="form-group">
        <input type="submit" name="sai_edite" class="btn btn-primary btn-lg" value="edite">
    </div>
                    <button> <a href="http://stage.sam:9999/admin/">annuel</a></button>  



    
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
