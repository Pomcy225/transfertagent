 <?php
             if (empty( $_SESSION['msg'])) {
                $_SESSION['msg']='';
             
             }

                                             $trans['code']=''; 
                                             $trans['datetras']='';
                                                $trans['montant']='';
                                                $trans['numde']='';
                                                 $trans['numex'] ='';
 
   $connete = new PDO('mysql:host=localhost;dbname=caisse','root','');


 if (!empty($_POST['Search'])) {
    
$req3= $connete->prepare(" SELECT * FROM transaction WHERE  numex LIKE :rech OR numde LIKE :rech " );

 $req3->bindParam(':rech',$_POST['Search']) ;
$req3->execute();
$sol3 = $req3->fetchAll();



$req4= $connete->prepare(" SELECT SUM(montant) FROM  transaction WHERE  numex LIKE :rech OR numde LIKE :rech  ");


 $req4->bindParam(':rech',$_POST['Search']) ;

            if (empty($sol3)) {
                $req3= $connete->prepare(" SELECT * FROM transaction WHERE  code LIKE :rech " );

             $req3->bindParam(':rech',$_POST['Search']) ;
            $req3->execute();
         $sol3 = $req3->fetchAll();

$req4= $connete->prepare(" SELECT SUM(montant) FROM  transaction WHERE  code LIKE :rech ");

                                 $req4->bindParam(':rech',$_POST['Search']) ;

                       if (empty($sol3)) {
                                  $req3= $connete->prepare(" SELECT * FROM transaction WHERE  code LIKE :rech " );

                                 $req3->bindParam(':rech',$_POST['Search']) ;
                                $req3->execute();
                                $sol3 = $req3->fetchAll();



$req4= $connete->prepare(" SELECT SUM(montant) FROM  transaction WHERE  code LIKE :rech ");

                                 $req4->bindParam(':rech',$_POST['Search']) ;

                                 if (empty($sol3)) {
                                  $req3= $connete->prepare(" SELECT * FROM transaction WHERE  montant LIKE :rech " );

                                 $req3->bindParam(':rech',$_POST['Search']) ;
                                $req3->execute();
                                $sol3 = $req3->fetchAll();


                                   $req4= $connete->prepare(" SELECT SUM(montant) FROM  transaction WHERE  montant LIKE :rech ");

                                 $req4->bindParam(':rech',$_POST['Search']) ;



                                 if (empty($sol3)) {
                                  $req3= $connete->prepare(" SELECT * FROM transaction WHERE  datetras LIKE :rech " );

                                 $req3->bindParam(':rech',$_POST['Search']) ;
                                $req3->execute();
                                $sol3 = $req3->fetchAll();


                                   $req4= $connete->prepare(" SELECT SUM(montant) FROM  transaction WHERE  datetras LIKE :rech ");

                                 $req4->bindParam(':rech',$_POST['Search']) ;

                                                }

                                                }

                                                }
             


            }

   }else{


              if(isset($_GET["p"]) and (!empty($_GET["p"])) and ($_GET["p"]=="transaction")){
                               
$req3 = $connete->prepare("SELECT * FROM  transaction ORDER BY code DESC LIMIT 3 " );

$req3->execute();
$sol3 = $req3->fetchAll();

                $req4= $connete->prepare(" SELECT SUM(montant) FROM  transaction ORDER BY code DESC LIMIT 3 ");

                                             
                             } 
                  if(isset($_GET["p"]) and (!empty($_GET["p"])) and ($_GET["p"]=="alltransaction")){

                       $req3 = $connete->prepare("SELECT * FROM  transaction ORDER BY code DESC ");

                        $req3->execute();
                        $sol3 = $req3->fetchAll();



                $req4= $connete->prepare(" SELECT SUM(montant) FROM  transaction ORDER BY code DESC ");

                             } 

   }

   if (!empty($_POST['sai_debut']) and !empty($_POST['sai_fin'])) {

    $debut=$_POST['sai_debut'].' '.'00:00:00';
    $fin=$_POST['sai_fin'].' '.'23:59:59';
    
$req3= $connete->prepare(" SELECT * FROM `transaction` WHERE `datetras` BETWEEN :debut AND :fin" );
$req3->bindParam(':debut',$debut) ;
 $req3->bindParam(':fin',$fin) ;




    
$req4= $connete->prepare(" SELECT SUM(montant) FROM `transaction` WHERE `datetras` BETWEEN :debut AND :fin" );
$req4->bindParam(':debut',$debut) ;
 $req4->bindParam(':fin',$fin) ;


}



$req3->execute();
$sol3 = $req3->fetchAll();


$req4->execute();
$sol4 = $req4->fetchAll();
?>






                                 <!-- SEARCH FORM -->
    <form class="form-inline ml-3 rigth" method="post">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" name="Search">
    
            <input  class="btn btn-navbar" type="submit"  value="recherche"> 
       
    </form> 


<br>


<form class="form-inline ml-3 rigth" method="post">
date debut   <input class="form-control form-control-navbar" type="search" placeholder="date debut" aria-label="date debut" name="sai_debut">
      et date fin   <input class="form-control form-control-navbar" type="search" placeholder="date fin" aria-label="date fin" name="sai_fin">
    
            <input  class="btn btn-navbar" type="submit"  value="recherche"> 
       
    </form> 








                        <div class="panel panel-default">
                          
                            <div class="panel-heading">
         <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel <?php echo $_SESSION['msg']; ?></h3> 
    

                            <a href="http://stage.sam:9999/admin/transfert/menu.php" class="btn btn-primary">Add transation</a>

                            </div>

                            <div class="panel-body">

<div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Order Date</th>
                                                <th>destinataire</th>
                                                <th>expediteur</th>
                                                <th>Amount (USD)</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php                                        
                    foreach($sol3 as  $key =>$trans){
                     
                       
                    $suffixe= " A ".$trans['numde'];
                       
                          

                    $suffix= "DE ".$trans['numex'] ;
                      ?>
                                            <tr>
                                                <td><?php echo $trans['code']; ?></td>
                                                <td><?php echo $trans['datetras']; ?></td>
                                                <td><?php echo $suffixe ;?></td>
                                                <td><?php echo $suffix ;?></td>
                                                <td> <?php echo $trans['montant'];?>FCFA</td>
                                                <td><div class="action_links">
                                                      
                                 <a href="http://stage.sam:9999/admin/supprime_transaction.php?id=<?php echo $trans['code']; ?>">
                                     <input type="submit" name="btn_Delete" value="annuel et supprimer">
                                                   
                                                      </a>
                                                
                                            </div></td>

                                            </tr>
                                          
                        <?php 
                    }

                    ?>
                                        </tbody>
                                    </table>






 <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                
                                                      <th>total envoye  et reçu</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php                                        
                    foreach($sol4 as  $key =>$trans){
                     
                       
                    ?>
                                            <tr>
                                                <td><?php echo $trans['SUM(montant)']; ?> FCFA</td>
                                                      

                                            </tr>
                                          
                        <?php 
                    }

                    ?>
                                        </tbody>
                                    </table>






                                </div>



                            </div>
                 
                   


                   