
   <?php
   $_SESSION["solde"] ='';
   session_start();
   $connete = new PDO('mysql:host=localhost;dbname=caisse','root','');

  
$req3 = $connete->prepare("SELECT * FROM  transaction WHERE    numex=:num || numde=:num   ORDER BY code DESC " );
$req3->bindParam(':num', $_SESSION["tel"] );
$req3->execute();
$sol3 = $req3->fetchAll();


 
$req34 = $connete->prepare("SELECT * FROM  carte WHERE    numc=:num " );
$req34->bindParam(':num', $_SESSION["numc"] );
$req34->execute();
$sol34 = $req34->fetchAll();
if (!empty($sol34)) {
	$_SESSION["solde"] = $sol34[0]['solde'];

}else{
	 $_SESSION["solde"] ='';

}

    
?>

