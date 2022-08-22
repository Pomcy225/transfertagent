


<?php 
include("listeuser.php");

if ((isset($_POST['draft']))){




if ((!empty($_POST['sai_nomprenom']) ) and (!empty($_POST['sai_login']))){


  if ((!empty($_POST['sai_passe'])) and (!empty($_POST['sai_tel']))) {

    if ((!empty($_POST['sai_role']))) {



    $req = $connete->prepare("INSERT INTO  utilisateur VALUES(null,:login,:passe)");
    $req->bindParam(':login',$_POST['sai_login']); 
    $req->bindParam(':passe',$_POST['sai_passe']);
    $req->execute();

    if (!empty($req)) {

$solde=00;
$etat='actif';
$req = $connete->prepare("INSERT INTO  carte VALUES(null,:solde,:etat)");
$req->bindParam(':solde',$solde);
$req->bindParam(':etat',$etat); 
 $req->execute();
if (!empty($req)) {

  $req= $connete->prepare("SELECT MAX(iduti) FROM utilisateur");
$req->execute();
$req= $req->fetchAll();
$iduti=$req[0]['MAX(iduti)'];




  $req= $connete->prepare("SELECT MAX(numc) FROM carte");
$req->execute();
$req= $req->fetchAll();
$numc=$req[0]['MAX(numc)'];





            

$req = $connete->prepare("INSERT INTO  assure VALUES(null,:nomprenom,:login,:passe,:tel,:matuti,:numc,:role)");
$req->bindParam(':nomprenom',$_POST['sai_nomprenom']);
$req->bindParam(':login',$_POST['sai_login']); 
$req->bindParam(':passe',$_POST['sai_passe']);
$req->bindParam(':tel',$_POST['sai_tel']);
$req->bindParam(':matuti',$iduti);
$req->bindParam(':numc',$numc);
$req->bindParam(':role',$_POST['sai_role']);
 $req->execute();


    
}
else{

 $message='male1';

}



     $message='enregistre avec succes';
    }else{
         $message= 'male1'; 
    }
    

      
    }
 }
 }else{
 $message='remplisez tout les champs';
}
         }    
 

 ?>









        <div id="page-wrapper">

            <div class="container-fluid">






<div class="col-md-12">
  <?php echo $message; ?>

<div class="row">
<h1 class="page-header">
   Add assure

</h1>
</div>
               


<form action="" method="post" >


<div class="col-md-8">

<div class="form-group">
    <label for="sai_nomprenom">nom et premon </label>
        <input type="text" name="sai_nomprenom" class="form-control">
       
    </div>

<div class="form-group">
    <label for="sai_login">login </label>
        <input type="text" name="sai_login" class="form-control">
       
    </div>

<div class="form-group">
    <label for="sai_passe">mot de passe </label>
        <input type="password" name="sai_passe" class="form-control">
       
    </div>

<div class="form-group">
    <label for="sai_tel">telephone </label>
        <input type="text" name="sai_tel" class="form-control">
       
    </div>

</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
       <input type="submit" name="draft" class="btn btn-warning btn-lg" value="ajouter">
        <a href="index.php ">annuel</a>
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-title">selection le role</label>
          <hr>
        <select name="sai_role" id="" class="form-control">
           <option value="utilisateur">utilisateur</option>
              <option value="admin">admin</option>
               
           
        </select>


</div>





<!-- Product Tags -->




</aside><!--SIDEBAR-->


    
</form>