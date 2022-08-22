

        <div id="page-wrapper">

            <div class="container-fluid">



                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Users
                         
   
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3" method="post">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" name="Search">
    
            <input  class="btn btn-navbar" type="submit"  value="recherche"> 
       
    </form> 
                        </h1>  
                                              
<?php include("listeuser.php"); ?>   

                <p class="bg-success">
                            <?php echo $message; ?>
                        </p>

                        <a href="index.php? p=ajouteruser" class="btn btn-primary">Add User</a>


                        <div class="col-md-12">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                       
                                        <th>nom et prenom</th>
                                        <th>login</th>
                                        <th>passeword </th>
                                        <th>telephone </th>
                                        <th>solde </th>
                                        <th>etat </th>
                                           <th></th>
                                    </tr>
                                </thead>
                                <tbody> 


                        

                                <?php foreach($users as $user): ?>

                                    <tr>

                                
                                        <td><?php echo $user['id']; ?> </td>
                                        
                                        <td><?php echo $user['nomprenom']; ?></td>
                                        
                                        
                                        <td><?php echo $user['login']; ?></td>
                                       <td><?php echo $user['passe']; ?></td>
                                       <td><?php echo $user['tel']; ?></td>
                                       
                                       <td><?php echo $user['solde']; ?></td>
                                       <td><?php echo $user['etat']; ?></td>
                                          <td><div class="action_links">
                                                      
                                 <a href="http://stage.sam:9999/admin/supprimeuser.php?id=<?php echo $user['id']; ?>">
                                     <input type="submit" name="btn_Delete" value="Delete">
                                                   
                                                      </a>
                                                           
                                                <a href="http://stage.sam:9999/admin/edituser.php?id=<?php echo $user['id']; ?>">
                                                    edit
                                                      </a>
                                                   

                                                
                                            </div></td>

                                       
                                    </tr>


                                <?php endforeach; 
  
                                                              
                                                    ?>


                                    
                                    
                                </tbody>
                            </table> <!--End of Table-->
                        

                        </div>










                        
                    </div>
    












            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

