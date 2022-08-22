<?php 
$connete = new PDO('mysql:host=localhost;dbname=caisse','root','');
$connet= new PDO('mysql:host=localhost;dbname=caisse','root','');
 $message=" ";


$code = '';
$numde = '';
$numex =  '';
$montant =  '';
$numc_de='';
 $numc_ex='';
 $nume='';

$numd='';                     

    if ((isset($_GET['id']))){

                    $req3 = $connete->prepare("SELECT * FROM  transaction WHERE code=:code " );
                    $req3->bindParam(':code',$_GET['id']);
                    $req3->execute();
                    $sol3 = $req3->fetchAll();
                    if(!empty($sol3)){
                    $code = $sol3[0]['code'];
                    $numde = $sol3[0]['numde'];
                    $numex =  $sol3[0]['numex'];
                    $montant =  $sol3[0]['montant'];

                    $req3 = $connete->prepare("SELECT * FROM  assure WHERE tel=:tel ");
                             $req3->bindParam(':tel', $numex );
                            $req3->execute();
                       $sol9 = $req3->fetchAll(); 
                      $nume=$sol9[0]['numc'];



                              $req3 = $connete->prepare("SELECT * FROM  assure WHERE tel=:tel ");
                             $req3->bindParam(':tel', $numde);
                            $req3->execute();
                       $sol8 = $req3->fetchAll(); 
                             $numd=$sol8[0]['numc'];


if ((isset($_POST['sai_edite']))){


         if (!empty($sol3)) {        

                            $req3 = $connete->prepare("SELECT * FROM  assure WHERE tel=:tel ");
                             $req3->bindParam(':tel', $_POST['sai_de']);
                            $req3->execute();
                       $sol3 = $req3->fetchAll();

                             $numc_de=$sol3[0]['numc'];
                       if (!empty($sol3)) { 


                            $req3 = $connete->prepare("SELECT * FROM  assure WHERE tel=:tel ");
                             $req3->bindParam(':tel', $_POST['sai_ex']);
                            $req3->execute();
                       $sol3 = $req3->fetchAll(); 
                             $numc_ex=$sol3[0]['numc'];
                          if (!empty($sol3)) { 



                          try{
              $connete->beginTransaction();
                //  nouveau depot sur le solde destinataire
                $req = $connete->prepare('UPDATE carte SET solde=solde - :montant WHERE numc=:numde');
                $req->bindParam(':montant',$montant);
                $req->bindParam(':numde', $numd);
                $req = $req->execute();

                // nouveau retrait du solde expediteur 
                $req = $connete->prepare('UPDATE carte SET solde=solde + :montant WHERE numc=:numex');
                $req->bindParam(':montant', $montant);
                $req->bindParam(':numex',$nume);
                $req = $req->execute();

           

                              $connete->Commit();


                //  nouveau depot sur le solde destinataire
                $req = $connete->prepare('UPDATE carte SET solde=solde + :montant WHERE numc=:numde'); 
                            $req->bindParam(':numde',$numc_de);
                            $req->bindParam(':montant',$_POST['sai_montant']);
                $req = $req->execute();

                // nouveau retrait du solde expediteur 
                $req = $connete->prepare('UPDATE carte SET solde=solde - :montant WHERE numc=:numex'); 
                            $req->bindParam(':numex',$numc_ex);
                            $req->bindParam(':montant',$_POST['sai_montant']);





        $date = date('Y-m-d');
         $heure = date('H:i:s');
         $datee= $date.' '.$heure;

                            $req = $connete->prepare("UPDATE transaction SET numde=:numde,numex=:numex, montant=:montant,datetras=:datetras WHERE code=:code");
                            $req->bindParam(':code',$_GET['id']);
                            $req->bindParam(':numde',$_POST['sai_de']); 
                            $req->bindParam(':numex',$_POST['sai_ex']);
                            $req->bindParam(':montant',$_POST['sai_montant']);
                            $req->bindParam(':datetras',$datee);
                            $sol = $req->execute();
                $message= "la transaction a ete retablie ";
                                


            }catch(Exeption $e ){
                $e->getMessage();
                $message= "Soucis de reseau";


             
               $connete->rollBack();

            }

                          }else{

$code = '';
$numde = '';
$numex =  '';
$montant =  '';
$numc_de='';
 $numc_ex='';

                    $message=  "le expediteur n'existe pas ";

                          }


                      


                        }else{

$code = '';
$numde = '';
$numex =  '';
$montant =  '';
$numc_de='';
 $numc_ex='';
                      $message= "le destinataire n'existe pas ";

                        }

                       }else{

$code = '';
$numde = '';
$numex =  '';
$montant =  '';
$numc_de='';
 $numc_ex='';
                      $message= "le transfert n'existe pas";
                    }


   
     }
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
   edite transaction    

</h1>
</div>
               


<form action="" method="post" >


<div class="col-md-8">

<div class="form-group">
    <label for="sai_de">numero du destinataire
     </label>
        <input type="text" name="sai_de" class="form-control" value= "<?php echo  $numde;?>" >
       
    </div>


<div class="form-group">
    <label for="sai_ex">numero de l'expediteur</label>
        <input type="text" name="sai_ex" class="form-control" value= "<?php echo  $numex;?>">
       
    </div>

<div class="form-group">
    <label for="sai_montant">montant </label>
        <input type="text" name="sai_montant" class="form-control" value= "<?php echo $montant;?>">
       
    </div>
</div>
     
     <div class="form-group">
        <input type="submit" name="sai_edite" class="btn btn-primary btn-lg" value="edite_transaction">
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
