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
  <script src="https://kit.fontawesome.com/5cdf2c4e76.js" crossorigin="anonymous"></script>
  
    <script type="text/javascript">
      function on_change(){ // za povracaj selektovane platforme i generisanje odgovarajuceg product Id-ja (sa prefiksima PC, PS ili XB) (pri kreiranju nove igre!)
      var selectPlt = document.getElementById("platformaDropDown");
      var selectedPlatform = selectPlt.options[selectPlt.selectedIndex].value;
      // alert("Izabrali ste: " +  selectedPlatform);
      if(selectedPlatform == "pc") {
        document.getElementById("productID").value = "PC" + Math.floor(Math.random() * 999999);
      } else if(selectedPlatform == "ps4") {
        document.getElementById("productID").value = "PS" + Math.floor(Math.random() * 999999);
      } else {
        document.getElementById("productID").value = "XB" + Math.floor(Math.random() * 999999);
      }
      var prodID = document.getElementById("productID").value;
      alert("ID je generisan: " + prodID);
    }
    </script>
</head>
<body onload="Vreme()">
  <div class="container"><!--  pocetak kontejnera -->
     <?php include "php/modalWelcomeUser.php"; ?> <!-- dobrodoslica user-a (administrator) -->
     <?php include "php/header.php"; ?>

     <?php include "php/modalOdjava.php"; ?>

     <div class="container" style="display: flex; margin-top: 10px;"><!-- ******kopiraj ovaj div u svaku od stranica koje cemo praviti za admina****** -->

      <?php include "phpadmin/navAdmin.php" ?><!-- sidebar -->
      <div class="tab-content">

        <?php if(isset($_SESSION['dodataIgra']) && isset($_SESSION['kolDodateIgre'])){
     //echo "blbablabla"; ?> <!-- *****ovde promeniti***** -->
      <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Uspešno ste dodali igru:<strong><?php echo $_SESSION['dodataIgra'] . 
            " (Količina: " .$_SESSION['kolDodateIgre'] . ")";  ?></strong>
      </div>
        <?php
        unset($_SESSION['dodataIgra']);
        unset($_SESSION['kolDodateIgre']);
         } ?>

     <?php include "phpadmin/main.php" ?>
     <?php include "phpadmin/dodajIgru1.php" ?>
     <?php include "phpadmin/pregledNarudzbenicaPoDatumu.php" ?>
     <?php include "phpadmin/updateKorisnika.php" ?>
     <?php include "phpadmin/updateIgre.php" ?>
      </div>
     </div>
  </div> <!-- kraj kontejnera -->



  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/vreme.js"></script>
  <script src="js/proveraSelect.js"></script>
  <?php  if(isset($_SESSION['email1']) && !empty($_SESSION['email1'])){
    //DA BI SE MODALNI DIJALOG OTVORIO SAMO JEDNOM, SESSION VARIJABLE PREBACITI U DRUGE SA SLICNIM IMENOM A OVE U IF USLOVU UNSET-OVATI!!!!!!!!!!!!!!
    //!!!!!!!!MORA DA SE POZOVE NA KRAJU SA OSTALIM JQUERY SCRIPTAMA, NECE DA RADI AKO SCRIPTU STAVIMO GORE U KONTEJNER!!!!!!!!!!
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
    



    <!--ovaj script je da dodamo window.location.hash u URL stranice, tako da znamo
    na kojem smo tabu!!! I kako bismo nakon submitovanja, ostali na selektovanom tabu! -->
    <script>
      $('#mytabs a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
});

// store the currently selected tab in the hash value
    $("ul.nav-pills > li > a").on("shown.bs.tab", function(e) {
      var id = $(e.target).attr("href").substr(1);
      window.location.hash = "!" + id; //dodali "!" da ne bi skako na id umesto na vrh stranice!
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    $('#mytabs a[href="' + hash + '"]').tab('show');

    </script>
</body>
</html>