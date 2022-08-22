
  <?php 


   include("sol.php");

   ?>
    <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <link href="../css../bootstrap.css" rel="stylesheet">


</head>


<body>

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          
            <ul class="nav navbar-left top-nav">
              <li class="dropdown">
              
                    <a href="menu.php" class="dropdown-toggle" data-toggle="dropdown"> bienvenue <?php  echo  $_SESSION["nomprenom"] ; ?> </a>
               </li>
               </ul>
                    <ul class="nav navbar-right top-nav">
                        
                        <li>
                            <a href="../../deconexion.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                      
                    </ul>
                </li>
        </nav>
        <br>
         <br> <br> <br> <br>

<div class="container">
<div id="menu_bar" class="d-flex justify-content-between col-7 m-auto mt-3">
<button type="button" class="btn btn-primary">
  Wallet <span class="badge "> <?php echo $_SESSION["solde"] ; ?> FCFA</span>
</button>
<a href="transaction.php ">
<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Send Money 

</button></a>
  <a href="http://stage.sam:9999/admin/"> 
    <input type="submit" " value="retour"></a>
</div>
<div id="trans_list">
<?php

foreach($sol3 as  $key =>$trans){
 
    if($trans['numex']==$_SESSION["tel"]){
        $color="danger";
$suffix= " A ".$trans['numde'];
    }else{
      $color="green";

$suffix= "DE ".$trans['numex'] ;

  }



   ?>
<div class="card col-7 shadow rounded m-auto mt-3">
  <div class="card-body d-flex justify-content-between align-items-center">
    <div>
    <h6 class=" mb-2 text-muted">  <?php echo $suffix  ;?></h6>
    <p class="card-text"> <?php echo $trans['datetras']; ?></p>
</div>
<h4 class="card-title text-<?php echo $color;?>"><b> <?php echo $color=='danger'?'-':'+';?> <?php echo $trans['montant'];?> FCFA</b></h4>
  </div>
</div>
    <?php 
}

?>
 
 



</div>



</div>

    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>



    <script>






</script>
</body>

</html>