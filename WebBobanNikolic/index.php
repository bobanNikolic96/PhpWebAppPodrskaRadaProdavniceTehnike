<?php 
session_start();

 // if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
  //$_SESSION['message'] = "poruka";
  // }
//$message = $_SESSION['message'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Prodavnica tehnike</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="css/mojStil.css" rel="stylesheet">

  <!-- za font awesome specijalne znakove moramo da ukljucimo font! -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <script src="https://kit.fontawesome.com/5cdf2c4e76.js" crossorigin="anonymous"></script>

</head>
<body onload="Vreme()"><!--  event handlers -->

  <div class="container"><!--  pocetak kontejnera -->
    <?php include "php/modalWelcomeUser.php"; ?> <!-- dobrodoslica user-a -->
    <?php include "php/header.php"; ?>
    <?php include "php/modalOdjava.php"; ?>
    <?php include "php/modalLogin.php"; ?>
    <!-- include za loginSystem.php --> <!-- MORALI SMO DA ISKLJUCIMO DA BI SE PRENELA SESSION PROMENLJIVA -->
    <?php  if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ 
      ?> <!-- za kada je neuspesno logovanje, prikazati alert! -->
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong><?php echo $_SESSION['message']; ?></strong>
      </div>
      <?php //ovde se izlogovati (destroy session!!!) da ne bi pri reload-u ponovo prikazivalo ovaj alert
           $_SESSION = array();
           session_destroy();
          ?>
      <?php
    } ?>
    <?php include "php/nav.php"; ?>
    <?php include "php/main.php"; ?>
    <?php include "php/footer.php"; ?>

  </div> <!-- kraj kontejnera -->



  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/vreme.js"></script>

  <?php  if(isset($_SESSION['email1']) && !empty($_SESSION['email1'])){
    //DA BI SE MODALNI DIJALOG OTVORIO SAMO JEDNOM, SESSION VARIJABLE PREBACITI U DRUGE SA SLICNIM IMENOM A OVE U IF USLOVU UNSET-OVATI!
    //!!!!!!!!MORA DA SE POZOVE NA KRAJU SA OSTALIM JQUERY SCRIPTAMA, NECE DA RADI AKO SCRIPTU STAVIMO GORE U KONTEJNER!
     ?>
    <script type="text/javascript">
      $(window).on('load',function(){
        $('#modalWelcome').modal('show');
      });
    </script>
    <?php
    $_SESSION['email'] = $_SESSION['email1']; //prebacujemo email1 u email. DALJE KORISTIMO email a ne email1!!!!!!!!!!!
    unset($_SESSION['email1']); //ovo radimo da kad sledeci put udjemo na ovu stranicu, da bi nam if uslov bio netacan, te da se ne load-uje modalni dijalog!!!
    } 
    ?>
</body>
</html>