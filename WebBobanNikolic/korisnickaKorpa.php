<?php 
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Prodavnica</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="css/mojStil.css" rel="stylesheet">

  <!-- za font awesome specijalne znakove moramo da ukljucimo font! -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <script src="https://kit.fontawesome.com/5cdf2c4e76.js" crossorigin="anonymous"></script>

</head>
<body onload="Vreme()">

  <div class="container"><!--  pocetak kontejnera -->
    <!-- MORA OVDE DA SE NAVEDE HEADER !!!BECAUSE NO OUTPUT BEFORE HEADER INFORMATION!!! -->
   <?php if((isset($_POST['btnUbaciUKorpu']) || isset($_POST['btnUbaciUKorpuIgra'])) && isset($_SESSION['pageName'])){
    // $pageName = $_POST['pageName'];
    $_SESSION['dodatoUKorpu'] = true;
    $_SESSION['idIzabrani'] = $_POST['idIzabrani']; //prosledjuje se za proizvod.php stranicu da zna koju igru da prikaze!!!
    $pageName = $_SESSION['pageName'];
    header("Location: $pageName");
  }
  ?>
  <?php include "php/header.php"; ?>
  <?php include "php/modalOdjava.php"; ?>
  <?php include "php/modalLogin.php"; ?>
  <?php include "php/navKorpa.php"; ?>
  <!-- <?php //include "php/gallery.php"; ?> -->
  <?php include "php/korpaMain.php"; ?>
  <?php include "php/footer.php"; ?>



</div> <!-- kraj kontejnera -->



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/vreme.js"></script>
<script src="js/datumVremeIsporuke.js"></script>
<script src="js/validacija.js"></script>
</body>
</html>