<?php
    $_SESSION['solde']="";
    $_SESSION["nomprenom"] = " ";
    $_SESSION["login"] = " ";
    $_SESSION["mdp"] =" ";
    $_SESSION["tel"] = " ";
    $_SESSION["matuti"] = " ";
    $_SESSION["numc"] =" ";
    $_SESSION["role"] = " ";  
    $_SESSION["id"] = " "; 
    $_SESSION["iduti"] = " ";
    $_SESSION["code"] = " ";
    $_SESSION["etat"] =" ";
    $_SESSION["numde"] = " ";
    $_SESSION["numex"] = " ";
    $_SESSION["datetras"] =" ";
    $_SESSION['msg']='';
     $_SESSION["numcde"]='';
    
    unset( $_SESSION['solde']);
    unset( $_SESSION["nomprenom"]);
    unset($_SESSION["login"]);
    unset( $_SESSION["mdp"]);
    unset( $_SESSION["tel"]);
    unset($_SESSION["matuti"]);
    unset($_SESSION["numc"]);
    unset($_SESSION['role']);
    unset($_SESSION['id']);
    unset($_SESSION['iduti']);
    unset( $_SESSION["code"]);
    unset($_SESSION["etat"]);
    unset($_SESSION["numde"]);
    unset($_SESSION['numex']);
    unset($_SESSION['datetras']);
    unset($_SESSION['msg']);

    unset($_SESSION['numcde']);

    session_destroy();
    header('location: index.php');
?>


