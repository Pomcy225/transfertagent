<?php
session_start();
$_SESSION['msg']='';

   $connete = new PDO('mysql:host=localhost;dbname=caisse','root','');

                                             $trans['code']=''; 
                                             $trans['datetras']='';
                                                $trans['montant']='';
                                                $trans['numde']='';
                                                 $trans['numex'] ='';

                                          $trans['numc_ex']='';

                                          $trans['numc_de']='';


if ((isset($_GET['id']))){

						    $req3 = $connete->prepare("SELECT * FROM  transaction WHERE code=:code ");
							$req3->bindParam(':code',$_GET['id']);
							$req3->execute();

                       $sol3 = $req3->fetchAll();
                       if (!empty($sol3)) {        

                                             $trans['code']= $sol3[0]['code'];
                                          $trans['datetras']=  $sol3[0]['datetras']; 
                                                $trans['numde']=$sol3[0]['numde'];
                                               $trans['numex']= $sol3[0]['numex']; 
                                                $trans['montant']=$sol3[0]['montant'];

						    $req3 = $connete->prepare("SELECT numc FROM  assure WHERE tel=:tel ");
						     $req3->bindParam(':tel', $trans['numde']);
							$req3->execute();
                       $sol3 = $req3->fetchAll();

                             $trans['numc_de']=$sol3[0]['numc'];
                       if (!empty($sol3)) { 


						    $req3 = $connete->prepare("SELECT numc FROM  assure WHERE tel=:tel ");
						     $req3->bindParam(':tel', $trans['numex']);
							$req3->execute();
                       $sol3 = $req3->fetchAll(); 
                             $trans['numc_ex']=$sol3[0]['numc'];
                          if (!empty($sol3)) { 



                       	  try{
                $connete->beginTransaction();
                // retrait du solde expediteur
                $req = $connete->prepare('UPDATE carte SET solde=solde - :montant WHERE numc=:numde');
                $req->bindParam(':montant',$trans['montant']);
                $req->bindParam(':numde', $trans['numc_de']);
                $req = $req->execute();

                // depot sur le solde expediteur
                $req = $connete->prepare('UPDATE carte SET solde=solde + :montant WHERE numc=:numex');
                $req->bindParam(':montant', $trans['montant']);
                $req->bindParam(':numex', $trans['numc_ex']);
                $req = $req->execute();

                $connete->Commit();
               $_SESSION['msg']="la transaction a ete retablie";

						$req3 = $connete->prepare("DELETE FROM transaction WHERE code=:code " );
						$req3->bindParam(':code',$_GET['id']);
						$req3->execute();
               

            }catch(Exeption $e ){
                $e->getMessage();
               $_SESSION['msg']="Soucis de reseau";


             
                $connete->rollBack();

            }

                          }else{

                     $_SESSION['msg']= "le expediteur n'existe pas ";

                          }


                      


                        }else{
                      $_SESSION['msg']= "le destinataire n'existe pas ";

                        }


                       }else{
                     $_SESSION['msg']= "le transfert n'existe pas";
                       }


        }


header("location: http://stage.sam:9999/admin/index.php?%20p=transaction");

         

   ?>



