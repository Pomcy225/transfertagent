
   <?php
   session_start();
   $_SESSION["solde"] ='';
   $_SESSION["nnomprenom"] ='';
  
   $connete = new PDO('mysql:host=localhost;dbname=caisse','root','');


if (!empty($_POST['sai_debut']) and !empty($_POST['sai_fin'])) {



    $debut=$_POST['sai_debut'].' '.'00:00:00';
    $fin=$_POST['sai_fin'].' '.'23:59:59';



  
$req3= $connete->prepare(" SELECT * FROM `transaction` WHERE `datetras` BETWEEN :debut AND :fin" );
$req3->bindParam(':debut',$debut) ;
 $req3->bindParam(':fin',$fin) ;

$req3->execute();
$sol3 = $req3->fetchAll();



    
$req4= $connete->prepare(" SELECT SUM(montant) FROM `transaction` WHERE numde=:num  and `datetras` BETWEEN :debut AND :fin" );
$req4->bindParam(':debut',$debut) ;
 $req4->bindParam(':fin',$fin) ;
 $req4->bindParam(':num', $_SESSION["tel"] );

$req4->execute();
$sol4 = $req4->fetchAll();


    
$req44= $connete->prepare(" SELECT SUM(montant) FROM `transaction` WHERE numex=:num  and `datetras` BETWEEN :debut AND :fin" );
$req44->bindParam(':debut',$debut) ;
 $req44->bindParam(':fin',$fin) ;
 $req44->bindParam(':num', $_SESSION["tel"] );

$req44->execute();
$sol44 = $req44->fetchAll();

}else{






  
$req3 = $connete->prepare("SELECT * FROM  transaction WHERE    numex=:num || numde=:num   ORDER BY code DESC LIMIT 4 " );
$req3->bindParam(':num', $_SESSION["tel"] );
$req3->execute();
$sol3 = $req3->fetchAll();



$req4= $connete->prepare(" SELECT SUM(montant) FROM transaction WHERE   numde=:num   ORDER BY code DESC " );

$req4->bindParam(':num', $_SESSION["tel"] );
$req4->execute();
$sol4 = $req4->fetchAll();



$req44= $connete->prepare(" SELECT SUM(montant) FROM transaction WHERE    numex=:num   ORDER BY code DESC " );

$req44->bindParam(':num', $_SESSION["tel"] );
$req44->execute();
$sol44 = $req44->fetchAll();





 
$req34 = $connete->prepare("SELECT * FROM  carte WHERE numc=:num  " );
$req34->bindParam(':num', $_SESSION["numc"] );
$req34->execute();
$sol34 = $req34->fetchAll();
if (!empty($sol34)) {
	$_SESSION["solde"] = $sol34[0]['solde'];

}else{
	 $_SESSION["solde"] ='';

}

	
}



?>

