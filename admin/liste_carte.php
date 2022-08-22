<?php
$carte['numc']='';
$carte['solde']='';
$carte['etat']='';

   $connete = new PDO('mysql:host=localhost;dbname=caisse','root','');

 if (!empty($_POST['Search'])) {
    
$req3= $connete->prepare(" SELECT * FROM  carte WHERE numc LIKE :rech " );

 $req3->bindParam(':rech',$_POST['Search']) ;
$req3->execute();
$sol3 = $req3->fetchAll();
            if (empty($sol3)) {
                $req3= $connete->prepare(" SELECT * FROM  carte WHERE  solde LIKE :rech " );

             $req3->bindParam(':rech',$_POST['Search']) ;
            $req3->execute();
         $sol3 = $req3->fetchAll();
                       if (empty($sol3)) {
                                  $req3= $connete->prepare(" SELECT * FROM  carte WHERE  etat LIKE :rech " );

                                 $req3->bindParam(':rech',$_POST['Search']) ;
                                $req3->execute();
                                $sol3 = $req3->fetchAll();

                                                }
             


            }

   }else{


$req3 = $connete->prepare("SELECT * FROM  carte " );
$req3->execute();
$sol3 = $req3->fetchAll();



   }



 ?>

 <a href="http://stage.sam:9999/admin/ajouter_carte.php" class="btn btn-primary">Add carte</a>
        <div id="page-wrapper">
                                        <!-- SEARCH FORM -->
    <form class="form-inline ml-3 rigth" method="post">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" name="Search">
    
            <input  class="btn btn-navbar" type="submit"  value="recherche"> 
       
    </form> 

            <div class="container-fluid">







                        <div class="col-md-12">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        
                                       
                                        <th>numero de carte</th>
                                        <th>solde </th>
                                        <th>etat </th>
                                           <th></th>
                                    </tr>
                                </thead>
                                <tbody> 


                        

                                <?php foreach($sol3 as $carte): ?>

                                    <tr>

                                
                                        <td><?php echo $carte['numc']; ?> </td>
                                        
                                        <td><?php echo $carte['solde']; ?>
                                              
                                        </td>
                                        
                                        
                                        <td><?php echo $carte['etat']; ?></td>
                                          <th><div class="action_links">
                                                      
                                 <a href="http://stage.sam:9999/admin/sup_carte.php?id=<?php echo $carte['numc']; ?>">
                                     <input type="submit" name="btn_Delete" value="Delete">
                                                   
                                                      </a>
                                                           
                                 <a href="http://stage.sam:9999/admin/edit_carte.php?id=<?php echo $carte['numc']; ?>">
                                                    edit
                                                      </a>
                                                   

                                                
                                            </div></th>

                                       
                                    </tr>


                                <?php endforeach; 
  
                                                              
                                                    ?>


                                    
                                    
                                </tbody>
                            </table> <!--End of Table-->
                        

                        </div>

