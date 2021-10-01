<?php 
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Online prodaja video igara</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="css/mojStil.css" rel="stylesheet">

  <!-- za font awesome specijalne znakove moramo da ukljucimo font! -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <script src="https://kit.fontawesome.com/5cdf2c4e76.js" crossorigin="anonymous"></script>

</head>
<body onload="Vreme()">
  <div class="container"><!--  pocetak kontejnera -->

     <?php include "php/header.php"; ?>
     <?php include "php/modalOdjava.php"; ?>
     <?php //include "php/modalLogin.php"; ?>
     <?php //include "php/nav.php"; ?>
     <?php //include "php/orderSystem.php" ?>
     <?php if(isset($_SESSION['orderSucceed']) && $_SESSION['orderSucceed'] == true){
      ?>
      <p><b><span style="font-size: 18px;">Uspešno ste izvršili porudžbinu!</span></b></p>
      <p>Proizvodi će biti isporučeni na sledeću adresu: <b><?php echo $_SESSION['isporuka']?></b> u roku od narednih 5 radnih dana.<br>Isporuka se vrši preko POST EXPRESS-a (dodatno plaćanje 250 din za cenu dostave).<br>Hvala Vam na ukazanom poverenju.</p>
      <?php
     } ?>
     <br>
     <p>Detalji vaše narudžbenice:</p>
     
     <!-- TO-DO -->
     <?php include "php/ispisNarudzbenice.php" ?>
     <?php include "php/footer.php"; ?> 


  </div> <!-- kraj kontejnera -->



  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/vreme.js"></script>
  <script src="js/datumVremeIsporuke.js"></script>
</body>
</html>