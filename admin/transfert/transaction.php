
<?php 
   session_start();
   $connete = new PDO('mysql:host=localhost;dbname=caisse','root','');

// transaction




$msg="envoie de l'argent ";

if(isset($_POST['btn_trans'])){

 // if ((is_integer( $_POST['sai_somme']) ) and (is_integer($_POST['sai_numerode']))) {
   



    // verification de l'existence de l'expediteur
    $req = $connete->prepare('SELECT * FROM carte  WHERE  numc=:rech');
    $req->bindParam(':rech', $_SESSION["numc"]);
    $req->execute();
    $req = $req->fetchAll();




    if(!empty($req)){

        // verification de la disponibilite du montant sur le solde
        if($req[0]['solde'] > $_POST['sai_somme']){
      
$kk = array( $_POST['sai_numerode'] );
 
 if (  !in_array($_SESSION["tel"], $kk)) {

 // verification de l'existence de le destinataire
    $reqc = $connete->prepare('SELECT * FROM assure WHERE tel=:rech');
    $reqc->bindParam(':rech', $_POST['sai_numerode']);
    $reqc->execute();
    $reqc = $reqc->fetchAll();
     

 

 
  




    if(!empty($reqc)){
       $_SESSION["numcde"] = $reqc[0]['numc'];

        $date = date('Y-m-d');
         $heure = date('H:i:s');
         $datee= $date.' '.$heure;

        $req = $connete->prepare('INSERT INTO transaction VALUES(null,:numde,:numex,:montant,:datetras)');
       

        $req->bindParam(':numex', $_SESSION["tel"]);
        $req->bindParam(':numde', $_POST['sai_numerode']);
        
        $req->bindParam(':montant', $_POST['sai_somme']);
        $req->bindParam(':datetras', $datee);
        $req = $req->execute();

 
        if($req== true){
            
            try{
                $connete->beginTransaction();
                // retrait du solde expediteur
                $req = $connete->prepare('UPDATE carte SET solde=solde - :montant WHERE numc=:sai_exped');
                $req->bindParam(':montant', $_POST['sai_somme']);
                $req->bindParam(':sai_exped', $_SESSION["numc"]);
                $req = $req->execute();

                // depot sur le solde expediteur
                $req = $connete->prepare('UPDATE carte SET solde=solde + :montant WHERE numc=:sai_dest');
                $req->bindParam(':montant', $_POST['sai_somme']);
                $req->bindParam(':sai_dest',  $_SESSION["numcde"]);
                $req = $req->execute();

                $connete->Commit();
                $msg=" succes de la transaction";
                header("location: menu.php");

            }catch(Exeption $e ){
                $e->getMessage();
               $msg=" Soucis de reseau";
               
                $connete->rollBack();

            }
        }else{
      $msg= " Echec de la transaction";
     }




    }else{
      $msg= " Ce compte destinataire n'existe pas";
     } 



      }else{

    
     $msg= " imposible de faire le depot a ce numero ".$_POST['sai_numerode']; 
      
   

      }

  

        }else{
            $msg=' Solde insuffisant';
        }
     
      
     
 }else{
    $msg=" entre un numero et une somme";

  } 
   }else{
    $msg=" entre un numero et une somme";

  }


   ?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" connetetent="IE=edge">
    <meta name="viewport" connetetent="width=device-width, initial-scale=1">
    <meta name="description" connetetent="">
    <meta name="author" connetetent="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <link href="../css../bootstrap.css" rel="stylesheet">

</head>


<body>


        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          
            <ul class="nav navbar-left top-nav">
              <li class="dropdown">
              
                    <a href="menu.php" class="dropdown-toggle" data-toggle="dropdown"> bienvenue <?php  echo  $_SESSION["nomprenom"] ; ?> </a>
               </li>
               </ul>
                    <ul class="nav navbar-right top-nav">
                        <li class="dropdown">
                            <a href="../../deconexion.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                      </li>
                    </ul>
                </li>
        </nav>
        <br>
         <br> <br> <br> <br>




    
<h1 class="text-center"><?php     echo $msg;?>  </h1>
        <div class="col-sm-4 col-sm-offset-5"> 

              
            <form class="" action=" " method="post">
                <div class="form-group"><label for="">
                    numero<input type="number" name="sai_numerode" class="form-connetetrol"></label>
                </div>
                 <div class="form-group"><label for="">
                    somme<input type="number" name="sai_somme" class="form-connetetrol"></label>
                </div>

                <div class="form-group">
                  <input type="submit" name="btn_trans" class="btn btn-primary" >

                    <button> <a href="menu.php">annuel</a></button>  
                </div>
            </form>



            </body>

</html>