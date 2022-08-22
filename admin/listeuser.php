 <?php
   
   $connete = new PDO('mysql:host=localhost;dbname=caisse','root','');

   if (!empty($_POST['Search'])) {
    
$users= $connete->prepare(" SELECT * FROM `assure`,`carte` WHERE assure.numc=carte.numc AND tel LIKE :rech " );

 $users->bindParam(':rech',$_POST['Search']) ;
$users->execute();
$users = $users->fetchAll();
$message="liste des assure et carte adores";
		if (empty($users)) {

		$users= $connete->prepare(" SELECT * FROM `assure`,`carte` WHERE assure.numc=carte.numc AND nomprenom LIKE :rech " );

		 $users->bindParam(':rech',$_POST['Search']) ;
		$users->execute();
		$users = $users->fetchAll();
		$message="liste des assure et carte adores";
		if (empty($users)) {

		$users= $connete->prepare(" SELECT * FROM `assure`,`carte` WHERE assure.numc=carte.numc AND solde LIKE :rech " );

		 $users->bindParam(':rech',$_POST['Search']) ;
		$users->execute();
		$users = $users->fetchAll();
		$message="liste des assure et carte adores";
		if (empty($users)) {

		$users= $connete->prepare(" SELECT * FROM `assure`,`carte` WHERE assure.numc=carte.numc AND etat LIKE :rech " );

		 $users->bindParam(':rech',$_POST['Search']) ;
		$users->execute();
		$users = $users->fetchAll();
		$message="liste des assure et carte adores";
			if (empty($users)) {

		$users= $connete->prepare(" SELECT * FROM `assure`,`carte` WHERE assure.numc=carte.numc AND id LIKE :rech " );

		 $users->bindParam(':rech',$_POST['Search']) ;
		$users->execute();
		$users = $users->fetchAll();
		$message="liste des assure et carte adores";
	}
	}
		
		}
		
		}


   }else{


$users= $connete->prepare(" SELECT * FROM assure ,carte WHERE assure.numc=carte.numc " );

$users->execute();
$users = $users->fetchAll();

$message="liste des assure et carte adores";


   }

  
?>


