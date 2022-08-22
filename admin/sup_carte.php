<?php

   $connete = new PDO('mysql:host=localhost;dbname=caisse','root','');


if (isset($_GET['id'])){


$req3 = $connete->prepare("DELETE FROM carte WHERE  numc=:numc " );
$req3->bindParam(':numc',$_GET['id']);
$req3->execute();


header("location: http://stage.sam:9999/admin/index.php?%20p=carte");


}
?>