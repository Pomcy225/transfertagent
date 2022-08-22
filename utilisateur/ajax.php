<?php 
   session_start();
   $connete = new PDO('mysql:host=localhost;dbname=caisse','root','');


$req3 = $connete->prepare("SELECT * FROM  carte WHERE numc=:num");
$req3->bindParam(':num',$_SESSION["numc"]);
$req3->execute();
$sol3 = $req3->fetchAll(); 
if(!empty($sol3)){
    $_SESSION["numc"] = $sol3[0]['numc'];
    $_SESSION["etat"] = $sol3[0]['etatc'];

    header("location: menu.php");
 


}


?>