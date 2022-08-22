<?php 

$connete = new PDO('mysql:host=localhost;dbname=caisse','root','');



if ((isset($_POST['sai_ajouter']))){




$solde=00;
    $req = $connete->prepare("INSERT INTO  carte VALUES(null,:solde,:etat)");
    $req->bindParam(':solde',$solde);
    $req->bindParam(':etat',$_POST['sai_etat']);
    $req->execute();


header("location: http://stage.sam:9999/admin/index.php?%20p=carte");
  }


else{

 $message='erreur de la creation';

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
   ajouter la carte    

</h1>
</div>
               


<form action="" method="post" >




<div class="form-group">
         <label for="product-title">etat</label>
          <hr>
        <select name="sai_etat" id="" class="form-control">
           <option value="actif">actif</option>
              <option value="inactif">inactif</option>
      
        </select>

</div>



     <div class="form-group">
        <input type="submit" name="sai_ajouter" class="btn btn-primary btn-lg" value="ajouter">
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
