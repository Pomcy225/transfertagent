<?php

   $connete = new PDO('mysql:host=localhost;dbname=caisse','root','');


if ((isset($_GET['id']))){


$req3 = $connete->prepare("SELECT * FROM  assure WHERE   id=:id " );
$req3->bindParam(':id',$_GET['id']);
$req3->execute();
$sol3 = $req3->fetchAll();
if(!empty($sol3)){
$passe =  $sol3[0]['matuti'];
$tel = $sol3[0]['numc'];
}




$req3 = $connete->prepare("DELETE FROM assure WHERE id=:id " );
$req3->bindParam(':id',$_GET['id']);
$req3->execute();



$req3 = $connete->prepare("DELETE FROM utilisateur WHERE   iduti=:iduti " );
$req3->bindParam(':iduti',$sol3[0]['matuti']);
$req3->execute();


$req3 = $connete->prepare("DELETE FROM carte WHERE   numc=:numc " );
$req3->bindParam(':numc',$sol3[0]['numc']);
$req3->execute();


header("location: http://stage.sam:9999/admin/index.php?%20p=users");





        }



?>