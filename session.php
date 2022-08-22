<?php 
session_start(); 
//Connexion a la base de donnée
    $connete = new PDO('mysql:host=localhost;dbname=caisse','root','');

    $mgs=" ";
    $mgssession=" ";
     $_SESSION["id_assure"] ='';
	$_SESSION["nomprenom"] = " ";
	$_SESSION["login"] = " ";
	$_SESSION["mdp"] =" ";
    $_SESSION["tel"] = " ";
    $_SESSION["matuti"] = " ";
    $_SESSION["numc"] =" ";
    $_SESSION["role"] = " ";
    
// code du bouton ajouter
if(isset($_POST['submit']))// si je clique sur le bouton ajouter
{
	
$req = $connete->prepare("SELECT * FROM  utilisateur WHERE login=:login and passworduti=:mdp");
$req->bindParam(':login',$_POST['sai_login']);
$req->bindParam(':mdp',$_POST['sai_password']);
$req->execute();
$sol = $req->fetchAll();
if(!empty($sol)){
    $mgs= "top";

    $req1 = $connete->prepare("SELECT * FROM  assure WHERE login=:login and passe=:mdp");
    $req1->bindParam(':login',$_POST['sai_login']);
    $req1->bindParam(':mdp',$_POST['sai_password']);
     $req1->execute();
    $sol1 = $req1->fetchAll();  
    if(!empty($sol1)){


        $_SESSION["id_assure"] = $sol1[0]['id'];
        $_SESSION["nomprenom"] = $sol1[0]['nomprenom'];
        $_SESSION["login"] = $sol1[0]['login'];
        $_SESSION["mdp"] = $sol1[0]['passe'];
        $_SESSION["tel"] = $sol1[0]['tel'];
        $_SESSION["matuti"] = $sol1[0]['matuti'];
        $_SESSION["numc"] = $sol1[0]['numc'];
        $_SESSION["role"] = $sol1[0]['role'];
        $mgssession= " demarage de la variable de session";
 if (!empty($_SESSION["id_assure"] )) {
   
        if ( $_SESSION["role"]=="admin") {
                 
     header("location: admin/");
        }else {
            header("location: utilisateur/ajax.php");
        }
 }else{
    $mgssession= "erreur du demarage de la variable de session";
 }
       
  
    
    
    }else{
            $mgssession= "erreur du demarage de la variable de session";
        }

  


}else{
	$mgs= "login et mot de passe incorrecte";
   
}
}




?>
